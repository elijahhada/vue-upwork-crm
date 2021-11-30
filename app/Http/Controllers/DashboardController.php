<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Filter;
use App\Models\Job;
use App\Models\KeyWord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $jobs = Job::query()
            ->whereNull('status')
            ->orWhere('status', 2)
            ->orderBy('date_created', 'desc')
            ->paginate(10);
        $user = Auth::user();

        // go to Dashboard.vue->DashboardHeader.vue->CreateKit
        $countries = Country::select('id', 'title')->get();
        $categories = Category::select('id', 'title')->get();
        $keyWords = KeyWord::select('id', 'title', 'is_primary', 'parent_id')->get();
        $filters = Filter::select('id', 'title', 'user_id', 'categories_ids', 'countries_ids', 'key_words_ids', 'exseption_words', 'custom_key_words')->get();

        return inertia('Dashboard', [
            'jobs' => $jobs,
            'countries' => $countries,
            'categories' => $categories,
            'keyWords' => $keyWords,
            'userId' => $user->id,
            'filters' => $filters,
        ]);
    }
}
