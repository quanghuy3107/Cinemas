<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'user';
    use HasFactory;
    function getAllUser(){
        return DB::table($this->table) -> join('role','user.role_Id','=','role.role_Id') -> where('role.role_code','USER') ->get();
    }

    function addUser($data = []){
        return DB::table($this->table)->insert($data);
    }

    
}
