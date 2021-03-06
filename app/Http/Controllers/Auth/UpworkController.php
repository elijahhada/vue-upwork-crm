<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Fortify\CreateNewUser;
use App\Contracts\OAuthable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpworkController extends Controller
{
    private $service;

    public function __construct(OAuthable $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        dd($this->service->buildAuthUrl());
        return redirect()->to($this->service->buildAuthUrl());
    }

    public function callback(Request $request)
    {
        $upworkUserInfo = $this->service->authorize($request->code)->getUserInfo();

//        Auth::user()->update([
//            'upwork_id' => $upworkUserInfo->user->reference,
//        ]);
        (new CreateNewUser())->create([
            'name' => 'elijah',
            'email' => 'hadasevich.e@gmail.com',
            'upwork_token' => $this->service->getOAuthToken(),
            'password' => 'password',
            'password_confirmation' => 'password',
            'upwork_id' => 12345,
        ]);

        return redirect()
            ->route('dashboard')
            ->with('code', $request->code);
    }

    public function console(Request $request)
    {
        echo $request->code;
        die();
    }
}
