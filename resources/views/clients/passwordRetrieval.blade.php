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
                    
                    <form id="login-form" class="form" action="{{ route('mail') }}" method="post">
                        <h1 class="text-center ">Lấy lại mật khẩu</h1>
                        @if (session('msg'))
                        <div class="row">
                            <div class="alert alert-{{session('type')}} text-center">
                                {{session('msg')}}
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="email" class="">email</label><br>
                            <input type="email" name="email" id="email" placeholder="Nhập email của bạn" class="form-control" required>
                        </div>
                        @csrf
                        <div class="form-group">

                            <input type="submit" name="submit" class="btn btn-success btn-md" value="Lấy lại mật khẩu">
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