
    // document.addEventListener('DOMContentLoaded', function() {
    //     var selectedSeats = [];
    //     var idSeats = [];

    //     const seatContainer = document.getElementById('seat-container');
    //     var price = document.querySelector('.price');
    //     var currentValue = parseInt(price.textContent);
        
    //     price.innerText = 0

    //     // function getQueryParam(param) {
    //     //     const urlParams = new URLSearchParams(window.location.search);
    //     //     return urlParams.get(param);
    //     // }

    //     // function displaySeats(id_lichchieu) {
            
    //         fetch('http://127.0.0.1:8000/api/seat/' )
    //             .then(response => response.json())
    //             .then(seats => {
    //                 seats.forEach(seat => {
    //                     const seatElement = document.createElement('div');
    //                     seatElement.classList.add('seat', seat.seat_status, 'col-2');

    //                     seatElement.innerText = seat.seat_code;

    //                     seatElement.addEventListener('click', () => toggleSeat(seatElement, seat.seat_code, seat.seat_status, seat.seat_Id));

    //                     seatContainer.appendChild(seatElement);
    //                 });
    //             });


    //     // }
    //     // // Lấy giá trị tham số action từ URL
    //     // const actionParam = getQueryParam('id_lichchieu');

    //     // // Kiểm tra xem actionParam có giá trị không và gọi hàm hiển thị ghế
    //     // if (actionParam) {
    //     //     displaySeats(actionParam);
    //     // }



    //     function toggleSeat(seatElement, seatNumber, seatStatus, idSeat) {
    //         if (seatStatus === 'booked') {
    //             alert('Ghế này đã được đặt, vui lòng chọn ghế khác.');
    //         } else {
    //             if (selectedSeats.includes(seatNumber)) {
    //                 // Nếu ghế đã được chọn, hủy chọn ghế
    //                 const index = selectedSeats.indexOf(seatNumber);
    //                 const idIndex = idSeats.indexOf(idSeat);
    //                 idSeats.splice(idIndex, 1);
    //                 selectedSeats.splice(index, 1);
    //                 seatElement.classList.remove('reserved');
    //                 currentValue -= priceMovie
    //                 price.textContent = currentValue;
    //             } else {
    //                 // Nếu ghế chưa được chọn, kiểm tra xem có tối đa 5 ghế đã được chọn chưa
    //                 if (selectedSeats.length < 5) {
    //                     selectedSeats.push(seatNumber);
    //                     idSeats.push(idSeat);
    //                     seatElement.classList.add('reserved');
    //                     // price.innerText +=2;
    //                     currentValue += priceMovie
    //                     price.textContent = currentValue;

    //                 } else {
    //                     alert('Bạn chỉ có thể chọn tối đa 5 ghế.');
    //                 }
    //             }
    //         }

    //     }

    //     const paymentButton = document.getElementById('payment-button');

    //     // function submitForm() {
    //     //     // Lấy giá trị của biến id từ JavaScript
    //     //     var idValue = 2;

    //     //     // Cập nhật giá trị của trường ẩn
    //     //     document.getElementById('id').value = idValue;

    //     //     // Submit form
    //     //     document.getElementById('myForm').submit();
    //     // }

    //     paymentButton.addEventListener('click', function() {
    //         if (selectedSeats.length > 0) {
    //             var User_Id 
    //             document.getElementById('id_nguodung').value = idNguoiDung;
    //             document.getElementById('id_lichchieu').value = actionParam;
    //             document.getElementById('idGhes').value = idSeats;
    //             document.getElementById('maGhes').value = selectedSeats;
    //             document.getElementById('gia').value = parseInt(price.innerText);
    //             document.getElementById('myForm').submit();

    //         } else {
                
    //             alert('Vui lòng chọn ít nhất một ghế để thanh toán.');
    //             event.preventDefault(); // Prevent form submission
    //             return;
    //         }
    //     });
    // });
