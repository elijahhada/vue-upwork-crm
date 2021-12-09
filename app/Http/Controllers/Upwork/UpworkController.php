<?php

namespace App\Http\Controllers\Upwork;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\UpworkJobsService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function refresh()
    {
        try {
            $client = new Client();
            $user = Auth::user();
            $formParams = [
                'grant_type' => 'refresh_token',
                'refresh_token' => $user['upwork_token']['refresh_token'],
                'client_id' => config('upwork.client_id'),
            ];
            $updateTokenResponse = $client->request('POST', 'https://www.upwork.com/api/v3/oauth2/token', ['form_params' => $formParams]);
            $token = $user->upwork_token;
            $token['access_token'] = json_decode($updateTokenResponse->getBody()->getContents(), true)['access_token'];
            $user->upwork_token = $token;
            $user->save();
            $result = $user->upwork_token;
        } catch (\Exception $exception) {
            $result = $exception->getMessage();
        }

        return $result;
    }
}
