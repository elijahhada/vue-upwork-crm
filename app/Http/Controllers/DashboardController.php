<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\CustomKeyWord;
use App\Models\ExceptionWord;
use App\Models\Filter;
use App\Models\Job;
use App\Models\KeyWord;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $jobs = Job::query()
            ->where('is_old', false)
            ->where('is_taken', false)
            ->orderBy('date_created', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);
        $user = Auth::user();

        // go to Dashboard.vue->DashboardHeader.vue->CreateKit
        $countries = Country::select('id', 'title')->get();
        $categories = Category::select('id', 'title')->get();
        $keyWords = KeyWord::select('id', 'title', 'is_primary', 'parent_id')->get();
        $filters = Filter::select('id', 'title', 'user_id', 'categories_ids', 'countries_ids', 'key_words_ids', 'exception_words_ids', 'custom_key_words_ids', 'is_hourly', 'hourly_min', 'hourly_max', 'is_fixed', 'fixed_min', 'fixed_max')->get();
        $filters->map(function($filter) {
            $exceptionWords = [];
            foreach (explode(',', $filter['exception_words_ids']) as $wordId){
                $item = ExceptionWord::find($wordId);
                if($item){
                    array_push($exceptionWords, $item->title);
                }
            }
            $filter['exception_words_ids'] = implode(',', $exceptionWords);
            $customKeyWords = [];
            foreach (explode(',', $filter['custom_key_words_ids']) as $wordId){
                $item = CustomKeyWord::find($wordId);
                if($item){
                    array_push($customKeyWords, $item->title);
                }
            }
            $filter['custom_key_words_ids'] = implode(',', $customKeyWords);
            return $filter;
        });
        $fromWeekStart = Carbon::now()->subDays(Carbon::now()->dayOfWeek)->toDateTimeString();
        $usersForStatistics = User::whereNotIn('email', ['artem.mazurchak@gmail.com', 'hadasevich.e@gmail.com'])
            ->with(['bids' => function($query) use($fromWeekStart) {
                $query->where('created_at', '>=', $fromWeekStart);
            }])
            ->get();
        $usersForStatistics = $usersForStatistics->map(function ($user) {
            $result = [];
            $result['id'] = $user->id;
            $result['name'] = $user->name;
            $result['total'] = 0;
            $result['answers'] = 0;
            foreach ($user->bids as $bid) {
                $result['total']++;
                if($bid->has_answer) {
                    $result['answers']++;
                }
            }
            $result['conversion'] = $result['total'] > 0 ? round($result['answers'] / $result['total'] * 100) : 0;
            return $result;
        })->sortByDesc('conversion')->values()->take(4);

        return inertia('Dashboard', [
            'jobs' => $jobs,
            'countries' => $countries,
            'categories' => $categories,
            'keyWords' => $keyWords,
            'userId' => $user->id,
            'filters' => $filters,
            'usersResults' => $usersForStatistics,
        ]);
    }
}
