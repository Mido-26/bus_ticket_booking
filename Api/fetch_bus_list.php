<?php
require_once 'conn.php';

$sql = "SELECT 
    b.*, r.origin, r.destination,r.pickupLocation,r.dropLocation, r.via, r.DepartureTime, r.ETA, r.Price, st.seatTypeName, st.columns, 
    GROUP_CONCAT(bf.feature) AS bus_features ,
    GROUP_CONCAT(bk.seatNumber) AS sold
FROM 
    bus b 
    LEFT JOIN route r ON r.id = b.RouteId
    LEFT JOIN bus_features bf ON b.id = bf.busId
    LEFT JOIN seat_type st ON st.id = r.seat_id
    LEFT JOIN BOOKING bk ON bk.busId = b.id 
GROUP BY 
    b.id, r.id, st.seatTypeName
";
$result = mysqli_query($conn, $sql);
$routes = array();

while ($row = mysqli_fetch_assoc($result)) {
    $buses[] = $row;
}

echo json_encode($buses);
