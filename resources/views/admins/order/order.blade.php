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
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Thông tin đơn hàng</h5>
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
                        <span class="d-block text-muted pt-2 font-size-sm">thông tin đơn hàng</span>
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Search Form-->
                <div class="mb-7">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <div class="row align-items-center">
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" placeholder="Search..."
                                            id="kt_datatable_search_query" />
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end: Search Form-->
                <!--begin: Datatable-->
                <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Mã đơn hàng</th>
                            <th >Họ và tên</th>
                            <th >Tên phim</th>
                            <th >Thời gian chiếu</th>
                            <th >Phòng</th>
                            <th >Mã ghế</th>
                            <th >Tổng tiền</th>
                        </tr>
                    </thead>
                   <tbody>
                    @if (!empty($data))
                        @foreach ($data as $key => $item)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$item->order_code}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->movie_name}}</td>
                            <td>{{$item->showtime}}</td>
                            <td>{{$item->room_code}}</td>
                            <td>{{$item->seat_booked}}</td>
                            <td><?php echo number_format($item->total_money, 0, '', '.')  ?> VNĐ</td>
                        </tr> 
                        @endforeach
                    
                    @endif
                    
                   </tbody>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection