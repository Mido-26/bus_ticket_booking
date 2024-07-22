<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/all.min.css">
        <link rel="stylesheet" href="css/admin.css">
        <title>Dashboard</title>
    </head>

    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="bg-dark border-right" id="sidebar-wrapper">
                <div class="sidebar-heading d-flex align-items-center justify-content-center py-2 my-3">
                    <img src="../Assets/logo.png" class="mt-2" alt="">
                </div>
                <div class="list-group list-group-flush mt-4 nav-link">
                    <a href="#" class="list-group-item  active link" rel="dashboard">
                        <i class="fas fa-home me-2"></i> Dashboard
                    </a>
                    <a href="#" class="list-group-item link" rel="aUsers">
                        <i class="fas fa-user me-2"></i> View Users
                    </a>
                    <a href="#" class="list-group-item link" rel="vBuses">
                        <i class="fas fa-bus me-2"></i> View Buses
                    </a>
                    <a href="#" class="list-group-item link" rel="vRoutes">
                        <i class="fas fa-road me-2"></i> View Routes
                    </a>
                    <a href="#" class="list-group-item link" rel="logout">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                </div>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <button class="btn btn-primary" id="menu-toggle">
                        <i class="fas fa-bars menu"></i>
                    </button>
                    <h3 class="mx-3">Bus Ticket Booking System</h3>
                </nav>
                <div class="container-fluid panel" id="dashboard">
                    <h1 class="mt-4">Dashboard</h1>
                    <div class="row" id="dashboard-cards">
                        <!-- Card 1: Total Buses -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <i class="fas fa-bus fa-2x mb-3"></i>
                                    <h5 class="card-title">Total Buses</h5>
                                    <p class="card-text">100</p>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2: Total Routes -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <i class="fas fa-road fa-2x mb-3"></i>
                                    <h5 class="card-title">Total Routes</h5>
                                    <p class="card-text">50</p>
                                </div>
                            </div>
                        </div>
                        <!-- Card 3: Bookings Today -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <i class="fas fa-calendar-day fa-2x mb-3"></i>
                                    <h5 class="card-title">Bookings Today</h5>
                                    <p class="card-text">25</p>
                                </div>
                            </div>
                        </div>
                        <!-- Card 4: All-time Bookings -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <i class="fas fa-calendar-alt fa-2x mb-3"></i>
                                    <h5 class="card-title">All-time Bookings</h5>
                                    <p class="card-text">5000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="../js/jquery-3.7.1.js"></script>
                <script src="../js/bootstrap.bundle.min.js"></script>
                <?php include '../admin/webpages/buses.php' ?>
                <?php include '../admin/webpages/routes.php' ?>
                <?php include '../admin/webpages/users.php' ?>
            </div>
            <div class="loading d-none justify-content-center align-items-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

        </div>

        <!-- <script src="../js/jquery-3.6.0.min.js"></script> -->
        <script src="js/scripts.js"></script>
        <script src="js/routevalidation.js"></script>
        <script>
            $(document).ready(function() {
                $('.link').on('click', function() {
                    let linkToShow = $(this).attr('rel');
                    // alert(linkToShow)
                    $('.link.active').removeClass('active');
                    $(this).addClass('active');
                    $('.panel').hide();
                    $('#' + linkToShow).fadeIn();

                    if (linkToShow == 'logout') {
                        window.location.href = 'authentication/logout.php';
                    }
                });
            });
        </script>
    </body>

    </html>
<?php
} else {
    session_unset();
    session_destroy();
    header('Location: ../index.php?error=Unauthorized access');
    exit();
}
?>