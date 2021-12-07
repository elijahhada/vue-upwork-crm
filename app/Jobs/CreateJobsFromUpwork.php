<?php

namespace App\Jobs;

use App\Actions\Upwork\CalculateClientScore;
use App\Models\Category;
use App\Models\Country;
use App\Models\Job;
use App\Models\UpworkJob;
use App\Services\UpworkJobsProfileService;
use App\Services\UpworkJobsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CreateJobsFromUpwork implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Authenticatable $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Auth::login($this->user);

        $service = new UpworkJobsService();

        $flag = false;
        $offset = 0;

        while (!$flag) {
            $jobsContainer = $service
                ->setCount(5)
                ->setOffset($offset)
                ->getJobs();
            var_dump($jobsContainer);

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

            $jobsFromDB->isEmpty() ? ($offset += 1) : ($flag = true);

            Job::upsert($jobContents, ['upwork_id']);
            Country::upsert($countries, ['title']);
            Category::upsert($categories, ['title']);
            sleep(10);
        };
    }
}
