@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('content')
<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Trang đặt vé</li>
        </ol>
    </nav>
    <h1 style="margin-left:50px; ">Đặt vé:</h1>

    <div class="row " style="margin: 50px 0;">
        <div class="col-8">
            <div class="col-sm-12" style="background-color: #ccc; margin-bottom: 50px;  border-radius: 50px; ">
                <h3 style="text-align: center;">Màn hình</h3>
            </div>
            <div style="margin: 30px 0;">
                <div id="seat-container" class="row">

                </div>
            </div>


        </div>
        <div class="col-4 ">
            <div class="row gx-5  d-flex" style="border-bottom: 2px dashed #ccc;">
                <div class="col-6">

                    <img src="{{ asset('uploads/'.$data->image) }}" alt="" style="width: 100%; border-radius: 10px;">
                </div>
                <div class="col-6">
                    <h3>{{$data->movie_name}}</h3>
                </div>
                <div class="col-6">

                    <h5>Thể loại</h5>
                </div>
                <div class="col-6">
                    <p>{{$genre}}</p>
                </div>
                <div class="col-6">

                    <h5>Thời lượng</h5>
                </div>
                <div class="col-6">
                    <p>{{$data->movie_duration}} phút</p>
                </div>

            </div>

            <div class="row gx-5 d-flex">
                <div class="col-6">
                    <h5>Ngày chiếu</h5>
                </div>
                <div class="col-6">
                    <p><?php echo date("d-m-Y", strtotime($data->showtime)); ?></p>
                </div>
                <div class="col-6">
                    <h5>Giờ chiếu</h5>
                </div>
                <div class="col-6">
                    <p><?php echo date("H:i", strtotime($data->showtime)); ?></p>
                </div>
                <div class="col-6">
                    <h5>Phòng chiếu</h5>
                </div>
                <div class="col-6">
                    <p>{{$data->room_code}}</p>
                </div>
            </div>

        </div>

    </div>
    <div class="row ">
        <div class="col-8 "></div>
        <div class="col-4 d-flex  align-items-center">
            <p class="total" style="margin-right: 10px;">Tổng tiền: </p>
            <p class="price" style="color: red;">0</p> <span style="color: red;">VNĐ</span>
        </div>
    </div>

    <div class="row" style="margin-bottom: 50px;">
        <div class="col-8 "></div>
        <div class="col-4 d-flex  align-items-center">
            <form id="myForm" action="{{ route('checkOut') }}" method="post">
                <input type="hidden" id="user_Id" name="user_Id">
                <input type="hidden" id="showtime_Id" name="showtime_Id">
                <input type="hidden" id="seat_Id" name="seat_Id">
                <input type="hidden" id="seat_code" name="seat_code">
                <input type="hidden" id="price" name="price">
                <input type="hidden" id="movie_Id" name="movie_Id">
                @csrf
                <button id="payment-button" name="payUrl">Thanh toán</button>
            </form>

        </div>
    </div>

</div>
<style>
    .seat {
        text-align: center;
        padding: 10px 0;
        border-radius: 50px;
        margin-bottom: 10px;

    }

    .total {
        font-size: 32px;
        font-weight: 700;
    }

    .price {
        font-size: 32px;
        font-weight: 400;
    }

    .available {
        background-color: #ccc;

    }

    .reserved {
        background-color: blue;
        color: white;
    }

    .booked {
        background-color: red;
        color: white;
    }

    #myForm {
        width: 100%;
    }

    #payment-button {
        border: none;
        border-radius: 20px;
        width: 100%;
        padding: 10px 0;
        font-size: 22px;
        font-weight: 700;
        color: white;
        background-image: linear-gradient(to right, #0a64a7 0%, #258dcf 51%, #3db1f3 100%) !important;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        var selectedSeats = [];
        var idSeats = [];

        const seatContainer = document.getElementById('seat-container');
        var price = document.querySelector('.price');
        var currentValue = parseInt(price.textContent);
        var priceMovie = parseInt({{$data->price}});
        price.innerText = 0
        
            
            fetch('http://127.0.0.1:8000/api/seat/' + {{$id}})
            .then(response => response.json())
            .then(seats => {
                console.log(seats.data);
                seats.data.forEach(seat => {
                        const seatElement = document.createElement('div');
                        seatElement.classList.add('seat', seat.seat_status, 'col-2');

                        seatElement.innerText = seat.seat_code;

                        seatElement.addEventListener('click', () => toggleSeat(seatElement, seat.seat_code, seat.seat_status, seat.seat_Id));
                        
                        seatContainer.appendChild(seatElement);
                });
            });

        function toggleSeat(seatElement, seatNumber, seatStatus, idSeat) {
            if (seatStatus === 'booked') {
                alert('Ghế này đã được đặt, vui lòng chọn ghế khác.');
            } else {
                if (selectedSeats.includes(seatNumber)) {
                    // Nếu ghế đã được chọn, hủy chọn ghế
                    const index = selectedSeats.indexOf(seatNumber);
                    const idIndex = idSeats.indexOf(idSeat);
                    idSeats.splice(idIndex, 1);
                    selectedSeats.splice(index, 1);
                    seatElement.classList.remove('reserved');
                    currentValue -= priceMovie
                    price.textContent = currentValue;
                } else {
                    // Nếu ghế chưa được chọn, kiểm tra xem có tối đa 5 ghế đã được chọn chưa
                    if (selectedSeats.length < 5) {
                        selectedSeats.push(seatNumber);
                        idSeats.push(idSeat);
                        seatElement.classList.add('reserved');
                        // price.innerText +=2;
                        currentValue += priceMovie
                        price.textContent = currentValue;

                    } else {
                        alert('Bạn chỉ có thể chọn tối đa 5 ghế.');
                    }
                }
            }

        }

        const paymentButton = document.getElementById('payment-button');

        paymentButton.addEventListener('click', function() {
            if (selectedSeats.length > 0) {
                var User_Id = {{Auth::user()->id}};
                document.getElementById('user_Id').value = User_Id;
                document.getElementById('showtime_Id').value = {{$data->showtime_Id}};
                document.getElementById('seat_Id').value = idSeats;
                document.getElementById('seat_code').value = selectedSeats;
                document.getElementById('price').value = parseInt(price.innerText);
                document.getElementById('movie_Id').value = {{$data->movie_Id}};
                document.getElementById('myForm').submit();

            } else {
                
                alert('Vui lòng chọn ít nhất một ghế để thanh toán.');
                event.preventDefault(); // Prevent form submission
                return;
            }
        });
    });
</script>

@endsection