$(document).ready(function () {
    let dataArray = [];

    $.ajax({
        url: 'api/fetch_routes.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            dataArray = data;
            let routeSelect = $('#Route-list');
            let existingOptions = {};
            routeSelect.empty();

            // Iterate through each route in the data
            $.each(data, function (index, route) {
                let origin = route.origin;

                // Check if origin is not already an option
                if (!existingOptions[origin]) {
                    let option = $('<option>', {
                        value: origin,
                        text: origin
                    });
                    routeSelect.append(option);
                    existingOptions[origin] = true;
                }
            });
            $('#from').on('change', function () {
                let from = $(this).val();
                let filteredata = dataArray.filter(item => item.origin.toLowerCase() === from);

                let toSelect = $('#to');
                let Options = {};
                // toSelect.empty();

                $.each(filteredata, function (index, route) {
                    let origin = route.destination;

                    if (!Options[origin]) {
                        let option = $('<option>', {
                            value: origin,
                            text: origin
                        });
                        toSelect.append(option);
                        Options[origin] = true;
                    }
                });
                // alert(from); 
            });
        },
        error: function (xhr, status, error) {
            alert('Error fetching routes:', status, error)
            console.error('Error fetching routes:', status, error);
        }
    });
});
