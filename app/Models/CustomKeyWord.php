<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomKeyWord extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function jobs()
    {
        return $this->belongsToMany(Job::class,'custom_key_word_job', 'custom_key_word_id', 'job_id');
    }
}
