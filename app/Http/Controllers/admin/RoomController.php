<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\RoomModel;
use App\Http\Requests\admin\RoomRequest;
use App\Models\admin\RoomStatusModel;

class RoomController extends Controller
{

    private $room;
    private $roomStatus;

    public function __construct()
    {
        $this -> room = new RoomModel();
    }

    public function index(){
        $title = "Trang danh sách phòng";
        $data = $this -> room -> getAllRoom();
        return view('admins.room.room',compact('title','data'));
    }

    public function add(){
        $title = "Trang thêm phòng";
        
        return view('admins.room.add',compact('title'));
    }

    public function addPost(Request $request, RoomRequest $formRequest){
        $data = [];
        if ($request->isMethod('post')) {
            $name = $request -> name;
            $data = [
                'room_code' => $name,
                'room_status_Id' => 1
            ];

            $addStatus = $this -> room -> addRoom($data);

            if($addStatus){
                $msg = 'Thêm phòng thành công';
                $type = 'success';
            }else{
                $msg = 'Thêm phòng thất bại';
                $type = 'danger';
            }
            return redirect() -> route('admin.addRoom') -> with('msg',$msg) -> with('type', $type);
        }else{
            // chưa được xử lí
        }
        
    }

    public function delete($id = 0){
        if ($id != 0) {
            $deleteStatus = $this->room->deleteRoom($id);
            if ($deleteStatus) {
                $msg = 'xóa thể phòng thành công';
                $type = 'success';
            } else {
                $msg = 'bạn không thể xóa phòng này';
                $type = 'danger';
            }
        } else {
            $msg = "Liên kết không tồn tại";
            $type = 'danger';
        }

        return redirect()->route('admin.room')->with('msg', $msg)->with('type', $type);
    }

    public function update($id = 0){
        $title = "Trang chỉnh sửa phim";
        if (!empty($id)) {
            $data['room'] = $this -> room -> findRoomById($id);
            $this -> roomStatus = new RoomStatusModel();
            $data['room_status'] = $this -> roomStatus -> getAllRoomStatus();

            if (empty($data['room'])) {
                return redirect()->route('admin.room')->with('msg', 'Phòng không tồn tại.')->with('type', 'danger');
            } else {
                return view('admins.room.update', compact('title', 'data'));
            }
        } else {
            $msg = "Liên kết không tồn tại";
            $type = 'danger';
            return redirect()->route('admin.room')->with('msg', $msg)->with('type', $type);
        }
    }

    public function updatePost(Request $request, RoomRequest $formRequest){
        $id = $request -> id;
        if(!empty($id)){
            $data = [
                'room_code' => $request -> name,
                'room_status_Id' => $request -> room_status
            ];
            $updateStatus = $this -> room -> updateRoomById($id,$data);
            if($updateStatus){
                return back() -> with('msg','Cập nhật phòng thành công') -> with('type','success');
            }else{
                return back() -> with('msg','Cập nhật phòng không thành công') -> with('type','danger');
            }
        }else{
            $msg = "Liên kết không tồn tại";
            $type = 'danger';
            return redirect() -> route('admin.room') -> with('msg',$msg) -> with('type', $type);
        }
    }
}
