@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('content')

<!-- main -->
<header class="bg-dark ">
    <div class="container px-4 px-lg-5 ">
        <div class="text-center text-white">
            <!-- <h1 class="display-4 fw-bolder">Shop in style</h1>
				<p class="lead fw-normal text-white-50 mb-0">With this shop
					hompeage template</p> -->
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="{{ asset('Template/User/img/banner-1.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img src="{{ asset('Template/User/img/banner-2.jpg') }} " class="d-block w-100" alt="...">
                    </div>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</header>
<!-- Section-->



<section class="py-0">
    <div class="container px-4 px-lg-5 mt-5">

        <div class="row ">
            <div class="col py-4 d-flex justify-content-center">  
                @if (!empty($data['category']))        
                    @foreach ($data['category'] as $item)  
                        @if ($cate == $item->category_Id)
                            <a class="cate" href="{{ route('index', ['id'=>$item->category_Id]) }}" style="">
                                <h3>{{$item->category_name}}</h3>
                            </a> 
                        @else
                            <a class="cateNotSelected" href="{{ route('index', ['id'=>$item->category_Id]) }}" style="">
                                <h3>{{$item->category_name}}</h3>
                            </a>
                        @endif
                          
                    @endforeach
                @endif
            </div>
        </div>
        <div class="row">
            <form action="{{ route('SearchMovie') }}" method="GET">
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Bộ lọc
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        
                        @if (!empty($data['genre']))
                            @foreach ($data['genre'] as $item)
                                <li>
                                    <input type="checkbox" id="{{$item->genre_Id}}" name="genre[]" value="{{$item->genre_Id}}">
                                    <label for="{{$item->genre_Id}}"> {{$item->genre_name}}</label>
                                </li>
                            @endforeach
                        @endif
                        @csrf
                            <li><button type="submit" class="btn btn-primary">Tìm</button></li>
                    </ul>
                </div>
            </form>

        </div>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3  justify-content-center">
        
                @if (!empty($data['movie']))
                    @foreach ($data['movie'] as $item)
                    <div class="col-3 mb-5 d-flex justify-content-center" style="margin-top: 15px;">
                        <div class="card h-100" style="width: 100%;">
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ asset('uploads/'.$item['movie']->image) }}" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{$item['movie']->movie_name}}</h5>
                                    <p>Thể loại:
                                        <span>
                                            {{$item['genre']}}
                                        </span>

                                    </p>
                                    
                                    <P>Thời lượng phim: <span>{{$item['movie']->movie_duration}} phút</span></P>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class=" form-control btn btn-outline-dark mt-auto" href="{{ route('MovieDetail', ['id'=>$item['movie']->movie_Id]) }}">Mua vé</a></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    
                @endif
                

            </div>
            <div class="row">
                <div class="col-12 py-4 d-flex justify-content-center">
                    {{-- phân trang  --}}
                </div>
            </div>

    </div>
</section>


<style>
    .cate {
        margin: 0 10px;
        border-bottom: 5px solid blue;
        text-decoration: none;
        color: blue;
    }

    .cateNotSelected{
        margin: 0 10px;
        border-bottom: 4px solid black;
        
        text-decoration: none;
        color: black;
    }

    .card-body p {
        font-weight: 700;
    }

    .card-body span {
        font-weight: 400;
    }
</style>

@endsection