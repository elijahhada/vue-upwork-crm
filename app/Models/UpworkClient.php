<?php 

namespace App\Models;

class UpworkClient
{
    public $country;
    public $feedback;
    public $reviews_count;
    public $jobs_posted;
    public $past_hires;
    public $payment_verification;
    public $score;

    public function __construct($job)
    {
        $this->country = $job->client->country;
        $this->feedback = $job->client->feedback;
        $this->reviews_count = $job->client->reviews_count;
        $this->jobs_posted = $job->client->jobs_posted;
        $this->past_hires = $job->client->past_hires;
        $this->payment_verification = $job->client->payment_verification_status;
    }
}