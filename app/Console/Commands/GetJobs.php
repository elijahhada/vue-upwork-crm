<?php

namespace App\Console\Commands;

use App\Actions\Upwork\AttachWordsToJobs;
use App\Models\Category;
use App\Models\Country;
use App\Models\Job;
use App\Models\UpworkJob;
use App\Models\User;
use App\Services\UpworkJobsService;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GetJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Auth::login(User::find(1));
        $client = new Client();
        $user = Auth::user();
        $hoursPassed = Carbon::now()->diffInHours(Carbon::parse($user->last_upwork_token_update));
        if($hoursPassed > 10) {
            $formParams = [
                'grant_type' => 'refresh_token',
                'refresh_token' => $user['upwork_token']['refresh_token'],
                'client_id' => config('upwork.client_id'),
            ];
            $updateTokenResponse = $client->request('POST', 'https://www.upwork.com/api/v3/oauth2/token', ['form_params' => $formParams]);
            $token = $user->upwork_token;
            $token['access_token'] = json_decode($updateTokenResponse->getBody()->getContents(), true)['access_token'];
            $user->upwork_token = $token;
            $user->last_upwork_token_update = Carbon::now()->toDateTimeString();
            $user->save();
            Auth::login(User::find(1));
        }
        $service = new UpworkJobsService();

        $jobsContainer = $service
            ->setCount(100)
            ->setOffset(0)
            ->setDatePosted(1)
            ->getJobs();
        $jobContents = [];
        $countries = [];
        $categories = [];
        $newJobContents = [];

        foreach ($jobsContainer->jobs as $upworkJob) {
            $upworkJob = new UpworkJob($upworkJob);
            $jobContents[$upworkJob->upwork_id] = $upworkJob;

            if ($upworkJob->client->country) {
                $countries[] = [
                    'title' => $upworkJob->client->country,
                ];
            }
            if ($upworkJob->category2) {
                $categories[] = [
                    'title' => $upworkJob->category2,
                    'upwork_id' => 1,
                ];
            }
        }
        $jobsFromDB = Job::query()->whereIn('upwork_id', collect($jobContents)->pluck('upwork_id'))->pluck('upwork_id');
        $jobsExistCount = Job::query()->whereIn('upwork_id', collect($jobContents)->pluck('upwork_id'))->count();
        Log::channel('upwork_jobs_info')->info('Jobs exist=' . $jobsExistCount);
        $addedJobs = 100 - $jobsExistCount;
        Log::channel('upwork_jobs_info')->info('Jobs added=' . $addedJobs . ' at ' . Carbon::now()->format('Y-m-d H:i:s'));

        try {
            $jobContents = array_filter($jobContents, function ($key) use($jobsFromDB) {
                return !in_array($key, $jobsFromDB->toArray());
            }, ARRAY_FILTER_USE_KEY);

            foreach (array_chunk($jobContents, 20, true) as $chunk) {
                $jobProfiles = $service->getJobProfiles(implode(';', array_keys($chunk)));
                Log::channel('upwork_jobs_error')->info('Profiles id chunk');
                Log::channel('upwork_jobs_error')->info($chunk);
                var_dump('every chunk');
                foreach ($chunk as $index => $job) {
                    foreach ($jobProfiles->profiles->profile as $profile) {
                        if($index == $profile->ciphertext) {
                            $job->setExtraFields($profile);
                            $job->calculateClientScore();
                            $newJobContents[$index] = $job->toArray();
                        }
                    }
                }
                sleep(5);
            }
            Job::upsert($newJobContents, ['upwork_id']);
            Country::upsert($countries, ['title']);
            Category::upsert($categories, ['title']);
            (new AttachWordsToJobs(collect($newJobContents)->pluck('upwork_id')->toArray()))->attach();
        } catch (\Exception $exception) {
            Log::channel('upwork_jobs_error')->info('Exception detected');
            Log::channel('upwork_jobs_error')->info($exception->getMessage());
            Log::channel('upwork_jobs_error')->info($jobProfiles);
        } catch (\Error $error) {
            Log::channel('upwork_jobs_error')->info('Error detected');
            Log::channel('upwork_jobs_error')->info($error->getMessage());
        }
        Log::channel('upwork_jobs_info')->info('really added');
        Log::channel('upwork_jobs_info')->info(count($newJobContents));
        sleep(5);
        return 0;
    }
}
