<?php
require_once 'conn.php';

$sql = "SELECT id, roleName FROM role";
$result = mysqli_query($conn, $sql);
$roles = array();

while ($row = mysqli_fetch_assoc($result)) {
    $roles[] = $row;
}

echo json_encode($roles);
?>
