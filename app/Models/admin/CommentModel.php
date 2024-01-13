<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CommentModel extends Model
{
    use HasFactory;

    protected $table = 'comment';

    function findCommentById($id){
        $comment = DB::table($this->table) -> join('users', 'users.id', '=', 'comment.user_Id') -> where('comment.movie_Id',$id) ->get();
        return $comment;
    }

    function deleteCommentById($id){
        return DB::table($this->table) -> where('comment_Id',$id) -> delete();
    } 

    function addComment($data = []){
        return DB::table($this->table)->insert($data);
    }
}
