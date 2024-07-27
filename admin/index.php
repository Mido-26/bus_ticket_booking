<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Admin Login</title>
</head>

<body class="body">
    <?php 
    if (isset($_GET['error'])) {
        ?>
        <script>alert('<?php echo $_GET['error']; ?>')</script>
        <?php
    }
    ?>
    <div class="container d-flex justify-content-center align-items-center fff">
        <div class="form px-2 d-flex flex-column justify-content-center align-items-center">
            <h3>TicketFasta System</h3>
            <form action=""  class="form-group shadow " id="Loginform">
                <h4 >Login</h4>
                <div class="alert alert-danger px-1 error" role="alert"  style="display: none;">
                    Username Or Password is Incorrect
                </div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
                <label for="password">Password</label>
                <input type="password" name="password" minlength="4" id="password" class="form-control" required>
                <small><a href="#">Forgot Password?</a></small>
                <input type="submit" class="btn btn-primary mt-2" value="Login">
            </form>
        </div>
    </div>
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/mediaq-q-s.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
