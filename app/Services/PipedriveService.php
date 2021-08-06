<?php


namespace App\Services;


use Illuminate\Support\Facades\Session;
use Pipedrive\Client;
use Pipedrive\Configuration;

class PipedriveService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(config('pipedrive.client_id'), config('pipedrive.client_secret'), url('/') . '/auth/pipedrive/callback');
        $this->setOAuthToken(Session::get('pipedrive_token'));
    }

    public function buildAuthUrl()
    {
        return $this->client->auth()->buildAuthorizationUrl();
    }

    public function authorize($code)
    {
        $this->setOAuthToken($this->client->auth()->authorize($code));
        return $this;
    }

    public function setOAuthToken($token)
    {
        Session::put('pipedrive_token', $token);
        Configuration::$oAuthToken = $token;
    }

    public function getOAuthToken()
    {
        return Session::get('pipedrive_token');
    }

    public function userInfo()
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
