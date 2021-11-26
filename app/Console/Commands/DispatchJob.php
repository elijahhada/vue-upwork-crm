<?php

namespace App\Console\Commands;

use App\Jobs\CreateJobsFromUpwork;
use App\Models\User;
use App\Services\UpworkJobsService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class DispatchJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Auth::login(User::find(2));
        $service = new UpworkJobsService();
        $jobsContainer = $service
            ->setCount(5)
            ->setOffset(0)
            ->getJobs();
        dd($jobsContainer);
        
        $service = new UpworkJobsService();
        $service->setQuery('php');
        $response = $service->getJobs();

        dd($response);
        return 0;
    }
}
