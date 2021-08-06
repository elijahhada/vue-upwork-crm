<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\PipedriveService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pipedrive\Client;

class PipedriveController extends Controller
{
    public function index()
    {
        return redirect()->to((new PipedriveService())->buildAuthUrl());
    }

    public function callback(Request $request, PipedriveService $service)
    {
        $userInfo = $service->authorize($request->code)->userInfo();

        abort_if(!$userInfo, 404, 'Whoops, we get an error!');

        $user = User::query()->where('email', $userInfo->data->email)->first();

        if (!$user) {
            $user = (new CreateNewUser())->create([
                'name' => $userInfo->data->name,
                'email' => $userInfo->data->email,
                'pipedrive_token' => $service->getOAuthToken()->accessToken,
                'password' => '123123123',
                'password_confirmation' => '123123123',
                'pipedrive_id' => $userInfo->data->id,
                'pipedrive_domain' => $userInfo->data->companyDomain,
            ]);
        }

        Auth::login($user, true);

        return redirect()->route('dashboard');
    }
}
