@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('content')
    <section>
        <div class="box-thanhtoan">
            <h5 style="margin-bottom: 50px;">Đơn hàng của bạn đã được thanh toán thành công</h5>
            <a class="back" href="{{ route('index') }}">Quay trở lại trang chủ</a>
        </div>
    </section>
    <style>
        .box-thanhtoan{
            /* display: flex; */
            text-align: center;
            margin: 250px 0;
        }
        .back{
            text-decoration: none;
            color: black;
            padding: 5px 10px;
            font-weight: 600;
            border: 1px solid black;
            background-color: white;
            border-radius: 10px;
        }
    </style>
@endsection