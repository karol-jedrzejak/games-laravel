<?php

declare(strict_types=1);

namespace App\Repository\Builder;

use App\Models\Game;
use App\Repository\GameRepository as GameRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use \stdClass;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class GameRepository implements GameRepositoryInterface
{
    private Game $gameModel;

    public function __construct(Game $gameModel)
    {

    }

    public function get(int $id)
    {
        $data = DB::table('games')
        ->join('genres_table','games.genre_id','=','genres_table.id')
        ->select('games.id','games.title','games.score','games.genre_id','games.publisher','games.description',
        'genres_table.id as genres_id_numb','genres_table.name as genres_name')
        ->where('games.id',$id)->limit(1)->first();

        return $this->createGame($data);
    }

    public function all()
    {
        return DB::table('games')
        ->join('genres_table','games.genre_id','=','genres_table.id')
        ->select('games.id','games.title','games.score','games.genre_id',
        'genres_table.id as genres_id_numb','genres_table.name as genres_name')
        ->latest('games.created_at')
        ->get()->map(fn($row) => $this->createGame($row));
    }

    public function allPaginated(int $limit)
    {

        $pageName ='page';
        $currentPage = Paginator::resolveCurrentPage($pageName);


        $baseQuerry = DB::table('games')
        ->join('genres_table','games.genre_id','=','genres_table.id');

        $total = $baseQuerry->count();

        $data = collect();

        if($total)
        {
            $data = $baseQuerry->select('games.id','games.title','games.score','games.genre_id',
            'genres_table.id as genres_id_numb','genres_table.name as genres_name')
            ->latest('games.created_at')
            ->forPage($currentPage,$limit)
            ->get()
            ->map(fn($row) => $this->createGame($row));
        }

        return new LengthAwarePaginator(
            $data,
            $total,
            $limit,
            $currentPage,
            ['path' =>Paginator::resolveCurrentPath(),
            'page' => $currentPage],

        );
    }

    public function best()
    {
        $data =  DB::table('games')
        ->join('genres_table','games.genre_id','=','genres_table.id')
        ->select('games.id','games.title','games.score','games.genre_id',
        'genres_table.id as genres_id_numb','genres_table.name as genres_name')
        ->where([
            ['score','>',90],
            ['genre_id','>',0]
            ])
        ->orWhere('score','<',0)
        ->get()->map(fn($row) => $this->createGame($row));


        return $data;
    }

    public function stats()
    {
        return [
            'count' => DB::table('games')->count(),
            'countGT5' => DB::table('games')->where('score','>',50)->count(),
            'max' => DB::table('games')->max('score'),
            'min' => DB::table('games')->min('score'),
            'avg' => DB::table('games')->avg('score')
        ];
    }

    public function scoreStats()
    {
        return DB::table('games')
        ->select(DB::raw('count(*) as count'),'score')
        ->having('count','>',1)
        ->groupBy('score')
        ->get();
    }

    private function createGame($game)
    {

        $genre = new stdClass();
        $genre->id = $game->genre_id;
        $genre->name = $game->genres_name;
        $game->genre = $genre;
        unset($game->genre_id, $genres_name);
        return $game;
    }
}
