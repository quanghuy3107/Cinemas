<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'order_user';

    function insertOrder($data = [])
    {
        return DB::table($this->table)->insert($data);
    }

    function selectOrderByUser($id = 0)
    {
        $data = DB::table($this->table)->join('showtime', 'showtime.showtime_Id', '=', 'order_user.showtime_Id')->join('movie', 'movie.movie_Id', '=', 'showtime.movie_Id')->join('room', 'room.room_Id', '=', 'showtime.room_Id')->where('order_user.user_Id', $id)->get();

        return $data;
    }

    function selectOrder()
    {
        $data = DB::table($this->table)-> join('users','users.id', '=', 'order_user.user_Id') ->join('showtime', 'showtime.showtime_Id', '=', 'order_user.showtime_Id')->join('movie', 'movie.movie_Id', '=', 'showtime.movie_Id')->join('room', 'room.room_Id', '=', 'showtime.room_Id') ->get();

        return $data;
    }
}
