<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $title = "Trang chủ trang quản trị";
        return view('admins.home', compact('title'));
    }
}
