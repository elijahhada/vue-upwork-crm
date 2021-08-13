<?php

namespace App\Providers;

use App\Contracts\OAuthable;
use App\Http\Controllers\Auth\PipedriveController;
use App\Http\Controllers\Auth\UpworkController;
use App\Services\PipedriveService;
use App\Services\UpworkService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(UpworkController::class)
            ->needs(OAuthable::class)
            ->give(UpworkService::class);

        $this->app->when(PipedriveController::class)
            ->needs(OAuthable::class)
            ->give(PipedriveService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        URL::forceScheme('https');
    }
}
