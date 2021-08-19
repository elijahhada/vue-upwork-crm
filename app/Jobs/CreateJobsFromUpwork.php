<?php

namespace App\Jobs;

use App\Actions\Upwork\CalculateClientScore;
use App\Actions\Upwork\UpsertNewJobs;
use App\Models\Country;
use App\Models\Job;
use App\Models\upworkJob;
use App\Services\upworkJobsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

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

        $service = new upworkJobsService();

        $jobs = $service
            ->setCount(100)
            ->setOffset(0)
            ->getJobs();

        $jobContents = [];
        $countries = [];

        foreach ($jobs as $upworkJob) {
            $upworkJob = new UpworkJob($upworkJob);
            $jobContents[] = [
                'title' => $upworkJob->title,
                'excerpt' => $upworkJob->excerpt,
                'upwork_id' => $upworkJob->id,
                'url' => $upworkJob->url,
                'category2' => $upworkJob->category2,
                'subcategory2' => $upworkJob->subcategory2,
                'job_type' => $upworkJob->job_type,
                'budget' => $upworkJob->budget,
                'duration' => $upworkJob->duration,
                'workload' => $upworkJob->workload,
                'status' => $upworkJob->job_status,
                'date_created' => $upworkJob->date_created,
                'client_country' => $upworkJob->client->country,
                'client_feedback' => $upworkJob->client->feedback,
                'client_reviews_count' => $upworkJob->client->reviews_count,
                'client_jobs_posted' => $upworkJob->client->jobs_posted,
                'client_past_hires' => $upworkJob->client->past_hires,
                'client_payment_verification' => $upworkJob->client->payment_verification,
                'client_score' => $upworkJob->client->score,
            ];
            $countries[] = [
                'title' => $upworkJob->client->country,
            ];
        }

        Job::upsert($jobContents, ['upwork_id']);
        Country::upsert($countries, ['title']);
    }
}
