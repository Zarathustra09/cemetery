<?php
include '../../connectMySql.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $query = "DELETE FROM request WHERE id = $id";
    if ($conn->query($query)) {
        echo json_encode(['status' => 'success']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
}
?>
