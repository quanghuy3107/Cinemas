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
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Tạo mới phim</h5>
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
                    <h3 class="card-title">Form thông tin phim mới</h3>
                </div>
                <!--begin::Form-->
                <form method="POST" action="" enctype="multipart/form-data">
                    
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
                        <div class="form-group">
                            <div class="row" style="margin-bottom: 50px;">
                                <div class="col-sm-6" style="">
                                    <div class="p-5">
                                        <label for="movie_name" class="form-label">
                                            <h3>Tên phim:</h3>
                                        </label>
                                        <input type="text" class="form-control" id="movie_name" placeholder="Tên sản phẩm" name="movie_name" value="{{old('movie_name')}}" >
                                        @error('movie_name')
                                        <p style="color: red">{{$message}}</p>
                                        @enderror
                                    </div>
            
                                    <div class="p-5">
                                        <label for="director" class="form-label">
                                            <h3>Tên đạo diện:</h3>
                                        </label>
                                        <input type="text" class="form-control" id="director" placeholder="Tên đạo diện" name="director" value="{{old('director')}}">
                                        @error('director')
                                        <p style="color: red">{{$message}}</p>
                                        @enderror
                                    </div>
            
                                    <div class="p-5">
                                        <label for="performers" class="form-label">
                                            <h3>Tên diễn viên:</h3>
                                        </label>
                                        <input type="text" class="form-control" id="performers" placeholder="Tên diễn viên" name="performers" value="{{old('performers')}}">
                                        @error('performers')
                                        <p style="color: red">{{$message}}</p>
                                        @enderror
                                    </div>
            
            
                                    <div class="p-5">
                                        <label for="movie_duration" class="form-label">
                                            <h3>Thời lượng phim:</h3>
                                        </label>
                                        <input type="number" min="0" class="form-control" id="movie_duration" placeholder="Thời lượng phim" name="movie_duration" value="{{old('movie_duration')}}">
                                        @error('movie_duration')
                                        <p style="color: red">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="p-5"> 
                                        <label for="image" class="form-label">
                                            <h3>Ảnh:</h3>
                                        </label>
                                        <input type="file" class="" id="image" name="image" value="{{old('image')}}">
                                        @error('image')
                                        <p style="color: red">{{$message}}</p>
                                        @enderror
                                    </div>
            
                                    <div class="p-5">
                                        <div>
                                            <label for="start_date" class="form-label">
                                                <h3>Ngày phát hành:</h3>
                                            </label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{old('start_date')}}">
                                        </div>
                                        @error('start_date')
                                        <p style="color: red">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="p-5"> 
                                        <div>
                                            <label for="end_date" class="form-label">
                                                <h3>Ngày kết thúc:</h3>
                                            </label>
                                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{old('end_date')}}" >
            
                                        </div>
                                        @error('end_date')
                                        <p style="color: red">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6" style="">
            
                                    <div class="p-5">
                                        <h3>Thể loại:</h3>
                                        @if (!empty($data['genre']))
                                            @foreach ($data['genre'] as $item)
                                            <input type="checkbox" id="{{$item->genre_Id}}" name="genre[]" value="{{$item->genre_Id}}" >
                                            <label for="{{$item->genre_Id}}"> {{$item->genre_name}}</label><br>
                                            @endforeach
                                        @endif

                                        @error('genre')
                                        <p style="color: red">{{$message}}</p>
                                        @enderror
                                        <p class="error-message" id="error-message" style="color: red;"></p>
                                    </div>
            
                                    <div class="p-5">
                                        <h3>Danh mục:</h3>
                                        <select name="category" id="">
                                            @if (!empty($data['category']))
                                            @foreach ($data['category'] as $item)
                                                <option value="{{$item->category_Id}}" {{(old('category') == $item->category_Id ? "selected" : "")}}>{{$item->category_name}}</option>
                                            @endforeach
                                        @endif
                                           
                                        </select>
                                    </div>
            
                                </div>
            
                                <div class="col-sm-12">
                                    <div class="p-5">
                                        <label for="describe_movie" class="form-label">
                                            <h3>Mô tả phim:</h3>
                                        </label>
                                        <textarea class="form-control ip" rows="5" id="describe_movie" name="describe_movie" >{{old('describe_movie')}}</textarea>
                                    </div>
                                    
                                </div>
            
                        </div>
                        @csrf
                        
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Tạo mới</button>
                        <button type="reset" class="btn btn-secondary">Làm lại</button>
                        <a href="{{ route('admin.movie') }}" class="btn btn-default">Quay về</a>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div><!--end::Entry-->
@endsection