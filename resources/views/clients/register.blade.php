@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('content')


<div>
    <form id="myForm" action="" method="post">
        <div class="container ">
            <div class="row">
                <div class="col-8 ">

                    <div class="form-row" style="margin: 50px 0;">
                        <h1 style="margin-bottom: 20px;">ĐĂNG KÝ</h1>
                        @error('msg')
                        <div class="form-group col-md-8" style="margin-bottom: 20px;">
                            <div class="alert alert-danger text-center">
                                {{$message}}
                            </div>
                        </div>
                        @enderror
                        <div class="form-group col-md-8" style="margin-bottom: 20px;">
                            <label for="name">Họ và tên</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                            @error('name')
                            <p style="color: red">{{$message}}</p>
                            @enderror            
                        </div>
                        <div class="form-group col-md-8" style="margin-bottom: 20px;">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                            @error('email')
                            <p style="color: red">{{$message}}</p>
                            @enderror     
                        </div>

                        <div class="form-group col-md-8" style="margin-bottom: 20px;">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
                            @error('password')
                            <p style="color: red">{{$message}}</p>
                            @enderror     
                        </div>
                        <div class="form-group col-md-8" style="margin-bottom: 20px;">
                            <label for="oldPassword">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" id="oldPassword" name="oldPassword" value="{{old('oldPassword')}}">
                            @error('oldPassword')
                            <p style="color: red">{{$message}}</p>
                            @enderror     
                        </div>
                        @csrf

                        <button type="submit" class="btn btn-danger">Đăng ký</button>
                    </div>
                </div>
                <div class="col-4">
                    <figure><img src="{{asset('Template/images/signup-image.jpg')}}" alt="sing up image" style="margin: 50px 0;"></figure>
                </div>

            </div>

        </div>
    </form>
</div>

@endsection