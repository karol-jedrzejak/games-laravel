<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\GameRepository;
use App\Repository\Eloquent\GameRepository as EloquentGameRepository;
use App\Models\Game;
use App\Service\FakeService;

class GameServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //Nazwa klasy, nazwa implementacji
        //$this->app->bind(GameRepository::class,EloquentGameRepository::class);
        $this->app->bind(
            GameRepository::class,function($app){
                //$config = config('test');
                $fake = new FakeService('test');
                return new EloquentGameRepository($app->make(Game::class),$fake);
            });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
