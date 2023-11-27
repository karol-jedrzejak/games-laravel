<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Game;

class GameRepository
{
    private Game $gameModel;

    public function __construct(Game $gameModel)
    {
       $this->gameModel = $gameModel;
    }



    public function get(int $id)
    {
       return $this->gameModel->find($id);
    }

    public function all()
    {

    }

    public function allPaginated()
    {

    }

    public function best()
    {

    }

    public function stats()
    {

    }

    public function scoreStats()
    {

    }
}
