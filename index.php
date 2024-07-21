<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/styles.css">
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
         <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/notify.css">
        <link rel="stylesheet" href="css/all.min.css">
        <title>Bus Ticket Booking System</title>
    </head>

    <body>
        <div class="container-fluid body">
            <nav class="nav mt-3">
                <img src="Assets/logo.png" alt="Logo" class="logo">
            </nav>
            <div class="container">
                <h1 class="mt-1 title">Bus Ticket Booking</h1>
                <section class="mt-3 px-2 sector">
                    <form action="" class="form form-group">
                        <div class="form-control">
                            <label for="from">From:</label>
                            <input type="text" name="from" id="from" class="form-control" list="Route-list"
                                placeholder="Enter Departure City" required>
                            <label for="to">To:</label>
                            <select name="to" id="to" class="form-control"
                               placeholder="Enter Destination City" required>
                               <option value="0">-- Select Destination --</option>
                            </select>
                        </div>
                        <div class="form-control mt-1">
                            <label for="date">Travel Date:</label>
                            <input type="date" class="form-control custom-date" name="date" id="date" required>
                            <div class="d-flex justify-content-between mt-1 ">
                                <h3 class="day">

                                </h3>
                                <input type="submit" id="btn" class="btn btn-primary mt-2 mb-2" value="Search">
                            </div>
                            
                        </div>
                    </form>
                    <datalist id="Route-list">
                    </datalist>
                    <datalist id="destination">
                        <!-- <option value="No Buses From That Location"></option> -->
                    </datalist>
                </section>

                <section class="form sector">
                    <div >Route: Dar Es Salam <i class="fa-solid fa-arrow-right-arrow-left arrow"></i> Tanga</div>
                    <div>Day: Sunday</div>
                    <div>Date: 21/07/2024</div>
                </section>
                <section class="sector mt-3 px-2">

                </section>
            </div>

        </div>
        <div id="toast-box"></div>
        <script src="js/jquery-3.7.1.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> -->
         <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="js/notification.js"></script>
        <script src="js/getBuslist.js"></script>
    </body>

</html>