<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

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
        "hourly_min",
        "hourly_max",
    ];

    protected $casts = [
        'client_assignments' => 'array',
        'date_created' => 'datetime:d.m.Y H:i:s',
        'is_hourly' => 'boolean',
        'is_fixed' => 'boolean',
    ];

    protected $appends = ['human_date_created', 'client_hire_rate', 'feedbacks', 'tags', 'time_after_job_creation'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function blockedUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'blocked_user_id', 'id');
    }

    public function exceptionWords()
    {
        return $this->belongsToMany(ExceptionWord::class,'exception_word_job', 'job_id', 'exception_word_id');
    }

    public function keyWords()
    {
        return $this->belongsToMany(KeyWord::class,'key_word_job', 'job_id', 'key_word_id');
    }

    public function customKeyWords()
    {
        return $this->belongsToMany(CustomKeyWord::class,'custom_key_word_job', 'job_id', 'custom_key_word_id');
    }

    public function bid()
    {
        return $this->hasOne(Bid::class,'job_id','id');
    }

    public function getClientFeedbackAttribute($value)
    {
        return number_format($value, 2);
    }

    public function getClientPaymentVerificationAttribute($value)
    {
        return $value ? 'Yes' : 'No';
    }

    public function getHumanDateCreatedAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->date_created)->diffForHumans();
    }

    public function getClientTotalChargeAttribute($value)
    {
        return '$' . number_format($value, 2) ?? '$0.00';
    }

    public function getClientHireRateAttribute()
    {
        return number_format(($this->client_past_hires / ($this->client_jobs_posted + 1)) * 100, 2) . '%';
    }

    public function getFeedbacksAttribute()
    {
        $feedbacks = [];
        if(isset($this->client_assignments) && !empty($this->client_assignments)) {
            foreach ($this->client_assignments as $index => $assignment) {
                if(isset($assignment['feedback'])) {
                    if(isset($assignment['feedback']['comment']) && !empty($assignment['feedback']['comment'])) {
                        $data = [];
                        $data['id'] = uniqid($index);
                        $data['description'] = $assignment['feedback']['comment'];
                        array_push($feedbacks, $data);
                    }
                }
            }
        }
        return $feedbacks;
    }

    public function getTagsAttribute()
    {
        $skills = [];
        foreach (explode(',', $this->skills) as $index => $skill) {
            $data = [];
            $data['id'] = uniqid($index);
            $data['title'] = $skill;
            array_push($skills, $data);
        }
        return $skills;
    }

    public function getTimeAfterJobCreationAttribute()
    {
        $now = Carbon::now()->addHours(3);
        return $now->diff(Carbon::parse($this->date_created))->d . ' days '
            . $now->diff(Carbon::parse($this->date_created))->h . ' hours '
            . $now->diff(Carbon::parse($this->date_created))->i . ' minutes';
    }
}
