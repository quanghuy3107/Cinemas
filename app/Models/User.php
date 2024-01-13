<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $table = 'users';
    function getAllUser(){
        return DB::table($this->table) -> join('role','users.role_Id','=','role.role_Id') -> where('role.role_code','CLIENT') ->get();
    }

    function addUser($data = []){
        return DB::table($this->table)->insert($data);
    }

    function checkEmail($email = null){
        return DB::table($this->table) -> where('email',$email) -> first();
    }

    function updateUserById($id = 0, $data = [])  {
        return DB::table($this->table) -> where('id',$id) -> update($data);
    }

    function getUserById($id){
        return DB::table($this->table) -> where('id',$id) ->first();
    }
}
