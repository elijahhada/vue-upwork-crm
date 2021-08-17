<?php

namespace App\Services;

use Upwork\API\Config;

abstract class Upwork 
{
    protected $client;

    public function __construct()
    {
        $config = new Config([
            'clientId' => config('upwork.client_id'),
            'clientSecret' => config('upwork.client_secret'),
            'redirectUri' => 'https://upwork.vasterra.com/auth/callback',
            'mode' => 'web',
            'code' => session()->get('upwork_code'),
            'accessToken' => $this->getOAuthToken()->access_token,
            'refreshToken' => $this->getOAuthToken()->refresh_token,
            'expiresIn' => $this->getOAuthToken()->expires_in,
        ]);
        $this->client = new \App\Services\Upwork\Client($config);
    }

    public function setOAuthToken($token)
    {
        session()->put('upwork_token', (object) $token);
        Config::set('accessToken', $token['access_token']);
        Config::set('refreshToken', $token['refresh_token']);
        Config::set('expiresIn', $token['expires_in']);
        if (\Illuminate\Support\Facades\Auth::check()) {
            \Illuminate\Support\Facades\Auth::user()->update([
                'upwork_token' => $token['access_token'],
            ]);
        }
    }

    public function getOAuthToken()
    {
        return session()->has('upwork_token')
            ? session()->get('upwork_token')
            : (object) [
                'access_token' => null,
                'refresh_token' => null,
                'expires_in' => null,
            ];
    }
}