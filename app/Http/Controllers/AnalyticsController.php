<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Job;
use App\Models\KeyWord;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        $countries = Country::select('id', 'title')->get();
        $keyWords = KeyWord::select('id', 'title', 'is_primary', 'parent_id')->get();
        return inertia('Analytics/CountriesKeyWords', [
            'countries' => $countries,
            'keyWords' => $keyWords,
        ]);
    }

    public function countriesKeyWords(Request $request)
    {
        try {
            $result = [];
            $keyWordsIds = $request->input('keyWordsIds');
            $customKeyWords = $request->input('customKeyWords');
            $customKeyWords = collect($customKeyWords);
            $customKeyWords = $customKeyWords->filter(function ($item) use ($keyWordsIds){
                $keyWord = KeyWord::where('title', 'like', '%' . strtolower($item) . '%')->first();
                return $keyWord && !in_array($keyWord->id, $keyWordsIds);
            })->values();
            $countries = Country::whereIn('id', $request->input('countries'))->select('id', 'title')->get();
            $keyWordsArray = KeyWord::whereIn('id', $keyWordsIds)->get();
            foreach ($countries as $country) {
                $data = [];
                $data['country'] = $country->title;
                $data['unique_id'] = uniqid($country->title);
                $data['words'] = [];
                foreach ($keyWordsArray as $keyWord) {
                    $temp = [];
                    $temp['word'] = $keyWord->title;
                    $data['unique_id'] = uniqid($keyWord->title);
                    $temp['count'] = Job::where('date_created', '>=', $request->input('dateRange')['startDate'])
                        ->where('date_created', '<=', $request->input('dateRange')['endDate'])
                        ->where('client_country', '=', $country->title)
                        ->whereHas('keyWords', function ($query) use($keyWord) {
                            $query->where('key_word_job.key_word_id', '=', $keyWord->id);
                        })->count();
                    array_push($data['words'], $temp);
                }
                foreach ($customKeyWords as $customKeyWord) {
                    $temp = [];
                    $temp['word'] = $customKeyWord;
                    $data['unique_id'] = uniqid($customKeyWord);
                    $temp['count'] = Job::where('date_created', '>=', $request->input('dateRange')['startDate'])
                        ->where('date_created', '<=', $request->input('dateRange')['endDate'])
                        ->where('client_country', '=', $country->title)
                        ->where('title', 'like', '%' . strtolower($customKeyWord) . '%')
                        ->where('excerpt', 'like', '%' . strtolower($customKeyWord) . '%')
                        ->where('skills', 'like', '%' . strtolower($customKeyWord) . '%')
                        ->count();
                    array_push($data['words'], $temp);
                }
                array_push($result, $data);
            }

        } catch (\Error $error) {
            return response()->json(['message' => $error->getMessage()]);
        }

        return response()->json(
            [
                'data' => $result,
                'request' => $request->all(),
            ]);
    }
}
