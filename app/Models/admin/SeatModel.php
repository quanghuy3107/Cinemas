<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeatModel extends Model
{
    use HasFactory;

    protected $table = 'seat';

    function addSeat($data = []){
        return DB::table($this->table)->insert($data);
    }

    function selectSeatByRowOfSeat($id){
        return DB::table($this->table) -> where('row_of_seat_Id',$id) -> get();
    }

    function updateSeat($id, $data) {
        return DB::table($this->table) -> where('seat_Id',$id) -> update($data);
    }
}
