$(document).ready(function () {
    $('#routeForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        let isValid = true;

        // Clear previous errors
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').hide();

        // Validate Origin
        if ($('#origin').val().trim() === '') {
            $('#origin').addClass('is-invalid');
            $('#origin').next('.invalid-feedback').show();
            isValid = false;
        }

        // Validate Destination
        if ($('#destination').val().trim() === '') {
            $('#destination').addClass('is-invalid');
            $('#destination').next('.invalid-feedback').show();
            isValid = false;
        }

        // Validate Fare
        if ($('#fare').val().trim() === '' || parseFloat($('#fare').val()) <= 0) {
            $('#fare').addClass('is-invalid');
            $('#fare').next('.invalid-feedback').show();
            isValid = false;
        }
        
        // Seat type validation
        if ($('#seatTypeIdr').val() == "0") {
            $('#seatTypeIdr').addClass('is-invalid');
            return;
        } else {
            $('#seatTypeIdr').removeClass('is-invalid');
        }

        // Validate Departure Time
        if ($('#departureTime').val().trim() === '') {
            $('#departureTime').addClass('is-invalid');
            $('#departureTime').next('.invalid-feedback').show();
            isValid = false;
        }

        // Validate ETA
        if ($('#eta').val().trim() === '') {
            $('#eta').addClass('is-invalid');
            $('#eta').next('.invalid-feedback').show();
            isValid = false;
        }

        // If all validations pass, submit the form via AJAX
        if (isValid) {
            let formData = $(this).serialize(); // Serialize the form data
            $('.loading').removeClass('d-none'); // Show loading indicator

            $.ajax({
                type: 'POST',
                url: 'authentication/insert_route.php', // The server-side script to handle form submission
                data: formData,
                success: function (response) {
                    $('.loading').addClass('d-none'); // Hide loading indicator
                    let res = response; // Parse JSON response
                    if (res.success) {
                        alert('Route added successfully!');
                        $('#routeForm')[0].reset(); // Reset the form
                        $('#addRouteModal').modal('hide'); // Hide the modal
                    } else {
                        alert('Error: ' + res.message);
                    }
                },
                error: function () {
                    $('.loading').addClass('d-none'); // Hide loading indicator
                    alert('An error occurred while processing your request.');
                }
            });
        }
    });
});
