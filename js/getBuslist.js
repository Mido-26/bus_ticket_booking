$(document).ready(function () {
    let dataArray = [];

    $.ajax({
        url: 'api/fetch_routes.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            dataArray = data;
            console.log(dataArray);
            let routeSelect = $('#from');
            let existingOptions = {};
            routeSelect.empty();
            routeSelect.append('<option value="0">-- Chagua Mwanzo Wa Safari --</option>');

            // Populate the "from" dropdown with unique origins
            $.each(data, function (index, route) {
                let origin = route.origin;

                if (!existingOptions[origin]) {
                    let option = $('<option>', {
                        value: origin,
                        text: origin
                    });
                    routeSelect.append(option);
                    existingOptions[origin] = true;
                }
            });

            // Change event listener for "from" dropdown
            $('#from').on('change', function () {
                let from = $(this).val().toLowerCase();
                console.log("Selected from:", from);
                let filteredData = data.filter(item => item.origin.toLowerCase() == from);

                console.log("Filtered data:", filteredData);

                let toSelect = $('#to');
                let Options = {};
                toSelect.empty();
                toSelect.append('<option value="0">-- Select Destination --</option>');  // Add default option

                // Populate the "to" dropdown with destinations
                $.each(filteredData, function (index, route) {
                    let destination = route.destination;

                    if (!Options[destination]) {
                        let option = $('<option>', {
                            value: destination,
                            text: destination
                        });
                        toSelect.append(option);
                        Options[destination] = true;
                    }
                });
            });
        },
        error: function (xhr, status, error) {
            console.error('Error fetching routes:', status, error);
            alert('Error fetching routes. Please try again later.');
        }
    });
});
