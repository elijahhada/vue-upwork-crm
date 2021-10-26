<?php

namespace App\Actions\Upwork;

use App\Models\Job;
use App\Models\UpworkJob;

class CreateNewJob
{
    public function create(UpworkJob $job)
    {
        return Job::create([
            'title' => $job->title,
            'excerpt' => $job->excerpt,
            'upwork_id' => $job->id,
            'url' => $job->url,
            'category2' => $job->category2,
            'subcategory2' => $job->subcategory2,
            'job_type' => $job->job_type,
            'budget' => $job->budget,
            'duration' => $job->duration,
            'workload' => $job->workload,
            'status' => $job->job_status,
            'date_created' => $job->date_created,
            'client_country' => $job->client->country,
            'client_feedback' => $job->client->feedback,
            'client_reviews_count' => $job->client->reviews_count,
            'client_jobs_posted' => $job->client->jobs_posted,
            'client_past_hires' => $job->client->past_hires,
            'client_payment_verification' => $job->client->payment_verification,
            'client_score' => $job->client->score,
        ]);
    }
}