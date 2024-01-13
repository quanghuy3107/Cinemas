@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('content')
<section class="py-5">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Trang chi tiết</li>
            </ol>
        </nav>
        <h2 style="margin-left:50px; ">Chi tiết phim:</h2>
        <div class="row  " style="margin: 50px 0;">
            @if (!empty($data['movie']))
            <div class="col-md-4"><img src="{{ asset('uploads/'.$data['movie']->image) }}" alt="..." style="width: 100%; border-radius: 30px;" /></div>
            <div class="col-md-8">
                <h1 class="">{{$data['movie']->movie_name}}</h1>

                <p class="mota">{{$data['movie']->describe_movie}}</p>
                <div class="row information">
                    <div class="col-4">
                        <h5>Đạo diễn:</h5>
                    </div>
                    <div class="col-8">
                        <p> {{$data['movie']->director}}</p>
                    </div>
                    <div class="col-4">
                        <h5>Diễn viên:</h5>
                    </div>
                    <div class="col-8">
                        <p> {{$data['movie']->performers}}</p>
                    </div>
                    <div class="col-4">
                        <h5>Thời lượng phim:</h5>
                    </div>
                    <div class="col-8">
                        <p> {{$data['movie']->movie_duration}} phút</p>
                    </div>
                    <div class="col-4">
                        <h5>Ngày khởi chiếu:</h5>
                    </div>
                    <div class="col-8">
                        <p> {{$data['movie']->start_date}}</p>
                    </div>
                    <div class="col-4">
                        <h5>Thể loại:</h5>
                    </div>
                    <div class="col-8">
                        <p> {{$genre}}</p>
                    </div>
                </div>
            </div>  
            @endif

        </div>
        <div class="row">
            <div class="col-12" style="margin: 30px 0;">
                <h3>Thời gian chiếu:</h3>
            </div>
        </div>
        <div class="row ">
            <div class="mb-7">
                <nav class="navbar navbar-expand-lg navbar-light">
                    
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                      <div class="navbar-nav">
                        @if (!empty($data['date']))
                        @foreach ($data['date'] as $item)
                            <a class="nav-item nav-link  {{$item == $data['showTime'] ? "active strong" : ''}}" style="font-size: 18px" href="{{ route('MovieDetail', ['id'=>$data['movie']->movie_Id, 'date' => $item]) }}">{{$item}}</a>
                        @endforeach
                            
                        @endif
                      </div>
                    </div>
                </nav>
            </div>
            
        </div>
        <div class="row" style="margin: 30px 0;">
            @if (!empty($data['listShowTime']))
                @foreach ($data['listShowTime'] as $time)
                    <div class="col-1">
                        <form id="myForm" action="{{ route('BookTicket', ['id'=>$time->showtime_Id]) }}" method="GET">                  
                            <button type="submit" class="time"><?php echo date("H:i", strtotime($time->showtime)); ?></button>
                        </form>
                    </div>
                @endforeach
                            
            @endif
            
        </div>
        <div style="margin-top: 100px;">
            <h1>Đánh giá của khách hàng</h1>
            <section>
                <div class="container my-5 py-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12 col-lg-10">
                            <div class="card text-dark">
                                
                                @if (!empty($dataComment))
                                    @foreach ($dataComment as $value)
                                    <div class="card-body p-4">
                                        <div class="d-flex flex-start">
                                            <div>
                                                <h6 class="fw-bold mb-1">{{$value->name}}</h6>
                                                <div class="d-flex align-items-center mb-3">
                                                    <p class="mb-0">
                                                        {{$value->date_of_comment}}
                                                    </p>
                                                </div>
                                                <p class="mb-0">
                                                    {{$value->content}}
                                                </p>
                                                @if (Auth::check() && Auth::user()->id == $value->user_Id)
                                                    <a href="{{ route('DeleteComment', ['id'=>$value->comment_Id]) }}">Xóa</a>
                                                @endif
                                               
                                            </div>
                                        </div>
                                    </div>
    
                                    <hr class="my-0" />
                                    @endforeach
                                @endif
                            @if (Auth::check())
                                <h3 style="margin-top: 50px;">{{Auth::user()->name}}</h3>
                                <form class="comment" action="{{ route('AddComment') }}" >
                                    <div class="mb-3 mt-3">
                                        <label for="content">Bình luận:</label>
                                        <textarea class="form-control" rows="3" id="content" name="content"></textarea>
                                        @error('content')
                                        <p style="color: red">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <span id="check"></span>
                                    <input type="hidden" value="{{$data['movie']->movie_Id}}" name="movie_Id">
                                    <input type="hidden" value="{{Auth::user()->id}}" name="user_Id">
                                    @csrf
                                    <button  type="submit" class="btn btn-primary">Gửi<i class="fas fa-long-arrow-alt-right ms-1"></i></button>
                                </form>
                                @endif
                        </div>
                            

                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
</section>
<style>
    /* <?php
    if (empty($_GET['time'])) {
    ?>.date-1 {
        border-bottom: 5px solid black;
    }

    .date-1 a {
        text-align: center;
        text-decoration: none;
        color: black;
    }

    <?php
    }
    ?> */
    .mota {
        font-size: 22px;
        font-weight: 600;
    }

    .information p {
        font-size: 18px;
    }

    .time {
        background-color: #ccc;
        color: black;
        text-decoration: none;
        padding: 5px 20px;
    }
</style>

@endsection