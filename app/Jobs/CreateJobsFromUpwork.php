<?php

namespace App\Jobs;

use App\Actions\Upwork\CalculateClientScore;
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
                ->setCount(100)
                ->setOffset($offset)
                ->getJobs();

            $jobContents = [];
            $countries = [];
            $upworkIds = [];

            foreach ($jobsContainer->jobs as $upworkJob) {
                $upworkJob = new UpworkJob($upworkJob);

                $jobContents[$upworkJob->upwork_id] = $upworkJob;

                $upworkIds[] = $upworkJob->upwork_id;

                if ($upworkJob->client->country) {
                    $countries[] = [
                        'title' => $upworkJob->client->country,
                    ];
                }
            }

            foreach (array_chunk($upworkIds, 20) as $chunk) {
                sleep(10);
                $jobProfiles = (new UpworkJobsProfileService())->getJobProfiles(implode(';', $chunk));

                if (isset($jobProfiles->profiles->profile)) {
                    foreach ($jobProfiles->profiles->profile as $item) {
                        $jobContents[$item->ciphertext]->setExtraFields($item);
                    }
                } else {
                    Log::info(json_encode($jobProfiles));
                }
            }

            foreach ($jobContents as $index => $job) {
                $job->calculateClientScore();
                $jobContents[$index] = $job->toArray();
            }

            $jobsFromDB = Job::query()->whereIn('upwork_id', $upworkIds)->get();

            if ($jobsFromDB->isEmpty()) {
                $offset += 1;
            } else {
                $flag = true;
            }

            Log::info($jobContents);

            Job::upsert($jobContents, ['upwork_id']);
            Country::upsert($countries, ['title']);
            sleep(10);
        };
    }
}
