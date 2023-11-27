<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres_table')->truncate();  //usuwa i resetuje id
        DB::table('genres_table')->insert([
            ['name' => 'rpg','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name' => 'fpp','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name' => 'adventure','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name' => 'tpp','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name' => 'platform','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name' => 'racing','created_at' => Carbon::now(),'updated_at' => Carbon::now()]]);
    }
}
