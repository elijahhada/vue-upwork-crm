<?php

namespace App\Actions\Upwork;

use App\Models\UpworkJob;

class CalculateClientScore
{
    public function calculate(UpworkJob $job)
    {
        $score = 55;

        if ($job->client->payment_verification) {
            $score += 5;
        } else {
            $score -= 5;
        }

        if ($job->client->feedback < 4.5) {
            $score -= 10;
        } elseif ($job->client->feedback < 4.7) {
            $score -= 5;
        } else {
            $score += 5;
        }

        if (in_array($job->client->country, array('India', 'Pakistan', 'Bangladesh'))) {
            $score -= 5;
        }

        if (strlen($job->excerpt) < 300) {
            $score -= 5;
        } else {
            $score += 5;
        }

        if ($job->client->avg_rate && $job->client->avg_rate < 15) {
            $score -= 5;
        } elseif ($job->client->avg_rate && $job->client->avg_rate >= 15 ) {
            $score += 10;
        }

        if ($job->client->avg_charge && $job->client->avg_charge < 500) {
            $score -= 5;
        } elseif ($job->client->avg_charge && $job->client->avg_charge >= 500) {
            $score += 5;
        }

        if ($job->client->bad_feedbacks_count && $job->client->bad_feedbacks_count >= 5) {
            $score -= 5;
        } elseif ($job->client->bad_feedbacks_count && $job->client->bad_feedbacks_count < 5) {
            $score += 5;
        }

        return $score;
    }
}
