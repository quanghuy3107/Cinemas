<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\CommentModel;

class CommentController extends Controller
{
    //
    private $comment;
    
    public function __construct(){
        $this -> comment = new CommentModel();
    }

    public function AddComment(Request $request){
        $request -> validate(
            ['content' => 'required'],
        );

        $data = [
            'user_Id' => $request -> user_Id,
            'movie_Id' => $request -> movie_Id,
            'content' => $request -> content,
            'date_of_comment' => date('Y-m-d H:i:s')
        ];

        $statusAdd = $this -> comment -> addComment($data);
        return redirect() -> back();
    }

    public function deleteComment($id = 0){
        $this -> comment -> deleteCommentById($id);
        return redirect() -> back();
    }
}
