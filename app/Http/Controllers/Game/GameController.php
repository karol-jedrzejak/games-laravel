<?php

declare(strict_types=1);

namespace App\Http\Controllers\Game;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
//use App\Models\Game;
use App\Facades\Game;
use App\Repository\Eloquent\GameRepository;

class GameController extends Controller
{
    private GameRepository $gameRepository;

    public function __construct(GameRepository $repository)
    {
        $this->gameRepository = $repository;
    }

    public function dashboard()
    {
        return view('game.dashboard',[
            'bestGames' => $this->gameRepository ->best(),
            'scoreStats' => $this->gameRepository ->scoreStats(),
            'stats' => $this->gameRepository ->stats()]);
    }


    public function index()
    {
        return view('game.list',['games' => Game::allPaginated(10)]);
        //view('game.list',['games' => $this->gameRepository->allPaginated(10)]);
    }

    public function show(int $gameId, Request $request)
    {
        return view('game.show',['game' => $this->gameRepository ->get($gameId)]);
    }

}
