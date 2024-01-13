@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection
@section('content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Tạo mới suất chiếu</h5>
                <!--end::Page Title-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">

            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">Form thông tin suất chiếu</h3>
                </div>
                <!--begin::Form-->
                <form method="POST" action="{{ route('admin.addShowtimePost') }}">
                    
                    <div class="card-body">
                        
                        @error('msg')
                        <div class="row">
                            <div class="alert alert-danger text-center">
                                {{$message}}
                            </div>
                        </div>
                        
                        @enderror

                        @if (session('msg'))
                        <div class="row">
                            <div class="alert alert-{{session('type')}} text-center">
                                {{session('msg')}}
                            </div>
                        </div>
                        @endif
                        <div class="row" style="margin-bottom: 50px;">
                            <div class="col-sm-6" style="">
                                <div>
                                    <h4>Phim: {{$data['movie']->movie_name}}</h4>       
                                </div>
                                <div>
                                    <h4><label for="price">Giá tiền:</label></h4>
                                    <input type="number" min="0" name="price" value="{{old('price')}}">
                                </div>
        
                                <div>
                                    <h4>Phòng:</h4>
                                    <select name="room" id="">
                                        @if (!empty($data['room']))
                                            @foreach ($data['room'] as $item)
                                                <option value="{{$item->room_Id}}" {{(old('room') == $item->room_Id ? "selected" : "")}}>{{$item->room_code}}</option>
                                            @endforeach 
                                        @endif
                                    </select>
                                </div>
        
        
                            </div>
                            <div class="col-sm-6" style="">
                                <div>
                                    <label for="showtime">
                                        <h4>Chọn giờ chiếu:</h4>
                                    </label>
                                    <input type="time" name="showtime" value="{{old('showtime')}}" required>
                                </div>
                                <div>
                                    <h4>Suất chiếu của phim:</h4>
                                    @foreach ($data['showtime'] as $item)
                                        <h5><?php $showtime = new DateTime($item->showtime); echo $showtime->format("d-m-Y H:i") ?></h5>
                                    @endforeach
                                    
                                </div>
                            </div>
        

                        @csrf
                        
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="movie_Id" value="{{$data['movie']->movie_Id}}">
                        <button type="submit" class="btn btn-primary mr-2">Tạo mới</button>
                        <button type="reset" class="btn btn-secondary">Làm lại</button>
                        <a href="{{ route('admin.room') }}" class="btn btn-default">Quay về</a>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div><!--end::Entry-->
@endsection