<div class="container-fluid panel" id="vRoutes">
    <h1 class="mt-4">Routes</h1>
    <div class="row">
        <div class="col ">
            <button type="button" class="btn btn-primary right" data-bs-toggle="modal" data-bs-target="#addRouteModal"><i class="fa fa-plus" aria-hidden="true"></i> Add New Route </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addRouteModal" tabindex="-1" aria-labelledby="addRouteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRouteModalLabel">Add New Route</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="routeForm" action="insert_route.php" method="POST">
                            <div class="mb-3">
                                <label for="origin" class="form-label">Origin</label>
                                <input type="text" class="form-control" id="origin" name="origin" required>
                                <div class="invalid-feedback">Please enter the origin.</div>
                            </div>
                            <div class="mb-3">
                                <label for="destination" class="form-label">Destination</label>
                                <input type="text" class="form-control" id="destination" name="destination" required>
                                <div class="invalid-feedback">Please enter the destination.</div>
                            </div>
                            <div class="mb-3">
                                <label for="pickupLocation" class="form-label">Pickup Location</label>
                                <input type="text" class="form-control" id="pickupLocation" name="pickupLocation">
                            </div>
                            <div class="mb-3">
                                <label for="dropLocation" class="form-label">Drop Location</label>
                                <input type="text" class="form-control" id="dropLocation" name="dropLocation">
                            </div>
                            <div class="mb-3">
                                <label for="via" class="form-label">Via</label>
                                <input type="text" class="form-control" id="via" name="via">
                            </div>
                            <div class="mb-3">
                                <label for="fare" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control" id="fare" name="fare" required>
                                <div class="invalid-feedback">Please enter a valid Price.</div>
                            </div>
                            <div class="mb-3">
                                <label for="seatTypeId" class="form-label">Seat Type</label>
                                <select class="form-select" id="seatTypeIdr" name="seatTypeId" required>
                                    <option value="0">-- Select Seat Types --</option>
                                    <!-- Options will be populated from the database -->
                                </select>
                                <div class="invalid-feedback">Please select a seat type.</div>
                            </div>
                            <div class="mb-3">
                                <label for="departureTime" class="form-label">Departure Time</label>
                                <input type="time" class="form-control" id="departureTime" name="departureTime" required>
                                <div class="invalid-feedback">Please enter the departure time.</div>
                            </div>
                            <div class="mb-3">
                                <label for="eta" class="form-label">ETA</label>
                                <input type="time" class="form-control" id="eta" name="eta" required>
                                <div class="invalid-feedback">Please enter the ETA.</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Route</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function () {
        $.ajax({
            url: 'authentication/fetch_seat_types.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                let seatTypeSelect = $('#seatTypeIdr');
                $.each(data, function(index, seatType) {
                    seatTypeSelect.append('<option value="' + seatType.id + '">' + seatType.seatTypeName + '</option>');
                });
            }
        });
    });
</script>