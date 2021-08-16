<?php


namespace App\Services;

use App\Contracts\OAuthable;
use Upwork\API\Config;
use Upwork\API\Routers\Organization\Users;

class UpworkAuthService extends Upwork implements OAuthable
{
    public function buildAuthUrl(): array
    {
        return $this->client->auth();
    }

    public function authorize($code): OAuthable
    {
        session()->put('upwork_code', $code);
        Config::set('code', $code);
        $this->setOAuthToken($this->client->auth());
        return $this;
    }

    public function setOAuthToken($token)
    {
        session()->put('upwork_token', (object) $token);
        Config::set('accessToken', $token['access_token']);
        Config::set('refreshToken', $token['refresh_token']);
        Config::set('expiresIn', $token['expires_in']);
        \Illuminate\Support\Facades\Auth::user()->update([
            'upwork_token' => $token['access_token'],
        ]);
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
        $token = $this->client->auth();
        return (new Users($this->client))->getMyInfo();
    }
}
