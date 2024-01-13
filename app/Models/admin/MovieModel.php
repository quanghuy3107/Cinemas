<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MovieModel extends Model
{
    use HasFactory;

    protected $table = 'movie';

    function getAllMovie(){
        return DB::table($this->table) ->get();
    }

    function insertGetIdMovie($data = []){
        $id = DB::table($this->table)->insertGetId($data);
        return $id;
    }

    function findMovieById($id){
        $movie = DB::table($this->table) -> leftJoin('category','movie.category_Id','=','category.category_Id') -> where('movie_Id',$id) ->get();
        return $movie[0];
    }

    function findGenreByIdMovie($id){
        $genre = DB::table($this->table) -> join('movie_genre_detail','movie_genre_detail.movie_Id','=','movie.movie_Id') -> join('genre','movie_genre_detail.genre_Id','=','genre.genre_Id') -> where('movie.movie_Id',$id) -> select('genre.*') ->get();
        return $genre;

    }

    function deleteMovie($id){
        return DB::table($this->table) -> where('movie_Id',$id) -> delete();
    }

    function updateMovieById($id, $data)  {
        return DB::table($this->table) -> where('movie_Id',$id) -> update($data);
    }

    function findMovieByIdCate($id){
        $movie = DB::table($this->table) -> leftJoin('category','movie.category_Id','=','category.category_Id') -> where('category.category_Id',$id) ->get();
        return $movie;
    }

    function findMovieByGenre($genre){
        $movie = DB::table($this->table) -> join('movie_genre_detail','movie_genre_detail.movie_Id','=','movie.movie_Id') ->select('movie.*') -> where('movie_genre_detail.genre_Id',$genre) -> get();
        return $movie;
    }
}
