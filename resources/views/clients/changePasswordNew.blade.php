@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('content')
<form id="myForm" action="{{ route('changePasswordNewPost') }}" method="post" style="margin: 150px 0;">
    <div class="container ">

        <div class="form-row" style="margin: 50px 0;">

            <h1 style="margin-bottom: 20px;">Thay đổi mật khẩu</h1>

            <h2>{{Auth::user()->name}}</h2>

            @if (session('msg'))
                <div class="form-group col-md-6" style="margin-bottom: 20px;">
                    <div class="alert alert-{{session('type')}} text-center">
                        {{session('msg')}}
                    </div>
                </div>
            @endif
            @error('msg')
                <div class="form-group col-md-6" style="margin-bottom: 20px;">
                    <div class="alert alert-danger text-center">
                        {{$message}}
                    </div>
                </div>
            @enderror

            <div class="form-group col-md-6" style="margin-bottom: 20px;">
                <label for="oldPassword">Mật khẩu cũ</label>
                <input type="password" class="form-control" id="oldPassword" name="oldPassword">
                @error('oldPassword')
                <p style="color: red">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6" style="margin-bottom: 20px;">
                <label for="password">Mật khẩu mới</label>
                <input type="password" class="form-control" id="password" name="password">
                @error('password')
                <p style="color: red">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6" style="margin-bottom: 20px;">
                <label for="confirmPassword">Nhập lại mật khẩu</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                <span id="check_pass" style="color: red;"></span>
                @error('confirmPassword')
                <p style="color: red">{{$message}}</p>
                @enderror
            </div>
            @csrf
            <input type="submit" class="btn btn-primary" name="btn" value="Thay đổi mật khẩu">
        </div>
    </div>
</form>
@endsection