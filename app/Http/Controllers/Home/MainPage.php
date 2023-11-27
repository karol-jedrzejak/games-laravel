<?php

declare(strict_types=1);

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MainPage extends Controller
{
    public function __invoke(Request $request)
    {
        if (Auth::check()){
           // dd('jestem zalaogowany');
        }
        $user = Auth::user();
        //$user = $request->user();
        //$id = Auth::id();

        // dd($id);

        //Auth::logout();

        return view('home.main',['user' => $user]);
/*
         DB::table('genres_table')->truncate();  //usuwa i resetuje id
        // DB::table('genres_table')->delete(); //usuwa ale resetuje id

        DB::table('genres_table')->insert([
            'name' => 'rpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('genres_table')->insert([
        [
            'name' => 'fpp',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        ['name' => 'ttp',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()]
        ]);

        DB::table('genres_table')->insertOrIgnore([
            'name' => 'rpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //pozwala dodac mimo ze dodajemy klucz ktory powinien byc unikalny

        $id = DB::table('genres_table')->insertGetId([
            'name' => 'platform',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //pozwala dodac mimo ze dodajemy klucz ktory powinien byc unikalny


       DB::table('genres_table')
        ->where('id',5)
        ->update(['name' => 'sneak']);

        DB::table('genres_table')
        ->where('id',2)
        ->delete();
 */



/*         $db = \DB::connection('sqlite'); */

/*         dd($db); */
        //dump('#4343');
/*         $test = config('gameworld.mytest');

        dd($test); */

    }
}
