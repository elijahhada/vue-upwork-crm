<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyWord extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function jobs()
    {
        return $this->belongsToMany(Job::class,'key_word_job', 'key_word_id', 'job_id');
    }
}
