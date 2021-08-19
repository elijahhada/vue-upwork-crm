<?php

namespace App\Models;

use App\Actions\Upwork\CalculateClientScore;

class UpworkJob
{
    public $id;
    public $title;
    public $snippet;
    public $url;
    public $category2;
    public $subcategory2;
    public $job_type;
    public $budget;
    public $duration;
    public $workload;
    public $job_status;
    public $date_created;
    public $client;

    public function __construct($job)
    {
        $this->title = $job->title;
        $this->excerpt = $job->snippet;
        $this->upwork_id = $job->id;
        $this->url = $job->url;
        $this->category2 = $job->category2;
        $this->subcategory2 = $job->subcategory2;
        $this->job_type = $job->job_type;
        $this->budget = $job->budget;
        $this->duration = $job->duration;
        $this->workload = $job->workload;
        $this->status = $job->job_status;
        $this->date_created = $job->date_created;

        $this->client = new UpworkClient($job);
        $this->client->score = CalculateClientScore::calculate($this);
    }
}