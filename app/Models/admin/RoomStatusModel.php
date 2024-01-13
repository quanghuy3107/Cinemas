<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RoomStatusModel extends Model
{
    use HasFactory;

    protected $table = 'room_status';

    function getAllRoomStatus(){
        return DB::table($this->table)->get();
    }
}
