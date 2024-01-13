<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\MovieModel;
use App\Models\admin\GenreModel;
use App\Models\admin\CategoryModel;
use App\Http\Requests\admin\MovieRequest;
use App\Models\admin\Movie_genre_detailModel;
use Illuminate\Support\Facades\Redis;

class MovieController extends Controller
{
    private $movie;
    private $genre;
    private $category;
    private $movie_genre_detail;

    public function __construct()
    {
        $this->movie = new MovieModel();
    }

    function index()
    {
        $title = "Trang danh sách phim";
        $data = $this->movie->getAllMovie();
        return view('admins.movie.movie', compact('title', 'data'));
    }

    function add()
    {
        $this->genre = new GenreModel();
        $this->category = new CategoryModel();

        $title = "Trang thêm phim";
        $data['genre'] = $this->genre->getAllGenre();
        $data['category'] = $this->category->getAllCategory();
        return view('admins.movie.add', compact('title', 'data'));
    }

    function addPost(Request $request, MovieRequest $formRequest)
    {
        $file_name = null;
        // dd($request-> image -> file);
        if ($request->has('image')) {
            $file = $request->image;
            $ext = $request->image->extension();
            $file_name = md5(uniqid()) . '.' . $ext;
            $file->move(public_path('uploads'), $file_name);
        }


        if ($request->isMethod('post')) {
            $data = [
                'movie_name' => $request->movie_name,
                'director' => $request->director,
                'performers' => $request->performers,
                'movie_duration' => $request->movie_duration,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'describe_movie' => $request->describe_movie,
                'image' => $file_name,
                'category_Id' => $request->category
            ];
            $id = $this->movie->insertGetIdMovie($data);
            if (!empty($id)) {
                $this->movie_genre_detail = new Movie_genre_detailModel();
                foreach ($request->genre as $value) {
                    $dataDetail = [
                        'genre_Id' => $value,
                        'movie_Id' => $id,
                    ];
                    $statusInsert = $this->movie_genre_detail->insertMovie_genre_detail($dataDetail);
                }
                if ($statusInsert) {
                    $msg = 'Thêm phim thành công';
                    $type = 'success';
                } else {
                    $msg = 'Thêm phim thất bại';
                    $type = 'danger';
                }
            } else {
                $msg = 'Thêm phim thất bại';
                $type = 'danger';
            }

            return redirect()->route('admin.addMovie')->with('msg', $msg)->with('type', $type);
        } else {
            return redirect()->route('admin.index');
        }
    }

    function detail($id = 0)
    {
        $title = "Trang chi tiết phim";

        if ($id != 0) {
            $data['movie'] = $this->movie->findMovieById($id);
            $dataGenre = $this->movie->findGenreByIdMovie($id);
            $genre = '';
            if (!empty($dataGenre)) {
                for ($i = 0; $i < sizeof($dataGenre); $i++) {
                    $genre .= $dataGenre[$i]->genre_name . ',';
                }
                $genre = rtrim($genre, ',');
            }
            if (!empty($data)) {
                return view('admins.movie.detail', compact('title', 'data', 'genre'));
            }
        } else {
            $msg = "Liên kết không tồn tại";
            $type = 'danger';
            return redirect()->route('admin.movie')->with('msg', $msg)->with('type', $type);
        }
    }

    function delete($id = 0)
    {

        if ($id != 0) {
            $this->movie_genre_detail = new Movie_genre_detailModel();
            $deleteStatus = $this->movie_genre_detail->deleteMovie_genre_detailByMovie($id);
            $deleteStatusMovie = $this->movie->deleteMovie($id);
            if ($deleteStatus && $deleteStatusMovie) {
                $msg = 'xóa thể phim thành công';
                $type = 'success';
            } else {
                $msg = 'bạn không thể xóa phim này';
                $type = 'danger';
            }
        } else {
            $msg = "Liên kết không tồn tại";
            $type = 'danger';
        }

        return redirect()->route('admin.movie')->with('msg', $msg)->with('type', $type);
    }

    function update($id = 0)
    {
        $title = "Trang chỉnh sửa phim";
        if (!empty($id)) {
            $this->genre = new GenreModel();
            $this->category = new CategoryModel();
            $data['movie'] = $this->movie->findMovieById($id);
            $dataGenre = $this->movie->findGenreByIdMovie($id);
            $data['genre'] = $this->genre->getAllGenre();
            $data['category'] = $this->category->getAllCategory();

            if (empty($data)) {
                return redirect()->route('admin.movie')->with('msg', 'Phim không tồn tại.')->with('type', 'danger');
            } else {
                return view('admins.movie.update', compact('title', 'data', 'dataGenre'));
            }
        } else {
            $msg = "Liên kết không tồn tại";
            $type = 'danger';
            return redirect()->route('admin.movie')->with('msg', $msg)->with('type', $type);
        }
    }

    function updatePost(Request $request)
    {

        if ($request->isMethod('post')) {
            $id = $request->movie_Id;
            $data['movie'] = $this->movie->findMovieById($id);
            if (!$request->has('image')) {
                $file_name = $data['movie']->image;
            } else {
                $file = $request->image;
                $ext = $request->image->extension();
                $file_name = md5(uniqid()) . '.' . $ext;
                $file->move(public_path('uploads'), $file_name);
            }
            $data = [
                'movie_name' => $request->movie_name,
                'director' => $request->director,
                'performers' => $request->performers,
                'movie_duration' => $request->movie_duration,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'describe_movie' => $request->describe_movie,
                'image' => $file_name,
                'category_Id' => $request->category
            ];
            
            $statusUpdate =  $this -> movie -> updateMovieById($id,$data);
            
            $this->movie_genre_detail = new Movie_genre_detailModel();
            $genreOld = $this->movie->findGenreByIdMovie($id);

            $listGenreNew = $request->genre;
            //delete
            $statusDelete =null;
            for ($i = 0; $i < sizeof($genreOld); $i++) {
                $check = false;
                foreach ($listGenreNew as $genreNew) {

                    if ($genreOld[$i]->genre_Id == $genreNew) {

                        $check = true;
                        break;
                    }
                }
                if ($check == false) {
                    $statusDelete =  $this->movie_genre_detail -> deleteMovie_genre_detailByMovieAndGenre($genreOld[$i]->genre_Id, $id);
                }
                
            }


            //insert

            $statusInser =null;
            foreach ($listGenreNew as $genreNew) {
                $check = true;
                for ($i = 0; $i < sizeof($genreOld); $i++) {

                    if ($genreNew == $genreOld[$i]->genre_Id) {
                        $check = false;
                    }
                }
                if ($check == true) {
                    $statusInser = $this->movie_genre_detail ->  insertMovie_genre_detail(['genre_Id' => $genreNew,'movie_Id' =>$id]);
                }
            }
        
            if($statusUpdate or $statusInser or $statusDelete){
                return back() -> with('msg','Cập nhật phim thành công') -> with('type','success');
            }else{
                return back() -> with('msg','Cập nhật phim không thành công') -> with('type','danger');
            }
            
        } else {
            return redirect()->route('admin.index');
        }
    }
}
?>