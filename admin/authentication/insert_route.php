<?php
header('Content-Type: application/json'); 
require_once '../authentication/conn.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $pickupLocation = $_POST['pickupLocation'] ?? null;
    $dropLocation = $_POST['dropLocation'] ?? null;
    $via = $_POST['via'] ?? null;
    $departureTime = $_POST['departureTime'];
    $eta = $_POST['eta'];
    $price = intval($_POST['fare']);
    $seatTypeId = intval($_POST['seatTypeId']);

    $stmt = $conn->prepare("INSERT INTO route (origin, destination, pickupLocation, dropLocation, via, DepartureTime, ETA, Price, Seat_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssii", $origin, $destination, $pickupLocation, $dropLocation, $via,  $departureTime, $eta, $price, $seatTypeId);

    if ($stmt->execute()) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "message" => "Error: " . $stmt->error));
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
}
?>
