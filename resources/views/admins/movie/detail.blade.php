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
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Thông tin phim</h5>
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
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Thông tin chung
                        <span class="d-block text-muted pt-2 font-size-sm">thông tin phim</span>
                    </h3>
                </div>
                
            </div>
            <div class="card-body">
                <div class="row " style="margin: 50px 0;">
                    <div class="col-md-4"><img src="{{ asset('uploads/'.$data['movie']->image) }}" alt="..." style="width: 100%; border-radius: 5%" /></div>
                    <div class="col-md-8">
                        <h1 class="">{{$data['movie']->movie_name}}</h1>
        
                        <p class="lead">{{$data['movie']->describe_movie}}</p>
                        <h5>Đạo diễn: {{$data['movie']->director}}</h5>
                        <h5>Diễn viên: {{$data['movie']->performers}}</h5>
                        <h5>Thời lượng phim: {{$data['movie']->movie_duration}} phút</h5>
                        <h5>Ngày khởi chiếu: {{$data['movie']->start_date}}</h5>
                        <h5>Ngày kết thúc: {{$data['movie']->end_date}}</h5>
                        <h5>Thể loại: {{$genre}}</h5>
        
                        
                        <h5>Danh mục: {{$data['movie']->category_name}}</h5>
        
                    </div>
                </div>
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection