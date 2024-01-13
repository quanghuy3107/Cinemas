<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShowTimeModel extends Model
{
    protected $table = 'showtime';
    use HasFactory;
    function getShowtimeByMovie($id = 0, $date = 0){
        
        if(empty($date)){
            $showtime = DB::table($this->table) -> where('movie_Id',$id) ->get();
        }else{       
            $showtime = DB::select("SELECT * FROM cinemas.showtime WHERE movie_Id = ? AND DATE(showtime) = ?", [$id, $date]);   
        }
        
        return $showtime;
    }

    function insertGetIdShowtime($data = []){
        $id = DB::table($this->table)->insertGetId($data);
        return $id;
    }

    function getShowtime($id = 0){
            $showtime = DB::table($this->table) -> where('showtime_Id',$id) ->get();   
        return $showtime;
    }

    function findShowTimeById($id){
        $data  = DB::table($this->table) -> join('room', 'room.room_Id', '=', 'showtime.room_Id') -> join('movie', 'movie.movie_Id','=','showtime.movie_Id') -> where('showtime.showtime_Id',$id) ->first();   
        return $data;
    }
}
