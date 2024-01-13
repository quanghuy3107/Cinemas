<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{asset('Template/User/assets/favicon.ico')}}" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('Template/User/css/styles.css')}}" rel="stylesheet" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('Template/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    {{-- <link rel="stylesheet" href="{{asset('Template/css/style.css')}}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('Template/Paging/jquery.twbsPagination.js')}}"></script>


</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-black">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="{{ route('index') }}"><img class="" src="{{asset('Template/User/img/logo.png')}}" alt="" width="100px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">

                    <li class="nav-item" ><a class="nav-link active" style="color: white;" href="{{ route('index') }}">Phim</a></li>
                    
                </ul>
                @if (Auth::check())
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            {{Auth::user()->name}}
                        </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('OrderOfUser') }}">Đơn hàng của tôi</a></li>
                        <li><a class="dropdown-item" href="{{ route('ChangePasswordNew') }}">Thay đổi mật khẩu</a></li>
                        <li><a class="dropdown-item" href="{{ route('ChangeInformation') }}">Thay đổi thông tin</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a></li>
                    </ul>
                </div>
                @else
                    <a class="login" href="{{ route('login') }}">Đăng Nhập</a>
                    <a class="sign-up" href="{{ route('register') }}">Đăng Ký</a>
                @endif

            </div>
        </div>
    </nav>
<style>
.logo{
  width: 150px;
}

.login, .sign-up{
  text-decoration: none;
  color: white;
  margin: 0 8px;
  border: 1px solid white;
  padding: 5px;
  border-radius: 10px;
  font-weight: 500;
}

</style>