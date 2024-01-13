<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DetailRevenueModel extends Model
{
    use HasFactory;
    protected $table = 'detail_revenue';

    function insertDetailRevenue($data = []){
        return DB::table($this->table)->insert($data);
    }
}
