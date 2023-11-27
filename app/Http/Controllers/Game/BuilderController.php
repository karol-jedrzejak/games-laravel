<?php

declare(strict_types=1);

namespace App\Http\Controllers\Game;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class BuilderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        //$games = DB::table('games')->select('id','title','score','genre_id')->get();

        $bestGames = DB::table('games')
        ->join('genres_table','games.genre_id','=','genres_table.id')
        ->select('games.id','games.title','games.score','games.genre_id',
        'genres_table.id as genres_id_numb','genres_table.name as genres_name')
        //         ->where('score',90) -> skrótowo jeśli równa się
        ->where([
            ['score','>',90],
            ['genre_id','>',0]
            ])
        ->orWhere('score','<',0)
        ->get();
       // jak sie zrobi bez geta to tym na dole można podejrzeć jakie sqlowe zapytanie robimy dd($bestGames->toSql());


/*         $query = DB::table('games')
        ->join('genres_table','games.genre_id','=','genres_table.id')
        ->select('games.id','games.title','games.score','games.genre_id',
        'genres_table.id as genres_id_numb','genres_table.name as genres_name')
        ->whereIn('games.id',[22,23,24])
        ->get();

        dd($query); */

        $stat = [
            'count' => DB::table('games')->count(),
            'countGT5' => DB::table('games')->where('score','>',50)->count(),
            'max' => DB::table('games')->max('score'),
            'min' => DB::table('games')->min('score'),
            'avg' => DB::table('games')->avg('score')
        ];

        $scoreStats = DB::table('games')
        ->select(DB::raw('count(*) as count'),'score')
        ->having('count','>',1)
        ->groupBy('score')
        ->get();

/*         dd($scoreStats); */

        return view('game.builder.dashboard',[
            'bestGames' => $bestGames,
            'scoreStats' => $scoreStats,
            'stats' => $stat]);
    }


    public function index()
    {

        $games = DB::table('games')
        ->join('genres_table','games.genre_id','=','genres_table.id')
        ->select('games.id','games.title','games.score','games.genre_id',
        'genres_table.id as genres_id_numb','genres_table.name as genres_name')
        ->orderBy('score','desc')
/*         ->limit(10)
        ->offset(10) */
        ->paginate(10);

        return view('game.builder.list',[
            'games' => $games]);
    }



    /**
     * Display the specified resource.
     */
    public function show(int $gameId)
    {
       //  $game = DB::table('games')->where('id',$gameId)->first();

        $game = DB::table('games')->find($gameId);  //wyszukuje po id

        return view('game.builder.show',['game' => $game]);
    }

}
