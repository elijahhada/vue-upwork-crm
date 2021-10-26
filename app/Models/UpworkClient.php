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
    public $total_charge;
    public $assignments;
    public $avg_rate;
    public $avg_charge;
    public $bad_feedbacks_count;

    public function __construct($job)
    {
        $this->country = $job->client->country;
        $this->feedback = $job->client->feedback;
        $this->reviews_count = $job->client->reviews_count;
        $this->jobs_posted = $job->client->jobs_posted;
        $this->past_hires = $job->client->past_hires;
        $this->payment_verification = $job->client->payment_verification_status;
    }

    public function setClientTotalCharge($total_charge)
    {
        $this->total_charge = $total_charge;
        return $this;
    }

    public function setClientAssignments($assignments)
    {
        $this->assignments = $assignments;
        return $this;
    }

    public function setClientAvgRate()
    {
        $this->avg_rate = $this->calculateAvgRate();
        return $this;
    }

    private function calculateAvgRate()
    {
        $avgCharges = [];

        if ($this->assignments) {
            foreach ($this->assignments as $assignment) {
                if (isset($assignment->as_rate) && (float) trim($assignment->as_rate, '$')) {
                    $avgCharges[] = trim($assignment->as_rate, '$');
                }
            }
        }

        return number_format(collect($avgCharges)->avg(), 2, '.', '');
    }

    private function calculateAvgCharge()
    {
        $avgCharges = [];

        if ($this->assignments) {
            foreach ($this->assignments as $assignment) {
                if (isset($assignment->as_total_charge) && (float) trim($assignment->as_total_charge)) {
                    $avgCharges[] = trim($assignment->as_total_charge);
                }
            }
        }

        return number_format(collect($avgCharges)->avg(), 2, '.', '');
    }

    /**
     * @param mixed $avg_charge
     * @return UpworkClient
     */
    public function setClientAvgCharge()
    {
        $this->avg_charge = $this->calculateAvgCharge();
        return $this;
    }

    /**
     * @param mixed $bad_feedbacks_count
     * @return UpworkClient
     */
    public function setClientBadFeedbacksCount()
    {
        $this->bad_feedbacks_count = $this->calculateBadFeedbacksCount();
        return $this;
    }

    private function calculateBadFeedbacksCount()
    {
        $bad_feedbacks_count = 0;
        if ($this->assignments) {
            foreach ($this->assignments as $assignment) {
                if (isset($assignment->feedback) && (float) $assignment->feedback->score <= 3.0) {
                    $bad_feedbacks_count++;
                }
            }
        }

        return $bad_feedbacks_count;
    }
}