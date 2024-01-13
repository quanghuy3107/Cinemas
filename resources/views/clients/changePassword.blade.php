@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('content')
<div id="login">

    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">

                    <form id="myForm" class="form" action="{{ route('postChangePassword', ['id'=>$id]) }}" method="post">
                        <h1 class="text-center ">Nhập mật khẩu mới</h1>
                        @error('msg')
                        <div class="form-group " style="margin-bottom: 20px;">
                            <div class="alert alert-danger text-center">
                                {{$message}}
                            </div>
                        </div>
                        @enderror
                        <div class="form-group " style="margin-bottom: 20px;">
                            <label for="password">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="password" name="password">
                            @error('password')
                            <p style="color: red">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label for="confirmPassword">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                            @error('confirmPassword')
                            <p style="color: red">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            @csrf
                            <input type="submit" name="btn" class="btn btn-success btn-md" value="Thay đổi">
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #login {
        margin: 10% 0;

        /* box-shadow: ; */
    }

    .form {
        background-color: #ccc;
        border: none;
        padding: 30px;
        border-radius: 20px;

    }

    .form label {
        margin-bottom: 10px;
        font-size: 22px;
        font-weight: 700;
    }

    .form-group {
        margin: 30px 0;
    }
</style>

@endsection