<?php

namespace App\Models;

use App\Actions\Upwork\CalculateClientScore;

class UpworkClient
{
    public $country;
    public $feedback;
    public $reviews_count;
    public $jobs_posted;
    public $past_hires;
    public $payment_verification;
    public $score;
    public $client_total_charge;
    public $client_assignments;
    public $client_avg_rate;
    public $client_avg_charge;
    public $client_bad_feedbacks_count;

    public function __construct($job)
    {
        $this->country = $job->client->country;
        $this->feedback = $job->client->feedback;
        $this->reviews_count = $job->client->reviews_count;
        $this->jobs_posted = $job->client->jobs_posted;
        $this->past_hires = $job->client->past_hires;
        $this->payment_verification = $job->client->payment_verification_status;
    }

    public function setClientTotalCharge($client_total_charge)
    {
        $this->client_total_charge = $client_total_charge;
        return $this;
    }

    public function setClientAssignments($client_assignments)
    {
        $this->client_assignments = $client_assignments;
        return $this;
    }

    public function setClientAvgRate()
    {
        $this->client_avg_rate = $this->calculateAvgRate();
        return $this;
    }

    private function calculateAvgRate()
    {
        $avgCharges = [];

        if ($this->client_assignments) {
            foreach ($this->client_assignments as $client_assignment) {
                if ((float) trim($client_assignment->as_rate, '$')) {
                    $avgCharges[] = trim($client_assignment->as_rate, '$');
                }
            }
        }

        return number_format(collect($avgCharges)->avg(), 2);
    }

    private function calculateAvgCharge()
    {
        $avgCharges = [];

        if ($this->client_assignments) {
            foreach ($this->client_assignments as $client_assignment) {
                if ((float) trim($client_assignment->as_total_charge)) {
                    $avgCharges[] = trim($client_assignment->as_total_charge);
                }
            }
        }

        return number_format(collect($avgCharges)->avg(), 2);
    }

    /**
     * @param mixed $client_avg_charge
     * @return UpworkClient
     */
    public function setClientAvgCharge()
    {
        $this->client_avg_charge = $this->calculateAvgCharge();
        return $this;
    }

    /**
     * @param mixed $client_bad_feedbacks_count
     * @return UpworkClient
     */
    public function setClientBadFeedbacksCount()
    {
        $this->client_bad_feedbacks_count = $this->calculateBadFeedbacksCount();
        return $this;
    }

    private function calculateBadFeedbacksCount()
    {
        if ($this->client_assignments) {
            foreach ($this->client_assignments as $client_assignment) {
                if ($client_assignment->feedback && (float) $client_assignment->feedback->score <= 3.0) {
                    $this->client_bad_feedbacks_count++;
                }
            }
        }

        return $this;
    }
}
