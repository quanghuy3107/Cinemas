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
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Chỉnh sửa phòng</h5>
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
                    <h3 class="card-title">Form thông tin phòng</h3>
                </div>
                <!--begin::Form-->
                <form method="POST" action="{{ route('admin.updateRoomPost') }}">
                    
                    <div class="card-body">
                        {{-- @if ($errors->any())<!-- bien errors tu dong sinh ra khi validate bi loi -->
                            <div class="row">
                                <div class="alert alert-danger text-center">
                                    {{$errorMessage}}
                                </div>
                            </div>
                        @endif --}}
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
                            <label>Tên mã phòng</label>
                            <input type="text" name="name" class="form-control" placeholder="Nhập vào tên mã phòng" value="{{old('name') ?? $data['room']->room_code}}"/>
                            @error('name')
                                <p style="color: red">{{$message}}</p>
                            @enderror
                            @error('check_room')
                                <p style="color: red">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Trang thái:</label>
                            <select name="room_status" id="">
                                @if (!empty($data['room_status']))
                                @foreach ($data['room_status'] as $item)
                                    <option value="{{$item->room_status_Id}}" {{(old('room_status') ?? $data['room']->room_status_Id == $item->room_status_Id ? "selected" : "")}}>{{$item->room_status_name}}</option>
                                @endforeach
                            @endif                     
                            </select>                       
                        </div>
                        @csrf
                        
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="id" value="{{old('id') ?? $data['room']->room_Id}}">
                        <button type="submit" class="btn btn-primary mr-2">Thay đổi</button>
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