<?php
require_once 'conn.php';

$sql = "SELECT id, seatTypeName FROM seat_type";
$result = mysqli_query($conn, $sql);
$seatTypes = array();

while ($row = mysqli_fetch_assoc($result)) {
    $seatTypes[] = $row;
}

echo json_encode($seatTypes);
?>
