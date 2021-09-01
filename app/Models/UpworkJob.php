<?php

namespace App\Models;

use App\Actions\Upwork\CalculateClientScore;
use Carbon\Carbon;

class UpworkJob
{
    public $upwork_id;
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
        $this->date_created = Carbon::createFromFormat('Y-m-d\TH:i:s+', $job->date_created);

        $this->client = new UpworkClient($job);
    }

    public function setExtraFields($data)
    {
        $this->client
            ->setClientAssignments($data->assignments->assignment)
            ->setClientTotalCharge($data->buyer->op_tot_charge)
            ->setClientAvgRate()
            ->setClientAvgCharge()
            ->setClientBadFeedbacksCount();
    }

    public function calculateClientScore()
    {
        $this->client->score = (new CalculateClientScore())->calculate($this);
    }
}
