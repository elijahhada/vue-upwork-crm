<?php

namespace App\Models;

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
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function blockedUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'blocked_user_id', 'id');
    }
}
