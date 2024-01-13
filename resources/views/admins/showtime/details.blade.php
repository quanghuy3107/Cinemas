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
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Thông tin suất chiếu</h5>
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
                    <h3 class="card-label">Thông tin suất chiếu
                        <span class="d-block text-muted pt-2 font-size-sm">thông tin suất chiếu</span>
                    </h3>
                </div>
                
            </div>
            <div class="card-body">
                <!--begin: Search Form-->
                <div class="mb-7">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                          <div class="navbar-nav">
                            @if (!empty($data))
                            @foreach ($data['date'] as $item)
                                <a class="nav-item nav-link  {{$item == $data['showTime'] ? "active strong" : ''}}" style="font-size: 18px" href="{{ route('admin.showtimeDetails', ['id'=>$id, 'date' => $item]) }}">{{$item}}</a>
                            @endforeach
                                
                            @endif
                          </div>
                        </div>
                    </nav>
                </div>

                <!--end: Search Form-->
                <!--begin: Datatable-->
                @if (session('msg'))
                        <div class="row">
                            <div class="alert alert-{{session('type')}} text-center">
                                {{session('msg')}}
                            </div>
                        </div>
                @endif
                
                <div class="row">
                    <div class="col-8">
                        <div class="col-sm-12" style="background-color: #ccc; margin-bottom: 50px;  border-radius: 50px; ">
                            <h3 style="text-align: center;">Màn hình</h3>
                        </div>
                        <div style="margin: 30px 0;">
                            <div id="seat-container" class="row">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <h3>Thông tin suất chiếu:</h3>
                        </div>
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