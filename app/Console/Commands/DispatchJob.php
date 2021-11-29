<?php

namespace App\Console\Commands;

use App\Jobs\CreateJobsFromUpwork;
use App\Models\Category;
use App\Models\Country;
use App\Models\Job;
use App\Models\UpworkJob;
use App\Models\User;
use App\Services\UpworkJobsProfileService;
use App\Services\UpworkJobsService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DispatchJob extends Command
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
        Auth::login(User::find(2));

        $service = new UpworkJobsService();

        $flag = false;
        $offset = 0;

        while (!$flag) {
            $jobsContainer = $service
                ->setCount(5)
                ->setOffset($offset)
                ->getJobs();

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

            foreach ($jobContents as $index => $job) {
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

            $jobsFromDB = Job::query()->whereIn('upwork_id', collect($jobContents)->flatten()->pluck('upwork_id'))->get();
            $jobsFromDB->isEmpty() ? ($offset += 5) : ($flag = true);
            Job::upsert($jobContents, ['upwork_id']);
            Country::upsert($countries, ['title']);
            Category::upsert($categories, ['title']);
            sleep(10);
        };

        return 0;
    }
}
