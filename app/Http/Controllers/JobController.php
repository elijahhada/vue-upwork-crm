<?php

namespace App\Http\Controllers;

use App\Events\JobDeleted;
use App\Models\Category;
use App\Models\Country;
use App\Models\Filter;
use App\Models\Job;
use App\Models\KeyWord;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Upwork\API\Routers\Hr\Jobs;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */

    public function changeStatus(Request $request)
    {
        $job = Job::where('id', $request->input('id'))->first();
        $job->status = $request->input('status');
        if ($request->input('status') == 1) {
            $job->user_id = Auth::user()->id;
        }
        $job->save();
        return Auth::user();
    }

    public function delete(Request $request)
    {
        $job = Job::where('id', $request->input('id'))->first();

        $job->delete();
    }

    public function filter(Request $request)
    {
        $filters = Filter::find($request->kits);
        if (!count($filters)) {
            $jobs = Job::query()
                ->orderBy('date_created', 'desc')
                ->paginate(10);
            return $jobs;
        }
        $categories = $filters->pluck('categories_ids');
        $categories = $categories->filter(fn($value) => !is_null($value));
        $filterCategories = collect();

        $countries = $filters->pluck('countries_ids');
        $countries = $countries->filter(fn($value) => !is_null($value));
        $filterCountries = collect();

        $exceptionWords = $filters->pluck('exseption_words');
        $exceptionWords = $exceptionWords->filter(fn($value) => !is_null($value));
        $filterWords = collect();

        $keyWords = $filters->pluck('key_words_ids');
        $keyWords = $keyWords->filter(fn($value) => !is_null($value));
        $filterKeyWords = collect();

        $customKeyWords = $filters->pluck('custom_key_words');
        $customKeyWords = $customKeyWords->filter(fn($value) => !is_null($value));
        $filterCustomKeyWords = collect();

        if (count($categories)) {
            foreach ($categories as $category) {
                foreach (explode(',', $category) as $item) {
                    $filterCategories->push($item);
                }
            }
            $filterCategories->unique();
        }
        $filterCategories = Category::find($filterCategories)->pluck('title');

        if (count($countries)) {
            foreach ($countries as $country) {
                foreach (explode(',', $country) as $item) {
                    $filterCountries->push($item);
                }
            }
            $filterCountries->unique();
        }
        $filterCountries = Country::find($filterCountries)->pluck('title');

        if (count($keyWords)) {
            foreach ($keyWords as $word) {
                foreach (explode(',', $word) as $item) {
                    $filterKeyWords->push($item);
                }
            }
            $filterKeyWords->unique();
        }
        $filterKeyWords = KeyWord::find($filterKeyWords)->pluck('title');

        if (count($exceptionWords)) {
            foreach ($exceptionWords as $exceptionWord) {
                foreach (explode('_|_', $exceptionWord) as $item) {
                    $filterWords->push($item);
                }
            }
            $filterWords->unique();
        }

        if (count($customKeyWords)) {
            foreach ($customKeyWords as $customKeyWord) {
                foreach (explode(',', $customKeyWord) as $item) {
                    $filterCustomKeyWords->push($item);
                }
            }
            $filterCustomKeyWords->unique();
        }
        $jobs = Job::query()->orderBy('date_created', 'desc');
        if (count($filterCategories)) {
            $jobs = $jobs->whereIn('subcategory2', $filterCategories);
        }

        if (count($filterCountries)) {
            $jobs = $jobs->whereIn('client_country', $filterCountries);
        }

        if (count($filterWords)) {
            foreach ($filterWords as $word) {
                $jobs->where('title', 'not like', "%$word%")->where('excerpt', 'not like', "%$word%");
            }
        }

        if (count($filterCustomKeyWords)) {
            foreach ($filterCustomKeyWords as $word) {
                $jobs->where('title', 'like', "%$word%")
                    ->orWhere('excerpt', 'like', "%$word%");
            }
        }

        if (count($filterKeyWords)) {
            foreach ($filterKeyWords as $word) {
                $jobs->where('title', 'like', "%$word%")
                     ->orWhere('excerpt', 'like', "%$word%");
            }
        }

        return $jobs->paginate(10);
    }

    public function info()
    {
        $client = new Client();
        $user = Auth::user();

        if(Carbon::now()->diffInMinutes(Carbon::parse($user->updated_at)->toDateTimeString()) > 55) {
            $auth = [
                config('pipedrive.client_id'),
                config('pipedrive.client_secret')
            ];
            $formParams = [
                'grant_type' => 'refresh_token',
                'refresh_token' => $user['pipedrive_token']['refresh_token']
            ];
            $updateTokenResponse = $client->request('POST', 'https://oauth.pipedrive.com/oauth/token', ['auth' => $auth, 'form_params' => $formParams]);
            $user->pipedrive_token = json_decode($updateTokenResponse->getBody()->getContents(), true);
            $user->save();
        }
        $bearer = $user['pipedrive_token']['access_token'];

        $response = $client->request('GET', 'https://' . $user['pipedrive_domain'] . '.pipedrive.com/api/v1/users', ['headers' => ['Authorization' => 'Bearer ' . $bearer]])
            ->getBody()
            ->getContents();
        $usersData = json_decode($response, true);
        $result = [];
        if ($usersData['success']){
            $result['bidOwners'] = [];
            foreach ($usersData['data'] as $userItem){
                if($user->email == $userItem['email']){
                    $result['currentUser'] = $userItem;
                }
                if($userItem['email'] == 'artem.mazurchak@gmail.com'){
                    array_push($result['bidOwners'], $userItem);
                }
            }
        }
        $labelsResponse = $client->request('GET', 'https://' . $user['pipedrive_domain'] . '.pipedrive.com/api/v1/leadLabels', ['headers' => ['Authorization' => 'Bearer ' . $bearer]])
            ->getBody()
            ->getContents();
        $result['labels'] = json_decode($labelsResponse, true)['data'];

        return $result;
    }

    public function getJob($id)
    {
        return Job::find(['id'=>$id])->first();
    }

    public function storeDeal(Request $request)
    {
        try {
            $client = new Client();
            $user = Auth::user();
            if(Carbon::now()->diffInMinutes(Carbon::parse($user->updated_at)->toDateTimeString()) > 55) {
                $auth = [
                    config('pipedrive.client_id'),
                    config('pipedrive.client_secret')
                ];
                $formParams = [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $user['pipedrive_token']['refresh_token']
                ];
                $updateTokenResponse = $client->request('POST', 'https://oauth.pipedrive.com/oauth/token', ['auth' => $auth, 'form_params' => $formParams]);
                $user->pipedrive_token = json_decode($updateTokenResponse->getBody()->getContents(), true);
                $user->save();
            }
            $bearer = $user['pipedrive_token']['access_token'];

            $data = [
                'title' => $request->title,
                'owner_id' => $request->owner_id,
                'person_id' => 1,
                'label_ids' => $request->label_ids,
            ];
            $response = $client->request('POST', 'https://' . $user['pipedrive_domain'] . '.pipedrive.com/api/v1/leads', ['headers' => ['Authorization' => 'Bearer ' . $bearer], 'json' => $data])->getBody()->getContents();
            $result = json_decode($response, true);
        } catch (\Exception $exception) {
            $result = $exception->getMessage();
        }

        return response()->json(['data' => $result]);
    }
}
