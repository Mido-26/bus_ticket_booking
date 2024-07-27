<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/notify.css">
    <link rel="stylesheet" href="css/all.min.css">
    <title>TicketFasta</title>
    <style>
        .seating-area {
            width: 40%;
            border-right: 1px solid #ccc;
            padding-right: 20px;
        }

        .seating-chart {
            display: grid;
            grid-gap: 10px;
        }

        .seat {
            width: 40px;
            height: 40px;
            background-color: green;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            border-radius: 5px;
        }

        .seat.sold {
            background-color: red;
            cursor: not-allowed;
        }

        .seat.selected {
            /* background-color: var(--primary-color); */
            background-color: #ccc;
        }

        .legend {
            margin-top: 20px;
        }

        .legend-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 5px;
        }

        .legend-item .seat {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container-fluid body">
        <nav class="nav mt-3">
            <img src="Assets/logo.png" alt="Logo" class="logo">
        </nav>
        <div class="container">
            <h1 class="mt-1 title fs-3 fw-bold">TicketFasta</h1>
            <section class="mt-3 px-2 sector">
                <form action="" class="d-flex gap-2 justify-content-center align-items-center form-group">
                    <div class="form-control">
                        <label for="from">From:</label>
                        <select name="from" id="from" class="form-control" placeholder="Enter Departure City" required>
                            <option value="0">-- Chagua Mwanzo Wa Safari --</option>
                        </select>
                        <label for="to">To:</label>
                        <select name="to" id="to" class="form-control" placeholder="Enter Destination City" required>
                            <option value="0">-- Chagua Mwisho Wa Safari --</option>
                        </select>
                    </div>
                    <div class="form-control mt-1">
                        <label for="date">Travel Date:</label>
                        <input type="date" class="form-control custom-date" name="date" id="date" required>
                        <div class="d-flex justify-content-between mt-1 ">
                            <h3 class="day"></h3>
                            <input type="submit" id="btn" class="btn btn-primary mt-2 mb-2 inp" value="Search">
                            <button class="btn btn-primary d-none bbt" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                <span role="status">Search</span>
                            </button>
                        </div>
                    </div>
                </form>
            </section>
            <section class="form sector d-none">
                <div>Route: <span class="fro"></span> <i class="fa-solid fa-arrow-right-arrow-left arrow"></i> <span class="ot"></span></div>
                <div>Day: <span class="dy"></span></div>
                <div>Date: <span class="dat"></span></div>
            </section>
            <section class="d-flex flex-column gap-5 justify-content-start align-items-center mt-5 px-1 bus-container mb-4">
                <div class="alert alert-danger px-1 em-e d-none" role="alert" id="alert">
                    No Buses for the route Choosed Try again
                </div>
            </section>

            <div class="modal fade" id="seatModal" tabindex="-1" role="dialog" aria-labelledby="seatModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fs-3 fw-bolder" id="seatModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body w-100 d-flex flex-column justify-content-start align-items-center gap-2">
                            <div class="heeda d-flex justify-content-center">
                                <h4 class="fw-bold fs-5">Choose Seat To Book</h4>
                            </div>
                            <div class="d-flex seatinfo w-100 justify-content-between align-items-start gap-4">
                                <div class="modalHeader  w-40 d-flex flex-column justify-content-start align-items-center gap-2">
                                    <div class="legend border fw-bold fs-6 d-flex gap-2 p-1">
                                        <div class="legend-item "><span class="seat available"></span><span> Available</span></div>
                                        <div class="legend-item "><span class="seat sold"></span><span>Sold</span></div>
                                        <div class="legend-item "><span class="seat selected"></span><span>Selected</span></div>
                                    </div>
                                    <div class="seating-chart  border p-1" id="seatingChart"></div>
                                </div>
                                <div class="modalInfoBody w-100 d-flex flex-column justify-content-center align-items-center gap-5 px-2 ">
                                    <div class="bodyinfo w-100">
                                        <label for="">Starting Point</label>
                                        <input type="tel" name="" id="destin" class="form-control" readonly>
                                        <label for="">Dropping Point</label>
                                        <input type="tel" name="" id="dropping" class="form-control" readonly>
                                    </div>
                                    <div class="bookinginfo w-100 px-1">
                                        <div class="form-control colorr">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i> Passenger Info
                                        </div>
                                            <form id="bookingForm" novalidate>

                                                <div class="mb-3">
                                                    <label for="customerName" class="form-label">Customer Name</label>
                                                    <input type="text" class="form-control" id="customerName" name="customerName" placeholder="Enter FullName" required>
                                                    <div class="invalid-feedback">Please enter your name.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="customerPhone" class="form-label">Customer Phone</label>
                                                    <input type="tel" class="form-control" id="customerPhone" name="customerPhone" placeholder="Insert Mobile Number" required>
                                                    <div class="invalid-feedback">Please enter your phone number.</div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="seatNumber" class="form-label">Seat Number</label>
                                                    <input type="text" class="form-control" id="seatNumber" name="seatNumber[]" placeholder="Selected seats will appear Here" required readonly>
                                                    <div class="invalid-feedback">Please enter a seat number.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="bookingDate" class="form-label">Booking Date</label>
                                                    <input type="date" class="form-control" id="bookingDate" name="bookingDate" required readonly>
                                                    <div class="invalid-feedback">Please select a booking date.</div>
                                                </div>
                                                <!-- <button type="submit" class="btn btn-primary">Book Now</button> -->
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn-close btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button> -->
                            <button type="button" class="btn btn-primary" id="continueButton">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <template id="buslists">
        <div class="d-flex flex-column justify-content-center align-items-center shadow p-1 bus-row fadeIn bzz">
            <div class="bus-header d-flex justify-content-start align-items-center w-100 gap-3 px-2">
                <h5 class="fw-bold color-p bus-name ">Ratco Exp</h5>
                <span class="seatType fw-bold fs-6"></span>
            </div>
            <div class="bus-info d-flex justify-content-between align-items-center px-1 gap-3 w-100">
                <div class="d-flex flex-column w-100">
                    <p class="m-1"><span class="f-rom">Dar Es Salam</span> &rarr; <span class="t-o">Tanga</span></p>
                    <p class="m-1"><strong class="bus-no">T 267 EDF</strong></p>
                    <p class="m-1 bus-model"></p>
                    <ul class="bus-features p-0">
                        <li><i class="fas fa-tint text-primary"></i><span class="pickLocation"></span></li>
                        <li><i class="fas fa-stop text-danger"></i><span class="dropLocation"></span></li>
                    </ul>
                </div>
                <div class="d-flex justify-content-between align-items-center gap-3 de-time px-4">
                    <div class="depart ">
                        <strong>18:30 PM</strong><br>
                        <small class="text-muted">Departure Time</small>
                    </div>
                    <div class="time">
                        <strong class="d-flex gap-1"><i class="fa-solid fa-map-pin fa-rotate-270"></i><i class="fa-solid fa-clock"></i><i class="fa-solid fa-map-pin fa-rotate-90"></i></strong>
                        <small class="text-danger fw-bold"></small>
                    </div>
                    <div class="destiniy">
                        <strong>23:30 PM</strong><br>
                        <small class="text-muted">Arrival Time</small>
                    </div>
                </div>
                <div class="d-flex gap-2 p-2 ">
                    <div class="availb-seat d-flex justify-content-center align-items-center flex-column gap-1 p-1">
                        <span class="seat"></span><span class="text-muted">Available Seats</span>
                    </div>
                    <div class="booking d-flex flex-column justify-content-center align-items-center gap-2">
                        <div class="price fw-bold fs-5">
                            <strong></strong>
                        </div>
                        <button type="button" class="btn btn-primary gap-1 bookg openModalButton">
                            <span><i class="fa fa-ticket" aria-hidden="true"> </i></span><span> Book</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <div id="toast-box"></div>
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/mediaq-q-s.js"></script>
    <script src="js/notification.js"></script>
    <script src="js/getBuslist.js"></script>
    <script src="js/modalStyle.js"></script>
    <script src="js/validateBookingForm.js"></script>
</body>

</html>