<?php

declare(strict_types=1);

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Repository\Builder\GameRepository;

class Game extends Facade
{
    protected static function getFacadeAccessor()
    {
        //return 'game';
        return GameRepository::class;
    }
}

