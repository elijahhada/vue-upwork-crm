<?php

namespace App\Console\Commands;

use App\Actions\Upwork\AttachWordsToJobs;
use App\Models\Category;
use App\Models\Country;
use App\Models\Job;
use App\Models\KeyWord;
use App\Models\UpworkJob;
use App\Models\User;
use App\Services\UpworkJobsProfileService;
use App\Services\UpworkJobsService;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Contracts\Auth\Authenticatable;
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
        $formParams = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $user['upwork_token']['refresh_token'],
            'client_id' => config('upwork.client_id'),
        ];
        $updateTokenResponse = $client->request('POST', 'https://www.upwork.com/api/v3/oauth2/token', ['form_params' => $formParams]);
        $token = $user->upwork_token;
        $token['access_token'] = json_decode($updateTokenResponse->getBody()->getContents(), true)['access_token'];
        $user->upwork_token = $token;
        $user->save();

        $service = new UpworkJobsService();
        $flag = false;
        $offset = 0;

        while (!$flag) {
            $jobsContainer = $service
                ->setCount(5)
                ->setOffset($offset)
                ->getJobs();
            if($offset + 5 > $jobsContainer->paging->total) {
                $flag = true;
            }
            $jobContents = [];
            $countries = [];
            $categories = [];

            if (!isset($jobsContainer->jobs)) {
                Log::alert('Jobs list error: '.json_encode($jobsContainer));
                $flag = true;
                continue;
            }

            foreach ($jobsContainer->jobs as $upworkJob) {
                $upworkJob = new UpworkJob($upworkJob);
                $jobContents[$upworkJob->upwork_id] = $upworkJob;

                if ($upworkJob->client->country) {
                    $countries[] = [
                        'title' => $upworkJob->client->country,
                    ];
                }

                if ($upworkJob->subcategory2) {
                    $categories[] = [
                        'title' => $upworkJob->subcategory2,
                        'upwork_id' => 1,
                    ];
                }
            }
            $jobsFromDB = Job::query()->whereIn('upwork_id', collect($jobContents)->pluck('upwork_id'))->get();

            foreach ($jobContents as $index => $job) {
                if(in_array($job->upwork_id, $jobsFromDB->toArray())) {
                    continue;
                }
                $jobProfile = (new UpworkJobsProfileService())->getJobProfiles($job->upwork_id);
                if (isset($jobProfile->profile)) {
                    $job->setExtraFields($jobProfile->profile);
                } else {
                    Log::alert('Jobs profile error on '.$index.': '.json_encode($jobProfile));
                }
                $job->calculateClientScore();
                $jobContents[$index] = $job->toArray();
                sleep(2);
            }
            if(empty($jobContents)) {
                sleep(10);
                continue;
            }
            $offset += 5;
            Job::upsert($jobContents, ['upwork_id']);
            Country::upsert($countries, ['title']);
            Category::upsert($categories, ['title']);
            (new AttachWordsToJobs(collect($jobContents)->pluck('upwork_id')->toArray()))->attach();
            sleep(10);
        };

        return 0;
    }
}
