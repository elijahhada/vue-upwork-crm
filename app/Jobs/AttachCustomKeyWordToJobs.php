<?php

namespace App\Jobs;

use App\Models\CustomKeyWord;
use App\Models\ExceptionWord;
use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AttachCustomKeyWordToJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $words;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($words)
    {
        $this->words = $words;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->words as $word){
            $word = strtolower($word);
            $jobs = Job::where('title', 'like', "%$word%")->orWhere('excerpt', 'like', "%$word%")->orWhere('skills', 'like', "%$word%")->get()->pluck('id');
            $word = CustomKeyWord::where('title', $word)->first();
            $word->jobs()->attach($jobs);
        }
    }
}
