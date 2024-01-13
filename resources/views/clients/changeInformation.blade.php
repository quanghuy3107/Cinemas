@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('content')
<div>
    <form name="signin" action="{{ route('ChangeInformationPost') }}" method="post" >
        <div class="container ">

            <div class="form-row" style="margin: 50px 0;">
                <h1 style="margin-bottom: 20px;">Thay đổi thông tin</h1>
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
                    <label for="name">Họ và tên</label>
                    <input type="text" class="form-control" id="name" value="{{old('name') ?? $data->name}}" name="name">
                    @error('name')
                    <p style="color: red">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-md-6" style="margin-bottom: 20px;">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" value="{{old('email') ?? $data->email}}" name="email">
                    @error('email')
                    <p style="color: red">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group col-md-6" style="margin-bottom: 20px;">
                    <label for="password">Nhập mật khẩu xác nhận</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                    <p style="color: red">{{$message}}</p>
                    @enderror
                </div>
                @csrf
                <input type="submit" class="btn btn-primary" name="btn" value="Thay đổi">
            </div>
        </div>
    </form>
</div>


@endsection