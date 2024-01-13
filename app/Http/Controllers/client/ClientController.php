<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\client\RegisterRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\client\ChangePasswordNewRequest;
use App\Http\Requests\client\ChangeInformationRequest;

use App\Models\User;
use App\Models\admin\MovieModel;
use App\Models\admin\CategoryModel;
use App\Models\admin\GenreModel;
use App\Models\admin\ShowTimeModel;
use App\Models\admin\OrderModel;
use App\Models\admin\CommentModel;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\DateTime;


class ClientController extends Controller
{

    private $users;
    private $movie;
    private $category;
    private $genre;
    private $showtime;
    private $order;
    private $comment;

    public function __construct(){
        $this -> users = new User();
        $this -> movie = new MovieModel();
    }

//Trang chủ
    public function index($cate = 0){
        
        $title = 'Trang chủ';
        $this -> category = new CategoryModel();
        $this -> genre = new GenreModel();
        if(empty($cate)){
            $dataMovie = $this -> movie -> getAllMovie();
            $data['movie'] = $this -> genre($dataMovie);
        }else{
            //hiện thị phim theo danh mục
            $dataMovie = $this -> movie -> findMovieByIdCate($cate);
            $data['movie'] = $this -> genre($dataMovie);
        }
        

        $data['category'] = $this -> category -> getAllCategory();
        $data['genre'] = $this -> genre -> getAllGenre();
        return view('clients.index', compact('title', 'data','cate'));
    }

//Trang chi tiết phim
    public function movieDetail($id = 0,$date = null){
        $title = "Trang chi tiết phim";
        
        if ($id != 0) {
            //Lấy thông tin suất chiếu
            $this -> showtime = new ShowTimeModel();
            $listData = $this -> showtime -> getShowtimeByMovie($id);
            if($listData){
                $data['date'] = [];
                $i = 0;
                //thêm thời gian chiếu vào mảng
                foreach($listData as $item){
                    $dateString = $item->showtime;
                    $dateTime = new DateTime($dateString);
                    $newDateString = $dateTime->format('Y-m-d');
                    if (!in_array($newDateString, $data['date'])) {
                        $data['date'][$i] = $newDateString;
                    }
                    $i ++;
                }
               
                
                if(!empty($data['date'])){
                    if($date == null){
                        $data['showTime'] = $data['date'][0];
                        $data['listShowTime'] = $this -> showtime -> getShowtimeByMovie($id, $data['showTime']);
                        
                    }else{
                        $data['listShowTime'] = $this -> showtime -> getShowtimeByMovie($id, $date);
                        $data['showTime'] = $date;
                    }

                }
            }
            $data['movie'] = $this->movie->findMovieById($id);
            $dataGenre = $this->movie->findGenreByIdMovie($id);
            $genre = '';
            if (!empty($dataGenre)) {
                for ($i = 0; $i < sizeof($dataGenre); $i++) {
                    $genre .= $dataGenre[$i]->genre_name . ',';
                }
                $genre = rtrim($genre, ',');
            }
            $this -> comment = new CommentModel();
            $dataComment = $this -> comment -> findCommentById($id);
            if (!empty($data)) {
                return view('clients.detail', compact('title', 'data', 'genre', 'dataComment'));
            }
        } else {
            
            return redirect()->route('login');
        }
    }

//Trang đặt vé
    public function bookTicket($id = 0){
        $this -> showtime = new ShowTimeModel();
        $status = $this -> showtime -> getShowtime($id);
        if($status){
            $title = 'Trang đặt vé';
            $data = $this -> showtime -> findShowTimeById($id);
            
            
            $dataGenre = $this->movie->findGenreByIdMovie($data->movie_Id);
            $genre = '';
            if (!empty($dataGenre)) {
                for ($i = 0; $i < sizeof($dataGenre); $i++) {
                    $genre .= $dataGenre[$i]->genre_name . ',';
                }
                $genre = rtrim($genre, ',');
            }
            return view('clients.bookTicket', compact('title','id', 'data', 'genre'));
        }else{
            return redirect()->route('index');
        }
    }

//Tim kiem phim
    public function searchMovie(Request $request){
        if($request -> isMethod('GET')){
            $title = 'Trang tìm kiếm';
            $this -> category = new CategoryModel();
            $this -> genre = new GenreModel();
            $genre = $request -> genre;
            $dataMovie = [];
            $count = 0;
            $listIdMovie = [];
            foreach($genre as $id){
                
                $dataMovie = $this -> movie -> findMovieByGenre($id);
                foreach($dataMovie as $value){

                    if (!in_array($value->movie_Id, $listIdMovie)) {
                        $listIdMovie[] = $value->movie_Id;
                        $dataMovie[] = $value;
                    }
                }

            }

            $data['movie'] = $this -> genre($dataMovie);
            
            $data['category'] = $this -> category -> getAllCategory();
            $data['genre'] = $this -> genre -> getAllGenre();
            return view('clients.searchMovie', compact('title', 'data'));
        }else{
            return redirect() -> route('login');
        }
    }

// Đơn hàng của người dùng
public function orderOfUser(){
    $title = 'Trang đơn hàng';
    $this -> order = new OrderModel(); 
    $dataMovie = $this -> order -> selectOrderByUser(Auth::user()->id);
    $data = $this -> genre($dataMovie);;
    return view('clients.orderManagement', compact('title','data'));
}

//Lấy thể loại của phim
    public function genre($dataMovie){
        $data['movie'] = [];
        //đưa thể loại phim vào data['movie']
        $i = 0;
        foreach($dataMovie as $value){
            $dataGenre = $this->movie->findGenreByIdMovie($value->movie_Id);
            $genre = '';
            $data['movie'][$i]['movie'] = $value;
            if (!empty($dataGenre)) {
                $arrGenre = [...$dataGenre];
                for ($j = 0; $j < sizeof($arrGenre); $j++) {
                    $genre .= $dataGenre[$j]->genre_name . ',';
                }
                $genre = rtrim($genre, ',');
                $data['movie'][$i]['genre'] = $genre;
            }
            $i++;
        }   
        return $data['movie'];
    }

// Thay đổi mật khẩu mới
    public function changePasswordNew(){
        $title = "Thay đổi mật khẩu mới";
        
        return view('clients.changePasswordNew', compact('title'));
    }

