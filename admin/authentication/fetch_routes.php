<?php
require_once 'conn.php';

$sql = "SELECT r.* , s.seatTypeName  FROM route r LEFT JOIN seat_type s ON (s.id = r.seat_id)";
$result = mysqli_query($conn, $sql);
$routes = array();

while ($row = mysqli_fetch_assoc($result)) {
    $routes[] = $row;
}

echo json_encode($routes);
?>
