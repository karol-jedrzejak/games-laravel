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
        //dump('reg');
        //Nazwa klasy, nazwa implementacji
        $this->app->bind(GameRepository::class,EloquentGameRepository::class);

/*         $this->app->bind(
            GameRepository::class,function($app){
                dump('reg - bind');
                $gamemodel = $app->make(Game::class);
                return new EloquentGameRepository($gamemodel);
            }); */

        /* $this->app->bind(
            GameRepository::class,function($app){
                //$config = config('test');
                $gamemodel = $app->make(Game::class);
                $fake = $app->make(FakeService::class);
                return new EloquentGameRepository($gamemodel,$fake);
            }); */
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //dump('boot');
    }
}
