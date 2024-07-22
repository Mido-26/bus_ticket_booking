<?php
require_once 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $busName = mysqli_real_escape_string($conn, trim($_POST['busName']));
    $busNo = mysqli_real_escape_string($conn, trim($_POST['busNo']));
    $seatCapacity = intval($_POST['seatCapacity']);
    $routeId = intval($_POST['routeId']);
    $features = $_POST['features'];
    $busModel = addslashes($_POST['busModel']);

    // Check if the bus number already exists
    $checkBusSql = "SELECT * FROM bus WHERE busNo = '$busNo'";
    $checkResult = mysqli_query($conn, $checkBusSql);

    if (mysqli_num_rows($checkResult) > 0) {
        echo json_encode(array('success' => false, 'message' => 'Bus number already exists.'));
        exit();
    }

    // Insert new bus
    $sql = "INSERT INTO bus (busName, busNo, seatCapacity, RouteId, busModel) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssiis', $busName, $busNo, $seatCapacity, $routeId, $busModel);

    if ($stmt->execute()) {
        $last_id = $stmt->insert_id;

        // Insert bus features
        if (is_array($features)) {
            $sql_features = "INSERT INTO bus_features (busid, feature) VALUES (?, ?)";
            $stmt_feature = $conn->prepare($sql_features);
            foreach ($features as $feature) {
                $stmt_feature->bind_param('is', $last_id, $feature);
                $stmt_feature->execute();
            }
            $stmt_feature->close();
        }

        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'message' => $stmt->error));
    }

    $stmt->close();
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}
?>
