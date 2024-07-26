$(document).ready(function () {
    let data = [];
    let seatPrice = 0;
    let totalAmount = 0;

    // Handle modal opening and fetching bus data
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

    // Generate seat layout
    function generateSeats(info) {
        const totalSeats = parseInt(info.seatCapacity);
        const cols = parseInt(info.columns);
        const rows = Math.ceil(totalSeats / cols);

        const seatingChart = $('#seatingChart');
        seatingChart.empty();
        seatingChart.css('grid-template-columns', `repeat(${cols + 1}, 50px)`);

        const soldSeats = (info.sold ?? []).map(Number);
        console.log("Total seats: ", totalSeats);
        console.log("Columns: ", cols);
        console.log("Rows: ", rows);
        console.log("Sold seats: ", soldSeats);

        for (let k = 0; k < rows; k++) {
            for (let j = 0; j < cols; j++) {
                const seatNumber = k * cols + (j + 1);
                if (j === Math.floor(cols / 2) && totalSeats - seatNumber >=(cols+ 1)) {
                    seatingChart.append('<div></div>'); // Add an empty div for the aisle
                }
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

    // Update total amount based on selected seats
    function updateTotal() {
        const selectedSeats = $('.seat.selected').length;
        totalAmount = selectedSeats * seatPrice;
        $('#totalAmount').text(`TZS ${totalAmount.toFixed(2)}`);
    }

    // Handle reservation confirmation
    $('#continueButton').on('click', function () {
        const selectedSeats = [];
        $('.seat.selected').each(function () {
            selectedSeats.push($(this).data('seat'));
            $(this).removeClass('selected').addClass('occupied');
        });
        if (selectedSeats.length > 0) {
            alert('Reserved seats: ' + selectedSeats.join(', '));
            $('#seatModal').modal('hide');
        } else {
            alert('No seats selected.');
        }
    });
});
