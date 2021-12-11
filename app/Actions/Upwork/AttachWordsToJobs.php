<?php

namespace App\Actions\Upwork;

use App\Models\CustomKeyWord;
use App\Models\ExceptionWord;
use App\Models\Job;
use App\Models\KeyWord;

class AttachWordsToJobs
{
    public $jobsIds;

    public function __construct($ids)
    {
        $this->jobsIds = $ids;
    }

    public function attach()
    {
        $keyWords = KeyWord::all();
        foreach ($keyWords as $word) {
            $currentJobsIdsForKeyWord = Job::whereIn('upwork_id', $this->jobsIds)
                ->where(function ($query) use($word) {
                    $query->where('title', 'like', '%'. strtolower($word->title) .'%')
                        ->orWhere('excerpt', 'like', '%'. strtolower($word->title) .'%')
                        ->orWhere('skills', 'like', '%'. strtolower($word->title) .'%');
                })
                ->get()->pluck('id');
            if(!empty($currentJobsIdsForKeyWord)) {
                $word->jobs()->attach($currentJobsIdsForKeyWord);
            }
        }
        $customKeyWords = CustomKeyWord::all();
        foreach ($customKeyWords as $word) {
            $currentJobsIdsForCustomWord = Job::whereIn('upwork_id', $this->jobsIds)
                ->where(function ($query) use($word) {
                    $query->where('title', 'like', '%'. strtolower($word->title) .'%')
                        ->orWhere('excerpt', 'like', '%'. strtolower($word->title) .'%')
                        ->orWhere('skills', 'like', '%'. strtolower($word->title) .'%');
                })
                ->get()->pluck('id');
            if(!empty($currentJobsIdsForCustomWord)) {
                $word->jobs()->attach($currentJobsIdsForCustomWord);
            }
        }
        $exceptionWords = ExceptionWord::all();
        foreach ($exceptionWords as $word) {
            $currentJobsIdsForExceptionWord = Job::whereIn('upwork_id', $this->jobsIds)
                ->where(function ($query) use($word) {
                    $query->where('title', 'like', '%'. strtolower($word->title) .'%')
                        ->orWhere('excerpt', 'like', '%'. strtolower($word->title) .'%')
                        ->orWhere('skills', 'like', '%'. strtolower($word->title) .'%');
                })
                ->get()->pluck('id');
            if(!empty($currentJobsIdsForExceptionWord)) {
                $word->jobs()->attach($currentJobsIdsForExceptionWord);
            }
        }
    }
}
