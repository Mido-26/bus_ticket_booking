$(document).ready(function () {
    let data = [];
    let seatPrice = 0;

    $(document).on('click', '.openModalButton', function () {
        $('#seatModal').modal('show');
        let id = $(this).attr('id');
        
        $.ajax({
            url: 'api/fetch_bus_list.php',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                let filteredData = response.filter(item => item.id.toLowerCase() == id.toLowerCase());
                if (filteredData.length > 0) {
                    data = filteredData[0];
                    seatPrice = data.Price; // Set seatPrice dynamically
                    generateSeats(data);
                    $('.modal-header h5').text('');
                    $('.modal-title').text(data.busName);
                } else {
                    console.error('No matching bus found');
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });

    let totalAmount = 0;

    function generateSeats(info) {
        const totalSeats = parseInt(info.seatCapacity);
        const cols = parseInt(info.columns);
        const rows = Math.ceil(totalSeats / cols);

        const seatingChart = $('#seatingChart');
        seatingChart.empty();
        seatingChart.css('grid-template-columns', `repeat(${cols + 1}, 50px)`);

        const soldSeats = (info.sold ?? []).map(Number);
        console.log(soldSeats)
        console.log("Total seats: ", totalSeats);
        console.log("Columns: ", cols);
        console.log("Rows: ", rows);
        console.log("Sold seats: ", soldSeats);

        for (let k = 0; k < rows; k++) {
            for (let j = 0; j < cols; j++) {
                if (j === Math.floor(cols / 2) && rows - k !== 1) {
                    seatingChart.append('<div></div>'); // Add an empty div for the aisle
                }
                const seatNumber = k * cols + (j + 1);
                if (seatNumber <= totalSeats) {
                    const seatClass = soldSeats.includes(seatNumber) ? 'sold' : 'available';
                    seatingChart.append(`<div class="seat ${seatClass}" data-seat="${seatNumber}">${seatNumber}</div>`);
                }
            }
        }
    }

    // Handle seat selection
    $('#seatingChart').on('click', '.seat.available', function () {
        $(this).toggleClass('selected');
        updateTotal();
    });

    function updateTotal() {
        const selectedSeats = $('.seat.selected').length;
        totalAmount = selectedSeats * seatPrice;
        $('#totalAmount').text(`TZS ${totalAmount.toFixed(2)}`);
    }

    $('#continueButton').on('click', function () {
        alert(`Total amount to pay: TZS ${totalAmount.toFixed(2)}`);
        $('#seatModal').modal('hide');
    });
});
