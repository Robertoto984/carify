<?php

namespace App\Providers;

use App\Services\Driver\AddDriverService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AddDriverService::class, function ($app) {
        return new AddDriverService();
    });
    }

    public function boot(): void
    {
        //
    }
}
