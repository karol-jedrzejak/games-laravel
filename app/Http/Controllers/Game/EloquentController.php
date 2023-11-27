<?php

declare(strict_types=1);

namespace App\Http\Controllers\Game;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Game;

class EloquentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {


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

        return view('game.eloquent.dashboard',[
            'bestGames' => $bestGames,
            'scoreStats' => $scoreStats,
            'stats' => $stat]);
    }


    public function index()
    {
        /*
        $newGame = new Game();
        $newGame->title = 'Tomb Raider';
        $newGame->description = 'Przygoda, skarby';
        $newGame->score = 9;
        $newGame->publisher = 'Edios';
        $newGame->genre_id = 4;
        $newGame->save();
        */

        /*
        Game::create([
            'title' => 'Tomb Raider 2',
            'description' => 'Przygoda, skarby',
            'score' => 8,
            'publisher' => 'Edios',
            'genre_id' => 4
        ]);
        */

        /*
        $newGame = new Game([
            'title' => 'Tomb Raider 3',
            'description' => 'Przygoda, skarby',
            'score' => 7,
            'publisher' => 'Edios',
            'genre_id' => 4
        ]);
        $newGame->save();
        */

/*         $game = Game::find(12);
        $game->description ='opis po aktualizacji';
        $game->save(); */

/*         $gameToChange = [11,13,15];

        Game::whereIn('id',$gameToChange)->update([
            'description' =>'dzilachba'
        ]); */


/* $game = Game::find(55);
$game->delete(); */

//Game::destroy(53);


//Game::whereIn('id',['111','112'])->delete();

        $games = Game::with(['genre'])
        ->orderBy('created_at')
        ->paginate(10);

        return view('game.eloquent.list',[
            'games' => $games]);
    }



    /**
     * Display the specified resource.
     */
    public function show(int $gameId, Request $request)
    {
        $isAjax = false;
        if($request->ajax())
        {
            $isAjax = true;
        }

        $game = Game::find($gameId);


        if($isAjax)
        {
            return $game;
        }
        else
        {
            return view('game.eloquent.show',['game' => $game]);
        }

    }

}
