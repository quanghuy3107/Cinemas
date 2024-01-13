<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    //
    private $user;

    public function __construct() {
        $this -> user = new User();
    }

    public function index(){
        $title = "Trang quản lý người dùng";
        $data = $this -> user -> getAllUser();
       
        return view('admins.user.user',compact('title','data'));
        
    }

    public function changeStatusUser($id = 0, $status = null){
        if(!empty($id)){
            if(!empty($status)){
                $dataUpdate = [
                    'user_status' => 'block',
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $statusUpdate = $this -> user -> updateUserById($id, $dataUpdate);
            }else{
                $dataUpdate = [
                    'user_status' => 'active',
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $statusUpdate = $this -> user -> updateUserById($id, $dataUpdate);
            }
            if($statusUpdate){
                return redirect()-> back() ->with ('msg', 'Thay đổi trạng thái thành công.')->with('type', 'success');
            }else{
                return redirect()-> back() ->with ('msg', 'Thay đổi trạng thái thất bại.')->with('type', 'danger');
            }
            
        }else{
            return redirect()->route('admin.user')->with('msg', 'Người dùng không tồn tại.')->with('type', 'danger');
        }
    }
}
