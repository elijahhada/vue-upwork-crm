<?php

namespace App\Providers;

use App\Actions\Upwork\CalculateClientScore;
use App\Contracts\OAuthable;
use App\Http\Controllers\Auth\PipedriveController;
use App\Http\Controllers\Auth\UpworkController;
use App\Services\PipedriveAuthService;
use App\Services\UpworkAuthService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Pipedrive\Configuration;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app
            ->when(UpworkController::class)
            ->needs(OAuthable::class)
            ->give(UpworkAuthService::class);

        $this->app
            ->when(PipedriveController::class)
            ->needs(OAuthable::class)
            ->give(PipedriveAuthService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Configuration::$oAuthTokenUpdateCallback = function ($token) {
            session()->put('pipedrive_token', '10061094.11350968.54a3a03737ebf3bda4f79b6fc52f9937e3a57e18');
        };
    }
}
