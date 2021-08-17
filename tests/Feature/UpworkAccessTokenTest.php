<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\UpworkAuthService;

class UpworkAccessTokenTest extends TestCase
{
    public function test_access_token_with_init()
    {
        $service = new UpworkAuthService();

        $service->setOAuthToken([
            'access_token' => '1',
            'refresh_token' => '2',
            'expires_in' => '3',
        ]);

        $this->assertObjectHasAttribute('access_token', $service->getOAuthToken());
        $this->assertObjectHasAttribute('refresh_token', $service->getOAuthToken());
        $this->assertObjectHasAttribute('expires_in', $service->getOAuthToken());
    }

    public function test_access_token_without_init()
    {
        $service = new UpworkAuthService();

        $this->assertObjectHasAttribute('access_token', $service->getOAuthToken());
        $this->assertObjectHasAttribute('refresh_token', $service->getOAuthToken());
        $this->assertObjectHasAttribute('expires_in', $service->getOAuthToken());
    }
}
