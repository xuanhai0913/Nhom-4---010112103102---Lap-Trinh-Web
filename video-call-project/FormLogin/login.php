<?php
require_once('connection.php');

session_start();

$className = '';
$conn = open_dataBase();

// Khởi tạo biến $stmt
$stmt = null;

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    empty_content_login($username, $password);

    // Sử dụng prepared statement để bảo mật
    if (is_username_exists($username)) {
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        if (!$stmt) {
            die("Không thể chuẩn bị câu lệnh: " . $conn->error);
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($hashed_password);

        if ($stmt->fetch() && password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $username; // Lưu thông tin người dùng vào phiên
            header('Location: ../pages/home.php');
            exit();
        } else {
            echo 'Sai tên người dùng hoặc mật khẩu!';
        }

        $stmt->close(); // Đóng câu lệnh
    } else {
        echo 'Sai tên người dùng hoặc mật khẩu!';
    }
}
