<?php


namespace App\Services;


use App\Contracts\OAuthable;
use Upwork\API\Client;
use Upwork\API\Config;

class UpworkService implements OAuthable
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

    public function buildAuthUrl(): string
    {
        return $this->client->getServer()->getInstance()->getAuthorizationUrl();
    }

    public function authorize($code)
    {
        $this->setOAuthToken($this->client->getServer()->_setupTokens($code));
        return $this;
    }

    public function setOAuthToken($token)
    {
        dd($token);
    }

    public function getOAuthToken()
    {
        // TODO: Implement getOAuthToken() method.
    }
}
