<?php


namespace App\Services;


use App\Contracts\OAuthable;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Upwork\API\Client;
use Upwork\API\Config;
use Upwork\API\Config as ApiConfig;
use Upwork\API\Debug as ApiDebug;
use Upwork\API\Routers\Auth;

class UpworkService implements OAuthable
{
    private $client;

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

    public function buildAuthUrl(): array
    {
        return $this->client->auth();
    }

    public function authorize($code)
    {
        session()->put('upwork_code', $code);
        $this->setOAuthToken($this->client->auth());
        return $this;
    }

    public function setOAuthToken($token)
    {
        session()->put('upwork_token', (object) $token);
        Config::set('accessToken', $token['access_token']);
        Config::set('refreshToken', $token['refresh_token']);
        Config::set('expiresIn', $token['expires_in']);
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

    public function getUserInfo()
    {
        return (new Auth($this->client))->getUserInfo();
    }
}
