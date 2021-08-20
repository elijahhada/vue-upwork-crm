<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jobs = Job::query()->orderBy('date_created', 'desc')->paginate(20);

        return inertia('Dashboard', [
            'jobs' => $jobs,
        ]);
    }
}
