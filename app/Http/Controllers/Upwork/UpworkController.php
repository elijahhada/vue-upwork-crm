<?php

namespace App\Http\Controllers\Upwork;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\UpworkJobsService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UpworkController extends Controller
{
    public function search(Request $request, UpworkJobsService $service)
    {
        dd(
            $service
                ->setQuery($request->q)
                ->setOffset($request->offset)
                ->setCount($request->count)
                ->getJobs(),
        );
    }

    public function filters()
    {
        $categories = Category::with('topics')->get();

        return Inertia::render('Filters', [
            'categories' => $categories,
        ]);
    }
}