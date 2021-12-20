<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\CustomKeyWord;
use App\Models\ExceptionWord;
use App\Models\Filter;
use App\Models\Job;
use App\Models\KeyWord;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $jobs = Job::query()
            ->where('is_taken', false)
            ->orderBy('date_created', 'desc')
            ->paginate(10);
        $user = Auth::user();

        // go to Dashboard.vue->DashboardHeader.vue->CreateKit
        $countries = Country::select('id', 'title')->get();
        $categories = Category::select('id', 'title')->get();
        $keyWords = KeyWord::select('id', 'title', 'is_primary', 'parent_id')->get();
        $filters = Filter::select('id', 'title', 'user_id', 'categories_ids', 'countries_ids', 'key_words_ids', 'exception_words_ids', 'custom_key_words_ids')->get();
        $exceptionWords = [];
        foreach ($filters as $filter){
            foreach (explode(',', $filter['exception_words_ids']) as $wordId){
                $item = ExceptionWord::find($wordId);
                if($item){
                    array_push($exceptionWords, $item->title);
                }
            }
            $filter['exception_words_ids'] = implode(',', $exceptionWords);
        }
        $customKeyWords = [];
        foreach ($filters as $filter){
            foreach (explode(',', $filter['custom_key_words_ids']) as $wordId){
                $item = CustomKeyWord::find($wordId);
                if($item){
                    array_push($customKeyWords, $item->title);
                }
            }
            $filter['custom_key_words_ids'] = implode(',', $customKeyWords);
        }

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
