<?php


namespace App\Contracts;

interface OAuthable
{
    public function buildAuthUrl();

    public function authorize($code);

    public function setOAuthToken($token);

    public function getOAuthToken();
}
