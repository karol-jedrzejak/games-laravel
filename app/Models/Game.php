<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Scope\LastWeekScope;

class Game extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'description' ,
        'score',
        'publisher',
        'genre_id'
    ]; //filtracja co mozna dodaac prze Game::create

    protected $attributes = [
        'score' => 5
    ];

    protected static function booted()
    {
        static::addGlobalScope(new LastWeekScope());
    }

    // Realtions
    public function genre()
    {
        return $this->belongsTo(Genre::class,"genre_id","id"); //ale można puste bo z nazwy funkcji i dodaniu _id bierze pierwsze a drugie id domyślnieS
    }

    // Scopes
    public function scopeBest($query)
    {
        return $query->with('genre')->where([
            ['score','>',90],
            ['genre_id','>',0]
        ])->orderBy('score','desc');
    }


    public function scopeGenre($query,int $genre_id)
    {
        return $query->with('genre')->where('genre_id',$genre_id);
    }

    public function scopePublisher($query,string $name)
    {
        return $query->with('genre')->where('publisher',$name);
    }
}
