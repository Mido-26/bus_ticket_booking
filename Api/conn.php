<?php 
	$user = "root";
	$pass = "";
	$host = "localhost";
	$name = "bus_booking_system";

	$conn = mysqli_connect($host,$user,$pass,$name);
	if (!$conn) {
		die(json_encode(array('status' => 'error', 'em' => 'Database connection failed')));
	}
 ?>