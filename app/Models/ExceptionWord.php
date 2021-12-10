<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExceptionWord extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function jobs()
    {
        return $this->belongsToMany(Job::class,'exception_word_job', 'exception_word_id', 'job_id');
    }
}
