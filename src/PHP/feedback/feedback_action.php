<?php
session_start(); // Thêm dòng này để khởi tạo phiên

include_once '../config/db.php';

$conn = open_dataBase();
$successMessage = ""; // Biến lưu thông báo thành công

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $issue = trim($_POST['issue']);
    $description = trim($_POST['description']);
    
    // Kiểm tra nếu người dùng đã đăng nhập và có session
    if (!isset($_SESSION['username'])) {
        echo json_encode(["status" => "error", "message" => "Bạn cần đăng nhập để gửi phản hồi."]);
        exit;
    }

    $username = $_SESSION['username']; // Lấy username từ session

    // Kiểm tra nếu có lỗi trong dữ liệu
    if (empty($issue) || $issue === "chose" || empty($description)) {
        echo json_encode(["status" => "error", "message" => "Vui lòng điền đầy đủ thông tin và chọn loại phản hồi!"]);
        exit;
    }

    // Prepared statement để tránh SQL Injection
    $stmt = $conn->prepare("INSERT INTO feedbacks (issue, description, username) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $issue, $description, $username);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Cảm ơn bạn đã gửi phản hồi! Chúng tôi sẽ xem xét trong thời gian sớm nhất."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi: " . $conn->error]);
    }

    // Đóng kết nối
    $stmt->close();
    $conn->close();
}
?>
