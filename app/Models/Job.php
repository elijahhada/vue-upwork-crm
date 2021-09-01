<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'excerpt',
        'url',
        'upwork_id',
        'category2',
        'subcategory2',
        'job_type',
        'budget',
        'duration',
        'workload',
        'status',
        'date_created',
        'client_country',
        'client_feedback',
        'client_reviews_count',
        'client_jobs_posted',
        'client_past_hires',
        'client_payment_verification',
        'client_score',
        'client_total_charge',
        'client_assignments',
        'client_avg_rate',
        'client_avg_charge',
        'client_bad_feedbacks_count',
    ];

    protected $casts = [
        'client_assignments' => 'array',
    ];

    protected $appends = [
        'human_date_created'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function blockedUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'blocked_user_id', 'id');
    }

    public function getClientFeedbackAttribute($value)
    {
        return number_format($value, 2);
    }

    public function getClientPaymentVerificationAttribute($value)
    {
        return $value ?? 'NOT VERIFIED';
    }

    public function getHumanDateCreatedAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->date_created)->diffForHumans();
    }
}
