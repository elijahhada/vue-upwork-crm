<?php

namespace App\Contracts;

interface OAuthable
{
    public function buildAuthUrl();

    public function authorize($code): OAuthable;

    public function setOAuthToken($token);

    public function getOAuthToken();

    public function getUserInfo();
}