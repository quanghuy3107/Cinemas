<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\CategoryModel;
use App\Http\Requests\admin\CategoryRequest;

class CategoryController extends Controller
{
    private $category;
    public function __construct()
    {
        $this -> category = new CategoryModel();
    }

    function index(){
        $title = "Trang danh sách danh mục";
        $data = $this -> category -> getAllCategory();
        return view('admins.category.category', compact('title','data'));
    }

    function delete($id = 0) {
        if(!empty($id)){
            $deleteStatus = $this -> category -> deleteCategory($id);
            if($deleteStatus){
                $msg = 'xóa danh mục thành công';
                $type = 'success';
            }else{
                $msg = 'bạn không thể xóa danh mục này';
                $type = 'danger';
            }
        }else{
            $msg = "Liên kết không tồn tại";
            $type = 'danger';
        }

        return redirect() -> route('admin.cate') -> with('msg',$msg) -> with('type', $type);
    }

    function add(){
        $title = "Trang thêm danh mục phim";

        return view('admins.category.add',compact('title'));
    }

    function addPost(Request $request, CategoryRequest $formRequest){
        $data = [];
        if ($request->isMethod('post')) {
            $name = $request -> name;
            $data = [
                'category_name' => $name
            ];

            $addStatus = $this -> category -> addCategory($data);

            if($addStatus){
                $msg = 'Thêm danh mục thành công';
                $type = 'success';
            }else{
                $msg = 'Thêm danh mục thất bại';
                $type = 'danger';
            }
        }else{
            // chưa được xử lí
        }
        return redirect() -> route('admin.addCategory') -> with('msg',$msg) -> with('type', $type);
        

    }

    function update($id = 0){
        $title = "Trang chỉnh sửa danh mục";
        if(!empty($id)){
            $data = $this -> category ->findCategoryById($id);
            if(empty($data)){
                return redirect() -> route('admin.cate') -> with('msg','Danh mục không tồn tại.');
            }
        }else{
            $msg = "Liên kết không tồn tại";
            $type = 'danger';
            return redirect() -> route('admin.cate') -> with('msg',$msg) -> with('type', $type);
        }
        return view('admins.category.update',compact('title','data'));
        
    }

    function updatePost(Request $request, CategoryRequest $formRequest){
        $id = $request -> id;
        if(!empty($id)){
            $data = [
                'category_name' => $request -> name
            ];
            $updateStatus = $this -> category -> updateCategoryById($id,$data);
            if($updateStatus){
                return back() -> with('msg','Cập nhật danh mục thành công') -> with('type','success');
            }else{
                return back() -> with('msg','Cập nhật danh mục không thành công') -> with('type','danger');
            }
        }else{
            $msg = "Liên kết không tồn tại";
            $type = 'danger';
            return redirect() -> route('admin.cate') -> with('msg',$msg) -> with('type', $type);
        }
          
    }
}
