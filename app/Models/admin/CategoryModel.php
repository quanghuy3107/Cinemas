<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'category';

    function getAllCategory(){
        return DB::table($this->table) ->get();
    }

    function deleteCategory($id){
        return DB::table($this->table) -> where('category_Id',$id) -> delete();
    }

    function addCategory($data = []){
        return DB::table($this->table)->insert($data);
    }

    function findCategoryById($id){
        $cate = DB::table($this->table) -> where('category_Id',$id) ->get();
        return $cate[0];
    }

    function updateCategoryById($id, $data)  {
        return DB::table($this->table) -> where('category_Id',$id) -> update($data);
    }
}
