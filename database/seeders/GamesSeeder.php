<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use Illuminate\Database\Query\Builder;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        DB::table('games')->truncate();  //usuwa i resetuje id
/*
        for ($i=0; $i < 100; $i++) {
            DB::table('games')->insert([
                'title' => $faker->words($faker->numberBetween(1, 3),true),
                'description' => $faker->sentence(),
                'publisher' => $faker->randomElement(['Atari','Activision','Blizzard','Interplay'],null),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'genre_id' => $faker->numberBetween(1, 6)
            ]);
        } */

        $games=[];
        for ($i=0; $i < 50; $i++) {
            $games[] =
            [
                'title' => $faker->words($faker->numberBetween(1, 3),true),
                'description' => $faker->sentence(),
                'publisher' => $faker->randomElement(['Atari','Activision','Blizzard','Interplay'],null),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'genre_id' => $faker->numberBetween(1, 6),
                'score' => $faker->numberBetween(1, 100)
            ];
        }
        DB::table('games')->insert($games);
    }
}
