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
                    <form id="login-form" class="form" action="" method="post">
                        <h1 class="text-center ">Đăng nhập</h1>
                        @if (session('msg'))
                        <div class="row">
                            <div class="alert alert-{{session('type')}} text-center">
                                {{session('msg')}}
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="email" class="">Email:</label><br>
                            <input type="email" name="email" id="email" placeholder="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="">Mật khẩu:</label><br>
                            <input type="password" name="password" id="password" placeholder="Mật khẩu" class="form-control" required> 
                        </div>
                        @csrf
                        <div class="form-group">

                            <input type="submit" name="submit" class="btn btn-success btn-md" value="Đăng nhập">
                        </div>
                        
                        <div class="row">
                            <div class="col d-flex justify-content-between">
                                <a href="{{ route('register') }}">Đăng ký</a>
                                <a href="{{ route('PasswordRetrieval') }}">Quên mật khẩu</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
	#login{
		margin: 10% 0;

		/* box-shadow: ; */
	}
	#login-form{
		background-color: #ccc;
		border: none;
		padding: 30px;
		border-radius: 20px;
		
	}
	#login-form label{
		margin-bottom: 10px;
		font-size: 22px;
		font-weight: 700;
	}
	.form-group{
		margin: 30px 0;
	}
</style>

@endsection