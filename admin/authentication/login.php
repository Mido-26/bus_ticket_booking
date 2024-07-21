<?php 
session_start();
require_once 'conn.php';

$response = array("success" => false, "message" => "Invalid Credentials");

if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $user = addslashes(trim($_POST['username']));
    $pass = $_POST['password'];
    $sql = "SELECT u.*, r.roleName FROM users u LEFT JOIN role r ON u.roleId = r.id WHERE username = '$user' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $pass = md5($pass);

        if ($row['username'] == $user && $row['pass'] === $pass) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['user'] = $row['username'];
            $_SESSION['role'] = $row['roleName'];
            $_SESSION['pass'] = $row['pass'];

            $response = array("success" => true, "message" => "Login Successfully");
        }
        // echo $pass . $row['pass'];
    }
}

echo json_encode($response);
exit();
?>
