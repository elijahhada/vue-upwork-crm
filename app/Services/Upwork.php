<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Upwork\API\Config;
use App\Services\Upwork\Client;

abstract class Upwork
{
    protected $client;

    public function __construct()
    {
        $config = new Config([
            'clientId' => config('upwork.client_id'),
            'clientSecret' => config('upwork.client_secret'),
            'redirectUri' => url('/') . '/auth/callback',
            'mode' => 'web',
            'code' => session()->get('upwork_code'),
            'accessToken' => $this->getOAuthToken()->access_token,
            'refreshToken' => $this->getOAuthToken()->refresh_token,
            'expiresIn' => $this->getOAuthToken()->expires_in,
        ]);
        $this->client = new Client($config);
    }

    public function setOAuthToken($token)
    {
        session()->put('upwork_token', (object) $token);
        Config::set('accessToken', $token['access_token']);
        Config::set('refreshToken', $token['refresh_token']);
        Config::set('expiresIn', $token['expires_in']);

        if (Auth::check()) {
            Auth::user()->update([
                'upwork_token' => $token,
            ]);
        }
    }

    public function getOAuthToken()
    {
        if (Auth::check() && !session()->has('upwork_token') && Auth::user()->upwork_token) {
            $this->setOAuthToken(Auth::user()->upwork_token);
        }

        return session()->has('upwork_token')
            ? session()->get('upwork_token')
            : (object) [
                'access_token' => null,
                'refresh_token' => null,
                'expires_in' => null,
            ];
    }
}