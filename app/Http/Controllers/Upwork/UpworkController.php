<?php

namespace App\Http\Controllers\Upwork;

use App\Http\Controllers\Controller;
use App\Services\UpworkJobsService;
use Illuminate\Http\Request;

class UpworkController extends Controller
{
    public function search(UpworkJobsService $service)
    {
        dd($service->getJobs());
    }
}
