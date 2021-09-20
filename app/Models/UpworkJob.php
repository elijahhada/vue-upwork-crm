<?php

namespace App\Models;

use App\Actions\Upwork\CalculateClientScore;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;

class UpworkJob implements Arrayable
{
    public $upwork_id;
    public $title;
    public $excerpt;
    public $url;
    public $category2;
    public $subcategory2;
    public $job_type;
    public $budget;
    public $duration;
    public $workload;
    public $job_status;
    public $status;
    public $client;
    public $date_created;

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
            ->setClientAssignments(isset($data->assignments->assignment)
                ? is_array($data->assignments->assignment) ? $data->assignments->assignment : [$data->assignments->assignment]
                : null)
            ->setClientTotalCharge($data->buyer->op_tot_charge)
            ->setClientAvgRate()
            ->setClientAvgCharge()
            ->setClientBadFeedbacksCount();
    }

    public function calculateClientScore()
    {
        $this->client->score = (new CalculateClientScore())->calculate($this);
    }

    public function toArray()
    {
        $data = [];

        foreach (get_object_vars($this) as $index => $item) {
            if ($index === 'client') {
                continue;
            }
            if ($index === 'date_created') {
                /**
                 * @var Carbon $item
                 */
                $data[$index] = $item->toISOString();
                continue;
            }

            $data[$index] = $item;
        }

        foreach (get_object_vars($this->client) as $index => $item) {
            $data['client_'.$index] = $item;
        }

        return $data;
    }
}
