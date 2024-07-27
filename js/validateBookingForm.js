$(document).ready(function () {
    let seatPrice = 50; // Set the seat price here, adjust as needed
    let totalAmount = 0;
    let selectedSeats = [];

    // Handle seat selection
    $('#seatingChart').on('click', '.seat.available', function () {
        const seatNumber = $(this).data('seat');

        // Toggle seat selection
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            selectedSeats = selectedSeats.filter(seat => seat !== seatNumber);
        } else {
            $(this).addClass('selected');
            selectedSeats.push(seatNumber);
        }

        // Update the total amount and hidden input
        updateTotal();
        $('#seatNumber').val('');
        $('#seatNumber').val(selectedSeats.join(', '));
    });

    // Update total amount based on selected seats
    function updateTotal() {
        const selectedSeatsCount = selectedSeats.length;
        totalAmount = selectedSeatsCount * seatPrice;
        $('#totalAmount').text(`TZS ${totalAmount.toFixed(2)}`);
    }

    // Handle reservation confirmation
    $('#continueButton').on('click', function () {
        if (selectedSeats.length > 0) {
            let name = $('#customerName').val().trim();
            let custNo = $('#customerPhone').val().trim();
            var valid = true;
            if (name == '') {
                alert('please Enter a valid name')
                valid = false;
            }
            if (custNo == '' || custNo.length <= 9) {
                alert('please Enter a valid number')
                valid = false;
            }

            if (valid) {
                alert('Reserved seats: ' + selectedSeats.join(', '));
                $('#seatModal').modal('hide');
                $('#bookingForm')[0].reset();
            }


        } else {
            alert('No seats selected.');
        }
    });
});
