<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\OrderModel;

class OrderController extends Controller
{
    protected $order;
    public function __construct(){
        $this -> order = new OrderModel();
    }

    public function index(){
        $title = 'Trang quản lý đơn hàng';
        $data = $this -> order -> selectOrder();
        return view('admins.order.order', compact('title','data'));
    }
}
