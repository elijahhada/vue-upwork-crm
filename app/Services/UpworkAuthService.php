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
        parent::setOAuthToken($token);
    }

    public function getOAuthToken()
    {
        parent::getOAuthToken();
    }

    public function getUserInfo()
    {
        $token = $this->client->auth();
        return (new Users($this->client))->getMyInfo();
    }
}
