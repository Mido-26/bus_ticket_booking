<div class="container-fluid panel" id="vBuses">
    <h1 class="mt-4">Buses</h1>
    <div class="row">
        <div class="col ">
            <button type="button" class="btn btn-primary right" data-bs-toggle="modal" data-bs-target="#addBusModal"><i class="fa fa-plus" aria-hidden="true"></i> Add New Bus</button>
        </div>

    </div>
    <div class="modal fade" id="addBusModal" tabindex="-1" aria-labelledby="addBusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBusModalLabel">Add New Route</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="busForm">
                        <div class="mb-3">
                            <label for="busName" class="form-label">Bus Name</label>
                            <input type="text" class="form-control" id="busName" name="busName" required>
                            <div class="invalid-feedback ">Please enter the bus name.</div>
                        </div>
                        <div class="mb-3">
                            <label for="busNo" class="form-label">Bus Number</label>
                            <input type="text" class="form-control" id="busNo" name="busNo" required>
                            <div class="invalid-feedback">Please enter the bus number.</div>
                        </div>
                        <div class="mb-3">
                            <label for="busOwner" class="form-label">Bus Model</label>
                            <input type="text" class="form-control" id="busModel" name="busModel" required>
                            <div class="invalid-feedback">Please enter the bus Model.</div>
                        </div>
                        <div class="mb-3">
                            <label for="seatCapacity" class="form-label">Seat Capacity</label>
                            <input type="number" class="form-control" id="seatCapacity" name="seatCapacity" required>
                            <div class="invalid-feedback">Please enter the seat capacity.</div>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="seatTypeId" class="form-label">Seat Type</label>
                            <select class="form-select" id="seatTypeId" name="seatTypeId" required>
                                <option value="0" >-- Select Seat Types --</option> -->
                                <!-- Options will be populated from the database -->
                            <!-- </select>
                            <div class="invalid-feedback">Please select a seat type.</div>
                        </div> -->
                        <div class="mb-3">
                            <label for="routeId" class="form-label">Route</label>
                            <select class="form-select" id="routeId" name="routeId" required>
                            <option value="0" >-- Select Route --</option>
                            </select>
                            <div class="invalid-feedback">Please select a route.</div>
                        </div>
                        <div class="mb-3">
                            <label for="features" class="form-label">Features</label>
                            <div class="d-flex gap-2">
                                <!-- Example static options for demonstration -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Air Conditioning" id="feature1" name="features[]">
                                    <label class="form-check-label" for="feature1">Air Conditioning</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="WiFi" id="feature2" name="features[]">
                                    <label class="form-check-label" for="feature2">WiFi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Reclining Seats" id="feature3" name="features[]">
                                    <label class="form-check-label" for="feature3">Reclining Seats</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Bus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Populate seat type options dynamically
        // $.ajax({
        //     url: 'authentication/fetch_seat_types.php',
        //     method: 'GET',
        //     dataType: 'json',
        //     success: function(data) {
        //         let seatTypeSelect = $('#seatTypeId');
        //         $.each(data, function(index, seatType) {
        //             seatTypeSelect.append('<option value="' + seatType.id + '">' + seatType.seatTypeName + '</option>');
        //         });
        //     }
        // });

        // Populate route options dynamically
        $.ajax({
            url: 'authentication/fetch_routes.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                let routeSelect = $('#routeId');
                $.each(data, function(index, route) {
                    routeSelect.append('<option value="' + route.id + '">' + route.origin + ' to ' + route.destination + ' via ' + route.via + ' '+ route.seatTypeName +'</option>');
                });
            }
        });

        $('#busForm').on('submit', function(e) {
            e.preventDefault();

            let form = $(this)[0];
            if (form.checkValidity() === false) {
                e.stopPropagation();
                $(form).addClass('was-validated');
                return;
            }

            // if ($('#seatTypeId').val() == "0") {
            //         $('#seatTypeId').addClass('is-invalid');
            //         return;
            //     } else {
            //         $('#seatTypeId').removeClass('is-invalid');
            //     }

                if ($('#routeId').val() == "0") {
                    $('#routeId').addClass('is-invalid');
                    return;
                } else {
                    $('#routeId').removeClass('is-invalid');
                }
                
            let formData = $(this).serialize();
            $.ajax({
                url: 'authentication/insert_bus.php',
                method: 'POST',
                data: formData,
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.success) {
                        alert('Bus added successfully!');
                        $('#busForm')[0].reset();
                        $('#busForm').removeClass('was-validated');
                    } else {
                        alert('Error adding bus: ' + response.message);
                    }
                }
            });
        });
    });
</script>