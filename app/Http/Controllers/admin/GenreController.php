<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\admin\GenreModel;
use App\Models\admin\Movie_genre_detailModel;
use App\Http\Requests\admin\GenreRequest;
use Illuminate\Foundation\Http\FormRequest;


class GenreController extends Controller
{
    private $genre;
    private $movie_genre_detail;
    public function __construct()
    {
        $this -> genre = new GenreModel();
    }

    function index(){
        $title = "Trang danh sách thể loại";
        $data = $this -> genre -> getAllGenre();
        return view('admins.genre.genre',compact('title','data'));
    }

    function add(){
        $title = "Trang thêm thể loại phim";
        
        return view('admins.genre.add',compact('title'));
    }

    function addPost(Request $request, GenreRequest $FormRequest){
        $data = [];
        if ($request->isMethod('post')) {
            $name = $request -> name;
            $data = [
                'genre_name' => $name
            ];

            $addStatus = $this -> genre -> addGenre($data);

            if($addStatus){
                $msg = 'Thêm thể loại phim thành công';
                $type = 'success';
            }else{
                $msg = 'Thêm thể loại phim thất bại';
                $type = 'danger';
            }
        }else{
            // chưa được xử lí
        }
        return redirect() -> route('admin.addGenre') -> with('msg',$msg) -> with('type', $type);
    }

    function delete($id = 0) {
        if(!empty($id)){
            $deleteStatus = $this -> genre -> deleteGenre($id);
            if($deleteStatus){
                $msg = 'xóa thể loại phim thành công';
                $type = 'success';
            }else{
                $msg = 'bạn không thể xóa thể loại phim này';
                $type = 'danger';
            }
        }else{
            $msg = "Liên kết không tồn tại";
            $type = 'danger';
        }

        return redirect() -> route('admin.genre') -> with('msg',$msg) -> with('type', $type);
    }

    function update($id = 0){
        $title = "Trang chỉnh sửa thể loại";
        if(!empty($id)){
            $data = $this -> genre ->findGenreById($id);
            if(empty($data)){
                return redirect() -> route('admin.genre') -> with('msg','Danh mục không tồn tại.') -> with('type','danger');
            }
        }else{
            $msg = "Liên kết không tồn tại";
            $type = 'danger';
            return redirect() -> route('admin.genre') -> with('msg',$msg) -> with('type', $type);
        }
        return view('admins.genre.update',compact('title','data'));
        
    }

    function updatePost(Request $request, GenreRequest $FormRequest){
        $id = $request -> id;
        if(!empty($id)){
            $data = [
                'genre_name' => $request -> name
            ];
            $updateStatus = $this -> genre -> updateGenreById($id,$data);
            if($updateStatus){
                return back() -> with('msg','Cập nhật thể loại thành công') -> with('type','success');
            }else{
                return back() -> with('msg','Cập nhật thể loại không thành công') -> with('type','danger');
            }
        }else{
            $msg = "Liên kết không tồn tại";
            $type = 'danger';
            return redirect() -> route('admin.genre') -> with('msg',$msg) -> with('type', $type);
        }
    }
}
