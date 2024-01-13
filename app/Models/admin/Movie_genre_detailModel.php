<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movie_genre_detailModel extends Model
{
    use HasFactory;

    protected $table = 'movie_genre_detail';

    function insertMovie_genre_detail($data = []){
        return DB::table($this->table)->insert($data);
    }

    function deleteMovie_genre_detailByMovie($id){
        return DB::table($this->table) -> where('movie_Id',$id) -> delete();
    }

    function deleteMovie_genre_detailByGenre($id){
        return DB::table($this->table) -> where('genre_Id',$id) -> delete();
    }
    function deleteMovie_genre_detailByMovieAndGenre($genre,$movie){
        return DB::table($this->table) -> where([['genre_Id','=',$genre], ['movie_Id','=',$movie]]) -> delete();
    }
}
