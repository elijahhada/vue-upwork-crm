<?php

namespace App\Http\Controllers;

use App\Events\JobDeleted;
use App\Models\Bid;
use App\Models\Category;
use App\Models\Country;
use App\Models\Filter;
use App\Models\Job;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        try {
            $filters = Filter::find($request->kits);

            if (!count($filters)) {
                $jobs = Job::query()
                    ->where('date_created', '<', Carbon::now()->subDays(4)->toDateTimeString())
                    ->where('is_taken', false)
                    ->orderBy('date_created', 'desc')
                    ->orderBy('id', 'desc')
                    ->paginate(10);
                return $jobs;
            }
            $categories = $filters->pluck('categories_ids');
            $categories = $categories->filter(fn($value) => !is_null($value));
            $filterCategories = collect();

            $countries = $filters->pluck('countries_ids');
            $countries = $countries->filter(fn($value) => !is_null($value));
            $filterCountries = collect();

            $exceptionWords = $filters->pluck('exception_words_ids');
            $exceptionWords = $exceptionWords->filter(fn($value) => !is_null($value));
            $exceptionWords = $exceptionWords->toArray();
            if(count($exceptionWords)) {
                $exceptionWords = explode(',', $exceptionWords[0]);
            }
            $keyWords = $filters->pluck('key_words_ids');
            $keyWords = $keyWords->filter(fn($value) => !is_null($value));
            $keyWords = $keyWords->toArray();
            if(count($keyWords)) {
                $keyWords = explode(',', $keyWords[0]);
            }
            $customKeyWords = $filters->pluck('custom_key_words_ids');
            $customKeyWords = $customKeyWords->filter(fn($value) => !is_null($value));
            $customKeyWords = $customKeyWords->toArray();
            if(count($customKeyWords)) {
                $customKeyWords = explode(',', $customKeyWords->toArray()[0]);
            }

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

            $jobs = Job::query()
                ->where('date_created', '<', Carbon::now()->subDays(14)->toDateTimeString())
                ->orderBy('date_created', 'desc')
                ->orderBy('id', 'desc');
            if (count($filterCategories)) {
                $jobs = $jobs->whereIn('subcategory2', $filterCategories);
            }
            if (count($filterCountries)) {
                $jobs = $jobs->whereIn('client_country', $filterCountries);
            }
            if(count($exceptionWords)) {
                $jobs->whereDoesntHave('exceptionWords', function ($query) use ($exceptionWords){
                    $query->whereIn('exception_word_job.exception_word_id', $exceptionWords);
                });
            }
            if(count($customKeyWords)) {
                $jobs->whereHas('customKeyWords', function ($subQuery) use ($customKeyWords){
                    $subQuery->whereIn('custom_key_word_job.custom_key_word_id', $customKeyWords);
                });
            }
            if(count($keyWords)) {
                $jobs->whereHas('keyWords', function ($subQuery) use ($keyWords){
                    $subQuery->whereIn('key_word_job.key_word_id', $keyWords);
                });
            }
            if($filters->pluck('is_hourly')[0] == 1 && $filters->pluck('is_fixed')[0] == 1) {
                $jobs->where(function($topQuery) use($filters) {
                    $topQuery->where(function($query) use($filters) {
                        if((integer)$filters->pluck('hourly_min')[0] > 0) {
                            $query->where('hourly_min', '<=', (integer)$filters->pluck('hourly_max')[0]);
                        }
                        if((integer)$filters->pluck('hourly_max')[0] > 0) {
                            $query->where('hourly_max', '>=', (integer)$filters->pluck('hourly_min')[0]);
                        }
                    });
                    $topQuery->orWhere(function($query) use($filters) {
                        if((integer)$filters->pluck('fixed_min')[0] > 0) {
                            $query->where('budget', '>=', (integer)$filters->pluck('fixed_min')[0]);
                        }
                        if((integer)$filters->pluck('fixed_max')[0] > 0) {
                            $query->where('budget', '<=', (integer)$filters->pluck('fixed_max')[0]);
                        }
                    });
                });
            }
            if($filters->pluck('is_hourly')[0] == 1 && $filters->pluck('is_fixed')[0] != 1) {
                $jobs->where(function($query) use($filters) {
                    if((integer)$filters->pluck('hourly_min')[0] > 0) {
                        $query->where('hourly_min', '<=', (integer)$filters->pluck('hourly_max')[0]);
                    }
                    if((integer)$filters->pluck('hourly_max')[0] > 0) {
                        $query->where('hourly_max', '>=', (integer)$filters->pluck('hourly_min')[0]);
                    }
                });
            }
            if($filters->pluck('is_fixed')[0] == 1 && $filters->pluck('is_hourly')[0] != 1) {
                $jobs->where(function($query) use($filters) {
                    if((integer)$filters->pluck('fixed_min')[0] > 0) {
                        $query->where('budget', '>=', (integer)$filters->pluck('fixed_min')[0]);
                    }
                    if((integer)$filters->pluck('fixed_max')[0] > 0) {
                        $query->where('budget', '<=', (integer)$filters->pluck('fixed_max')[0]);
                    }
                });
            }
            if($request->checkNewJobsCount) {
                $jobs->where('created_at', '>', $request->createdAt);
                return $jobs->where('is_taken', false)->count();
            }

            return $jobs->where('is_taken', false)->paginate(10);
        } catch (\Exception $exception) {
            return response()->json(['data' => $exception->getMessage()]);
        }
    }

    public function info()
    {
        $client = new Client();
        $user = Auth::user();
        $response = $client->request('GET', 'https://' . $user['pipedrive_domain'] . '.pipedrive.com/api/v1/dealFields', ['query' => ['api_token' => config('pipedrive.api_token')]])
            ->getBody()
            ->getContents();
        $dealFields = json_decode($response, true);
        $result = [];
        foreach ($dealFields['data'] as $field) {
            if($field['name'] === 'Bid profile') {
                $result['bidProfiles'] = $field['options'];
            }
            if($field['name'] === 'Label') {
                $result['labels'] = $field['options'];
            }
        }
        $response = $client->request('GET', 'https://' . $user['pipedrive_domain'] . '.pipedrive.com/api/v1/users', ['query' => ['api_token' => config('pipedrive.api_token')]])
            ->getBody()
            ->getContents();
        $usersData = json_decode($response, true);
        if ($usersData['success']){
            foreach ($usersData['data'] as $userItem){
                if($user->email == $userItem['email']){
                    $result['currentUser'] = $userItem;
                }
            }
        }

        return $result;
    }

    public function getJob($id)
    {
        return Job::find(['id'=>$id])->first();
    }

    public function storeDeal(Request $request)
    {
        try {
            $job = Job::find($request->jobId);
            $job->is_taken = true;
            $job->save();

            $newBid = new Bid();
            $newBid->owner = $request->owner;
            $newBid->technologies = $request->technologies;
            $newBid->creation_time = Carbon::now()->format('Y-m-d H:i:s');
            $newBid->bid_profile = $request->bidProfile['label'];
            $newBid->task_link = $request->taskLink;
            $newBid->is_invite = $request->invite == 'true';
            $newBid->message = $request->bidMessage;
            $newBid->job_id = $request->jobId;
            $newBid->save();

            $client = new Client();
            $user = Auth::user();
            $response = $client->request('GET', 'https://' . $user['pipedrive_domain'] . '.pipedrive.com/api/v1/dealFields', ['query' => ['api_token' => config('pipedrive.api_token')]])
                ->getBody()
                ->getContents();
            $dealFields = json_decode($response, true);
            $fieldsIds = [];
            $inviteId = null;
            foreach ($dealFields['data'] as $field) {
                if($field['name'] === 'Time of bid') {
                    $fieldsIds['timeOfBid'] = $field['key'];
                }
                if($field['name'] === 'Time of job creation' || $field['name'] === 'Time after job creation') {
                    $fieldsIds['timeOfJobCreation'] = $field['key'];
                }
                if($field['name'] === 'Bid profile') {
                    $fieldsIds['bidProfile'] = $field['key'];
                }
                if($field['name'] === 'Job posting') {
                    $fieldsIds['jobPosting'] = $field['key'];
                }
                if($field['name'] === 'Proposal link') {
                    $fieldsIds['proposalLink'] = $field['key'];
                }
                if($field['name'] === 'Invite') {
                    $fieldsIds['invite'] = $field['key'];
                    $inviteId = $field['options'][0]['id'];
                }
            }
            $jobCreationDate = strtotime($request->timeOfJob);
            $formattedDate = Carbon::parse($jobCreationDate)->format('Y-m-d H:i');
            $data = [
                'title' => $request->title,
                'user_id' => $request->userId,
                'label' => $request->label,
                $fieldsIds['timeOfBid'] => Carbon::now()->format('H:i'),
                $fieldsIds['timeOfJobCreation'] => $formattedDate,
                $fieldsIds['bidProfile'] => $request->bidProfile['id'],
                $fieldsIds['jobPosting'] => $request->jobPosting,
                $fieldsIds['proposalLink'] => $request->taskLink,
                $fieldsIds['invite'] => $request->invite == true ? $inviteId : null,
            ];
            $response = $client->request('POST', 'https://' . $user['pipedrive_domain'] . '.pipedrive.com/api/v1/deals', ['query' => ['api_token' => config('pipedrive.api_token')], 'json' => $data])
                ->getBody()
                ->getContents();
            $result = json_decode($response, true);
        } catch (\Exception $exception) {
            $result = $exception->getMessage();
        }

        return response()->json(['data' => $result]);
    }

    public function jobWithBid(Request $request)
    {
        try {
            $searchString = $request->input('query');
            $jobs = Job::query()->orderBy('date_created', 'desc');
            $jobs =  $jobs->has('bid');
            $jobs = $jobs->where(function($query) use($searchString) {
                $query->whereHas('bid', function ($subQuery) use($searchString) {
                    $subQuery->where('message', 'like', '%' . strtolower($searchString) . '%');
                });
                $query->orWhere('title', 'like', '%' . strtolower($searchString) . '%');
                $query->orWhere('excerpt', 'like', '%' . strtolower($searchString) . '%');
                $query->orWhere('skills', 'like', '%' . strtolower($searchString) . '%');
            });
            return $jobs->with('bid')->paginate(3);
        } catch (\Exception $exception) {
            return response()->json(['data' => $exception->getMessage()]);
        }
    }
}