    public function changePasswordNewPost(Request $request, ChangePasswordNewRequest $formRequest){
        $id = Auth::user()->id;
        $data = [
            'password' => bcrypt($request -> password),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $statusUpdate = $this -> users -> updateUserById($id, $data);
        if($statusUpdate){
            return redirect() -> back() -> with('msg','Thay đổi mật khẩu thành công') -> with('type', 'success');
        }else{
            return redirect() -> back() -> with('msg','Thay đổi mật khẩu thất bại') -> with('type', 'danger');
        }

    }

//Thay đổi thông tin người dùng
    public function changeInformation(){
        $title = 'Trang thay đổi mật khẩu';
        $id = Auth::user() -> id;
        $data = $this ->users -> getUserById($id);

        return view('clients.ChangeInformation',compact('title','data'));
    }

    public function changeInformationPost(Request $request, ChangeInformationRequest $formRequest){
        $id = Auth::user()->id;
        $data = [
            'name' => $request -> name,
            'email' => $request -> email,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $statusUpdate = $this -> users -> updateUserById($id, $data);
        if($statusUpdate){
            return redirect() -> back() -> with('msg','Thay đổi thông tin thành công') -> with('type', 'success');
        }else{
            return redirect() -> back() -> with('msg','Thay đổi thông tin thất bại') -> with('type', 'danger');
        }
    }

//Đăng ký
    public function register(){
        $title = 'Trang đăng ký';
        return view('clients.register', compact('title'));
    }

    public function addRegister(Request $request, RegisterRequest $formRequest){
        $data = [
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => bcrypt($request -> password),
            'created_at' => date('Y-m-d H:i:s'),
            'role_Id' => 1
        ];

        $statusAdd = $this -> users -> addUser($data);
        if($statusAdd){
            return redirect() -> route('login') -> with('msg','Đăng ký tài khoản thành công') -> with('type', 'success');
        }
    }

//Đăng nhập
    public function login(){
        $title = 'Trang đăng nhập';
        return  view('clients.login', compact('title'));
    }

    public function postLogin(Request $request){
        
        if(Auth::attempt(['email' => $request -> email, 'password' => $request -> password, 'user_status' => 'active']) ){
            if(Auth::user() -> role_Id == 1 ){
                return redirect() -> route('index');
            }else if(Auth::user() -> role_Id == 2){
                return redirect() -> route('admin.index');
            }
        }
        return redirect() -> route('login') -> with('msg','Đăng nhập tài khoản thất bại') -> with('type', 'danger');
        
    }

//Đăng xuất
    public function logout(){
        Auth::logout();
        return redirect() -> route('index');
    }

//Lấy lại mật khẩu
    public function passwordRetrieval(){
        $title = "Trang lấy lại mật khẩu";
        return  view('clients.passwordRetrieval', compact('title'));
    }

//Gửi mail lấy lại mật khẩu
    public function mail(Request $request){
        $email = $request -> email;
        $checkEmail = $this -> users -> checkEmail($email);
        if(!empty($checkEmail)){
            $id = $checkEmail->id;
            $name = $checkEmail->name;
            Mail::send('mails.passwordRetrieval',compact('name','id'), function ($e) use($id, $email, $name) {
                $e -> subject('Lấy lại mật khẩu');
                $e -> to($email, $name);
            });
        }
        return redirect() -> back() ->with("msg","Hệ thống đã gửi tin nhắn đến mail của quý khách") -> with("type","success");
    }

//Thay đổi mật khẩu khi xác nhận mail
    public function changePassword(Request $request){
        $title = "Trang thay đổi mật khẩu";
        $id = $request -> id;
        return view('clients.changePassword',compact('title','id'));
    }

    public function postChangePassword($id = 0,Request $request,ChangePasswordRequest $formRequest){
        if ($request->isMethod('post')) {
            $data = [
                'password' => bcrypt($request -> password),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $statusUpdate = $this -> users -> updateUserById($id, $data);
            if($statusUpdate){
                return redirect() -> route('login') -> with('msg','Thay đổi mật khẩu thành công') -> with('type', 'success');
            }else{
                return redirect() -> route('login') -> with('msg','Thay đổi mật khẩu thất bại') -> with('type', 'danger');
            }
            
        }
    }
}

