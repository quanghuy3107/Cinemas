@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('content')
<div class="container oder">
    <h1 class="text-oder">Các đơn hàng của bạn</h1>
    <div class="accordion oder-sub" id="accordionExample">
        

        @if (!empty($data))
            <?php $stt = 0; ?>
            @foreach ($data as $value)
            <?php $stt++; ?>
            <div class="accordion-item">
                <div class="row d-flex">
                  <div class="col-12 d-flex align-items-center">
                    <h2 class="accordion-header" id="heading<?php echo $stt ?>">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $stt ?>" aria-expanded="false" aria-controls="collapse<?php echo $stt ?>">
                        <div class=" rounded-3 ">
                          <div class=" ">
                            <div class="row d-flex justify-content-between align-items-center">
                              <div class="col-1 ">
                                <img src="{{ asset('uploads/'.$value['movie']->image) }}" class="img-fluid rounded-3" alt="Cotton T-shirt" style="width: 100%;">
                              </div>
                              <div class="col-4 ">
                                <p class="lead fw-normal mb-2">{{$value['movie']->movie_name}}</p>
      
                              </div>
                              <div class="col-4">
                                <h5> Thời gian: {{$value['movie']->order_time}}</h5>
                              </div>
                              <div class="col-3 " style="text-align: center;">
                                <h5 style="color: green;"> Tổng tiền: <?php echo number_format($value['movie']->total_money, 0, '', '.')  ?> VNĐ </h5>
      
                              </div>
                            </div>
                          </div>
                        </div>
                      </button>
      
                    </h2>
                  </div>
      
      
                </div>
      
                <div id="collapse<?php echo $stt ?>" class="accordion-collapse collapse " aria-labelledby="heading<?php echo $stt ?>" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <section class="h-100 h-custom" style="background-color: #eee;">
                      <div class="container py-5 h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                          <div class="col-lg-8 col-xl-6">
                            <div class="card border-top border-bottom border-3" style="border-color: #f37a27 !important;">
                              <div class="card-body p-5">
      
                                <p class="lead fw-bold mb-5" style="color: #f37a27;">Biên lai mua hàng</p>
      
                                <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                    <p class="small text-muted mb-1">Ngày đặt vé</p>
                                    <p>{{$value['movie']->order_time}}</p>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                    <p class="small text-muted mb-1">Mã đơn hàng:</p>
                                    <p>{{$value['movie']->order_code}}</p>
                                  </div>
      
                                </div>
      
                                <div class="mx-n5 px-5 py-4" style="background-color: #f2f2f2;">
                                  <div class="row">
                                    <div class="col-8">
                                      <p>{{$value['movie']->movie_name}} </p>
                                      <p>Thể loại: {{$value['genre']}}</p>
                                      <p>Thời lượng phim: {{$value['movie']->movie_duration}} phút </p>
                                    </div>
                                    <div class="col-4">
                                      <img src="{{ asset('uploads/'.$value['movie']->image) }}" alt="" style="width: 100%; border-radius: 10px;">
                                    </div>
      
                                  </div>
                                  <div class="row">
                                    <div class="col-md-8">
                                      <p class="mb-0">Thời gian:</p>
                                    </div>
                                    <div class="col-md-4">
                                      <p class="mb-0"><?php echo date("Y-m-d H:i", strtotime($value['movie']->showtime)) ?></p>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-8">
                                      <p class="mb-0">Phòng:</p>
                                    </div>
                                    <div class="col-md-4">
                                      <p class="mb-0">{{$value['movie']->room_code}}</p>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-8">
                                      <p class="mb-0">Mã ghế:</p>
                                    </div>
                                    <div class="col-md-4">
                                      <p class="mb-0">{{$value['movie']->seat_booked}}</p>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-8">
                                      <p class="mb-0">Số lượng ghế:</p>
                                    </div>
                                    <div class="col-md-4">
                                      <p class="mb-0">{{$value['movie']->order_code}}</p>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-8">
                                      <p class="mb-0">Giá vé:</p>
                                    </div>
                                    <div class="col-md-4">
                                      <p class="mb-0"><?php echo number_format($value['movie']->price, 0, '', '.')  ?> VNĐ</p>
                                    </div>
                                  </div>
                                </div>
      
                                <div class="row my-4">
                                  <div class="">
                                    <p class="lead fw-bold mb-0" style="color: #f37a27;">Tổng tiền: {{$value['movie']->total_money}} VNĐ</p>
                                  </div>
                                </div>
      
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div> 
            @endforeach
        @endif

    </div>
  </div>
  <style>
    .oder {
      height: 100%;
    }
  
    .text-oder {
      margin: 50px 0;
    }
  
    .oder-sub {
      padding: 50px;
      margin: 150px 0;
    }
  
    @media (min-width: 1025px) {
      .h-custom {
        height: 100vh !important;
      }
    }
  
    .horizontal-timeline .items {
      border-top: 2px solid #ddd;
    }
  
    .horizontal-timeline .items .items-list {
      position: relative;
      margin-right: 0;
    }
  
    .horizontal-timeline .items .items-list:before {
      content: "";
      position: absolute;
      height: 8px;
      width: 8px;
      border-radius: 50%;
      background-color: #ddd;
      top: 0;
      margin-top: -5px;
    }
  
    .horizontal-timeline .items .items-list {
      padding-top: 15px;
    }
  
    .received {
      text-decoration: none;
    }
  </style>


@endsection