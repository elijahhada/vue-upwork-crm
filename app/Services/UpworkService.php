<?php


namespace App\Services;


use App\Contracts\OAuthable;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Upwork\API\AuthTypes\AbstractOAuth;
use Upwork\API\Client;
use Upwork\API\Config;
use Upwork\API\Config as ApiConfig;
use Upwork\API\Debug as ApiDebug;

class UpworkService extends AbstractOAuth implements OAuthable
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
        $this->setOAuthToken($this->_setupTokens($code));
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

    protected function _setupTokens($authzCode)
    {
        return $this->_requestTokens('authorization_code', array('code' => $authzCode));
    }

    protected function _getOAuthInstance($authType)
    {
        // TODO: Implement _getOAuthInstance() method.
    }

    private function _requestTokens(string $type, array $options)
    {
        ApiDebug::p('requesting tokens');

        $accessTokenInfo = array();

        $accessToken = $this->client->getServer()->getInstance()->getHttpClient()->getConfig()['handler']->push(
            Middleware::mapRequest(function (RequestInterface $request) {
                return $request->withHeader('User-Agent', ApiConfig::UPWORK_LIBRARY_USER_AGENT);
            }));
        $accessToken = $this->client->getServer()->getInstance()->getAccessToken($type, $options);

        $accessTokenInfo['access_token']  = $accessToken->getToken();
        $accessTokenInfo['refresh_token'] = $accessToken->getRefreshToken();
        $accessTokenInfo['expires_in']    = $accessToken->getExpires();

        ApiDebug::p('got access token info', $accessTokenInfo);

        self::$_accessToken  = $accessTokenInfo['access_token'];
        self::$_refreshToken = $accessTokenInfo['refresh_token'];
        self::$_expiresIn    = $accessTokenInfo['expires_in'];

        return $accessTokenInfo;
    }
}
