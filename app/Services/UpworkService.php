<?php


namespace App\Services;


use Upwork\API\Client;
use Upwork\API\Config;

class UpworkService
{
    private $client;

    public function __construct()
    {
        $config = new Config([
            'clientId' => \config('upwork.client_id'),
            'clientSecret' => \config('upwork.client_secret'),
            'redirectUri' => 'https://upwork.vasterra.com/auth/callback',
        ]);
        $this->client = new Client($config);
    }

    public function buildAuthUrl()
    {
        dd($this->client->auth());
    }
}
