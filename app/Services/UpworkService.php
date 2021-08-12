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
            'debug' => true,
        ]);
        $this->client = new Client($config);
    }

    public function buildAuthUrl(): string
    {
        return $this->client->getServer()->getInstance()->getAuthorizationUrl();
    }
}
