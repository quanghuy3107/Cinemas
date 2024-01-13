<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class RoomModel extends Model
{
    use HasFactory;

    protected $table = 'room';

    function getAllRoom(){
        return DB::table($this->table) -> join('room_status', 'room.room_status_Id', '=', 'room_status.room_status_Id') ->get();
    }

    function addRoom($data = []){
        return DB::table($this->table)->insert($data);
    }

    function deleteRoom($id = 0) {
        return DB::table($this->table) -> where('room_Id',$id) -> delete();
    }

    function findRoomById($id = 0){
        $room = DB::table($this->table) -> where('room_Id',$id) ->get();
        return $room[0];
    }

    function updateRoomById($id, $data)  {
        return DB::table($this->table) -> where('room_Id',$id) -> update($data);
    }

    function checkRoomByCode($room_code = 0){
        $room = DB::table($this->table) -> where('room_code',$room_code) ->get();
        return isset($room[0]) ? $room[0] : null;
    }

    function findRoomByStatus($status){
        return DB::table($this->table) -> join('room_status', 'room.room_status_Id', '=', 'room_status.room_status_Id') -> where('room_status.room_status_name',$status) ->get();
    }
}
