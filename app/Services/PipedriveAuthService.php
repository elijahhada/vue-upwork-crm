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
        Configuration::$oAuthToken->accessToken = $token->accessToken;
        Configuration::$oAuthToken->tokenType = $token->tokenType;
        Configuration::$oAuthToken->expiresIn = $token->expiresIn;
        Configuration::$oAuthToken = $token->scope;
        Configuration::$oAuthToken->scope = $token->expiry;
        Configuration::$oAuthToken->refreshToken = $token->refreshToken;
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
