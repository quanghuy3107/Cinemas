
document.addEventListener('DOMContentLoaded', function () {
    const seatContainer = document.getElementById('seat-container');
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    function displaySeats(id_lichchieu) {
    fetch('http://localhost/Nhom13_BookingVePhim_HPHCinemas/Controller/Api/GheApi.php?id_lichchieu=' + id_lichchieu)
        .then(response => response.json())
        .then(seats => {
            seats.forEach(seat => {
                const seatElement = document.createElement('div');
                console.log(seat.trangthaighe);
                console.log(seat.maghe);
                seatElement.classList.add('seat', seat.trangthaighe,'col-2');
                seatElement.innerText = seat.maghe;

                seatElement.addEventListener('click', () => bookSeat(seat.maghe));

                seatContainer.appendChild(seatElement);
            });
        });


    }
    // Lấy giá trị tham số action từ URL
    const actionParam = getQueryParam('id_lichchieu');

    // Kiểm tra xem actionParam có giá trị không và gọi hàm hiển thị ghế
    if (actionParam) {
        displaySeats(actionParam);
    }

    function bookSeat(seatNumber) {
        const customerName = prompt('Enter your name:');
        if (customerName) {
            fetch('api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    seatNumber: seatNumber,
                    customerName: customerName,
                }),
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                // Refresh lại danh sách ghế sau khi đặt vé thành công
                location.reload();
            });
        }
    }
});


