<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $table ='genres_table'; //bo domyślnie bierze nazwa mdoelu z dodaną literką 's' na końcu
    protected $pimaryKey = 'id'; // tylko jeśli id hest w kolumnie innej niż id
    // created_at i updated_at są domyślnie ustawione a jeśli ich nie ma trzbaszą linijke
    // protected $timestamps = false;

    protected $attributes = [];

    public function games()
    {
        // return $this->hasMeany('App\Model\Game'); alternatywnie do tego poniżej


        // return $this->hasMeany(Game::class,"genre_id","id"); TEGO NIE MUSI BYĆ




        // bierze z nazwy modelu i nazwe robi lower case i dodaje _id
        // domyślnie z Genre bierze id
    }
}


