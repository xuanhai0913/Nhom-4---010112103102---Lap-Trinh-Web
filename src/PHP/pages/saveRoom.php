<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy roomId từ yêu cầu
    $data = json_decode(file_get_contents("php://input"), true);
    $roomId = $data['roomId'] ?? null;

    if ($roomId) {
        $_SESSION['roomId'] = $roomId;
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
