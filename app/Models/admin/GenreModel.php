<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class GenreModel extends Model
{
    use HasFactory;

    protected $table = 'genre';

    function getAllGenre(){
        return DB::table($this->table) ->get();
    }

    function addGenre($data = []){
        return DB::table($this->table)->insert($data);
    }

    function deleteGenre($id){
        return DB::table($this->table) -> where('genre_Id',$id) -> delete();
    }

    function findGenreById($id){
        $genre = DB::table($this->table) -> where('genre_Id',$id) ->get();
        return $genre[0];
    }

    function updateGenreById($id, $data)  {
        return DB::table($this->table) -> where('genre_Id',$id) -> update($data);
    }
}
