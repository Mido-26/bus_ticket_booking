<?php
require_once 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = addslashes(trim($_POST['username']));
    $roleID = intval($_POST['roleID']);
    $pass = md5($_POST['pass']);

    // Check if the username already exists
    $checkUserSql = "SELECT * FROM users WHERE username = '$username'";
    $checkResult = mysqli_query($conn, $checkUserSql);

    if (mysqli_num_rows($checkResult) > 0) {
        echo json_encode(array('success' => false, 'message' => 'Username already exists.'));
    } else {
        $sql = "INSERT INTO users (username, roleID, pass) VALUES ('$username', $roleID, '$pass')";

        if (mysqli_query($conn, $sql)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false, 'message' => mysqli_error($conn)));
        }
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}
?>
