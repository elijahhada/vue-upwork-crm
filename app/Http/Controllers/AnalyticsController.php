<?php

namespace App\Http\Controllers;

use App\Models\Country;
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
}
