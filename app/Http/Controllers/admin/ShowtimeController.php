<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\admin\ShowTimeModel;
use App\Models\admin\MovieModel;
use App\Models\admin\RoomModel;
use App\Models\admin\RowOfSeatModel;
use App\Models\admin\SeatModel;

use Nette\Utils\DateTime;

class ShowtimeController extends Controller
{
    private $showtime;
    private $movie;
    private $room;
    private $rowOfSeat;
    private $seat;

    public function __construct()
    {
        $this -> showtime = new ShowTimeModel();
    }

    public function index(){
        $title = "Danh sách suất chiếu.";
        $this -> movie = new MovieModel();
        $listData = $this -> movie -> getAllMovie();
        $list = [];
        $i = 0;
        
        foreach($listData as $data){
            $dataNew = [];
            $dataShowtime   = $this -> showtime -> getShowtimeByMovie($data->movie_Id);
            $dataNew['movie'] = $data;
            $dataNew['showtime'] = [...$dataShowtime];
            $list[] = $dataNew;
            
        }

       

// dd($list);
//         exit();
        return view('admins.showtime.showtime',compact('title','list'));
    }

    public function details($id = 0, $date = null){
        if(!empty($id)){
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
                    $title = 'Trang chi tiết suất chiếu';
                    if($date == null){
                        $data['showTime'] = $data['date'][0];
                        $data['listShowTime'] = $this -> showtime -> getShowtimeByMovie($id, $data['showTime']);
                        
                    }else{
                        $data['listShowTime'] = $this -> showtime -> getShowtimeByMovie($id, $date);
                        $data['showTime'] = $date;
                    }
                    
                    
                    return view('admins.showtime.details',compact('title','id','data'));
                }else{
                    $type = 'danger';
                    $msg = 'Liên kết không tồn tại.';
                }
            }
            
        }else{
            $type = 'danger';
            $msg = 'Liên kết không tồn tại.';
        }
        return redirect() -> route('admin.showtime') -> with('msg',$msg) -> with('type', $type);
    }

    public function add($id = 0) {
        if(!empty($id)){
            $title = 'Trang thêm suất chiếu';
            $this -> movie = new MovieModel();
            $this -> room = new RoomModel();
            $data['movie'] = $this -> movie -> findMovieById($id);
            $data['room'] = $this -> room -> findRoomByStatus('Active');
            $data['showtime'] = $this -> showtime -> getShowtimeByMovie($id);
            return view('admins.showtime.add',compact('title','data'));
        }else{
            $type = 'danger';
            $msg = 'Liên kết không tồn tại.';
        }
        return redirect() -> route('admin.showtime') -> with('msg',$msg) -> with('type', $type);
    }

    public function addPost(Request $request){
        if ($request->isMethod('post')) {

            
            $this -> movie = new MovieModel();

            $room_Id = $request -> room;
            $price = $request -> price;
            $time = $request -> showtime;
            $movie_Id = $request -> movie_Id;
            $time = $request -> showtime;

            $dataMovie = $this -> movie -> findMovieById($movie_Id);
            if(!empty($dataMovie)){
                $startDate = $dataMovie -> start_date;
                $endDate = $dataMovie -> end_date;
                $showtime  = $startDate . " " . $time . ":00";
    
                $startDate = new DateTime($showtime);
                $endDate = new DateTime($endDate);
    
                $this -> rowOfSeat = new RowOfSeatModel();
                $this -> seat = new SeatModel();
            
                $endDate = $endDate->modify('+1 day');
                while ($startDate <= $endDate) {
                    $showtime = $startDate->format('Y-m-d H:i:s');
                    $data = [
                        'price' => $price,
                        'movie_Id' => $movie_Id,
                        'room_Id' => $room_Id,
                        'showtime' => $showtime
                    ];
                    $showtimeId = $this -> showtime -> insertGetIdShowtime($data);
                    
                    
            
                    $char = 65;
                    $length = 5;
                    
                    for ($i = 0; $i < $length; $i++) {
                        $row = chr($char);
                        $numberOfSeat = 6;
                        // $idDay = InsertDayGhe($day, $soluong, $idphong,$id);
                        $dataRowOfSeat = [
                            'row_code' => $row,
                            'number_of_seat' => $numberOfSeat,
                            'room_Id' => $room_Id,
                            'showtime_Id' => $showtimeId
    
                        ];
                        $rowOfSeatId = $this -> rowOfSeat -> insertGetIdRowOfSeat($dataRowOfSeat);
                        for ($j = 1; $j <= $numberOfSeat; $j++) {
    
                            // InsertGhe($row . $j, $rowOfSeatId);
                            $dataSeat = [
                                'seat_code' => $row . $j,
                                'row_of_seat_Id' => $rowOfSeatId
                            ];
                            $this -> seat -> addSeat($dataSeat);

                        }
                        $char++;
                    }
    
                    $startDate->modify('+1 day'); // Tăng thêm 1 ngày
                }
                $msg = 'Thêm suất chiếu thành công';
                $type = 'success';
                return back() -> with('msg','Cập nhật phòng thành công') -> with('type','success');
            }else{
                $msg = 'Thêm suất chiếu thất bại';
                $type = 'danger';
                return redirect() -> route('admin.showtime') -> with('msg',$msg) -> with('type', $type);
            }
            
            
            
            // $addStatus = $this -> room -> addRoom($data);

            // if($addStatus){
            //     $msg = 'Thêm phòng thành công';
            //     $type = 'success';
            // }else{
            //     $msg = 'Thêm phòng thất bại';
            //     $type = 'danger';
            // }
            
        }else{
            $msg = 'Thêm suất chiếu thất bại';
            $type = 'danger';
            return redirect() -> route('admin.showtime') -> with('msg',$msg) -> with('type', $type);
        }
        
    }
}
