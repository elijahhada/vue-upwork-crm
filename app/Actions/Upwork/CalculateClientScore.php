<?php

namespace App\Actions\Upwork;

use App\Models\UpworkJob;

class CalculateClientScore
{
    public function calculate(UpworkJob $job)
    {
        $score = 55;

        $score += $job->client->payment_verification ? 5 : -5;

        $score += in_array($job->client->country, ['India', 'Pakistan', 'Bangladesh']) ?: -5;

        $score += strlen($job->excerpt) < 300 ? -5 : 5;

        if ($job->client->feedback < 4.5) {
            $score -= 10;
        } elseif ($job->client->feedback < 4.7) {
            $score -= 5;
        } else {
            $score += 5;
        }

        if ($job->client->avg_rate) {
            if ($job->client->avg_rate < 15) {
                $score -= 5;
            } elseif ($job->client->avg_rate >= 15) {
                $score += 10;
            }
        }

        if ($job->client->avg_charge) {
            if ($job->client->avg_charge < 500) {
                $score -= 5;
            } elseif ($job->client->avg_charge >= 500) {
                $score += 5;
            }
        }

        if ($job->client->bad_feedbacks_count) {
            if ($job->client->bad_feedbacks_count >= 5) {
                $score -= 5;
            } elseif ($job->client->bad_feedbacks_count < 5) {
                $score += 5;
            }
        }

        return $score;
    }
}