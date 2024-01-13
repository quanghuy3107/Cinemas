<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RowOfSeatModel extends Model
{
    use HasFactory;
    protected $table = 'row_of_seat';

    function insertGetIdRowOfSeat($data = []){
        $id = DB::table($this->table)->insertGetId($data);
        return $id;
    }

    function selectRowOfSeatByShowtime($id){
        return DB::table($this->table) -> where('showtime_Id',$id) -> get();
    }
}
