<?php

namespace App\Services;

use Upwork\API\Config;

abstract class Upwork 
{
    protected $client;

    public function __construct()
    {
        $config = new Config([
            'clientId' => \config('upwork.client_id'),
            'clientSecret' => \config('upwork.client_secret'),
            'redirectUri' => 'https://upwork.vasterra.com/auth/callback',
            'mode' => 'web',
            'code' => session()->get('upwork_code'),
            'accessToken' => $this->getOAuthToken()->access_token,
            'refreshToken' => $this->getOAuthToken()->refresh_token,
            'expiresIn' => $this->getOAuthToken()->expires_in,
        ]);
        $this->client = new \App\Services\Upwork\Client($config);
    }
}