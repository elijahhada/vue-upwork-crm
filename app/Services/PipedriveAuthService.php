<?php

namespace App\Services;

use App\Contracts\OAuthable;
use Illuminate\Support\Facades\Session;
use Pipedrive\Client;
use Pipedrive\Configuration;
use Pipedrive\Models\OAuthToken;

class PipedriveAuthService implements OAuthable
{
    private $client;

    public function __construct()
    {
        $this->setOAuthToken(Session::get('pipedrive_token'));
        $this->client = new Client(config('pipedrive.client_id'), config('pipedrive.client_secret'), url('/') . '/auth/pipedrive/callback');
    }

    public function buildAuthUrl()
    {
        return $this->client->auth()->buildAuthorizationUrl();
    }

    public function authorize($code): OAuthable
    {
        $this->setOAuthToken($this->client->auth()->authorize($code));
        return $this;
    }

    public function setOAuthToken($token)
    {
        Session::put('pipedrive_token', $token);
        Configuration::$oAuthToken->accessToken = '10061094:11350968:b19c8db49d677d7501b6adc7b4d4fada1c4ce5d4';
        Configuration::$oAuthToken->tokenType = 'Bearer';
        Configuration::$oAuthToken->expiresIn = 3599;
        Configuration::$oAuthToken = 'base,deals:full,leads:full';
        Configuration::$oAuthToken->scope = 1638524650;
        Configuration::$oAuthToken->refreshToken = '10061094:11350968:e09b788649b6dca57d571b5a5a9178d637b6b650';
//        Configuration::$oAuthToken = $token;
    }

    public function getOAuthToken()
    {
        return Session::get('pipedrive_token');
    }

    public function getUserInfo()
    {
        try {
            return $this->client->getUsers()->getCurrentUserData();
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function addDeal($data)
    {
        return $this->client->getDeals()->addADeal($data);
    }
}
