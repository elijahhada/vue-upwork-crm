<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Fortify\CreateNewUser;
use App\Contracts\OAuthable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PipedriveController extends Controller
{
    private $service;

    public function __construct(OAuthable $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return redirect()->to($this->service->buildAuthUrl());
    }

    public function callback(Request $request)
    {
        $userInfo = $this->service->authorize($request->code)->getUserInfo();

        abort_if(!$userInfo, 404, 'Whoops, we get an error!');

        $user = User::query()
            ->where('email', $userInfo->data->email)
            ->first();
        $user->pipedrive_token = $this->service->getOAuthToken();
        $user->save();

        if (!$user) {
            $user = (new CreateNewUser())->create([
                'name' => $userInfo->data->name,
                'email' => $userInfo->data->email,
                'pipedrive_token' => $this->service->getOAuthToken(),
                'password' => 'password',
                'password_confirmation' => 'password',
                'pipedrive_id' => $userInfo->data->id,
                'pipedrive_domain' => $userInfo->data->companyDomain,
            ]);
        }

        Auth::login($user, true);

        return redirect()->route('dashboard');
    }
}
