<?php

declare(strict_types=1);

namespace App\Http\Controllers\Game;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Repository\GameRepository;

class GameController extends Controller
{
    private GameRepository $gameRepository;

    public function __construct(GameRepository $repository)
    {
        $this->gameRepository = $repository;
    }

    public function dashboard()
    {
        // dd($this->gameRepository);

        $bestGames = Game::best()->get();


        $stat = [
            'count' => Game::count(),
            'countGT5' => Game::where('score','>',50)->count(),
            'max' => Game::max('score'),
            'min' => Game::min('score'),
            'avg' => Game::avg('score')
        ];

        $scoreStats =  Game::select(DB::raw('count(*) as count'),'score')
        ->having('count','>',1)
        ->groupBy('score')
        ->get();

        return view('game.dashboard',[
            'bestGames' => $bestGames,
            'scoreStats' => $scoreStats,
            'stats' => $stat]);
    }


    public function index()
    {

        $games = Game::with(['genre'])
        ->orderBy('created_at')
        ->paginate(10);

        return view('game.list',[
            'games' => $games]);
    }



    public function show(int $gameId, Request $request)
    {

        $game = $this->gameRepository ->get($gameId);

            return view('game.show',['game' => $game]);


    }

}
