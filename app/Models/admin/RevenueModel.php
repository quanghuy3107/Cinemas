<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RevenueModel extends Model
{
    use HasFactory;

    protected $table = 'revenue';

    function insertGetIdRevenue($data = []){
        $id = DB::table($this->table)->insertGetId($data);
        return $id;
    }
}
