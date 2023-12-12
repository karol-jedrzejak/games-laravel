<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\FakeService;

class FakeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            FakeService::class,
            function($pp) {
                return new FakeService('parametr');
            }
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
