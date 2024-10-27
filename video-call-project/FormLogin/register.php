<?php
require_once('connection.php');

$conn = open_dataBase();

// Xử lý thông tin đăng ký khi form được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Mã hóa mật khẩu

    // Kiểm tra nếu thông tin không trống
    empty_content_register($username, $email, $password);
    // Kiểm tra xem tên người dùng đã tồn tại
    if (is_username_exists($username)) {
        echo 'Tên người dùng đã tồn tại!';
    } else if (is_email_exists($email)) {
        echo 'Email đã được sử dụng. Vui lòng nhập Email khác!';
    } else {

        // Chèn thông tin vào bảng
        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $username, $password, $email);

            if ($stmt->execute()) {
                echo "Đăng ký thành công!";
            } else {
                echo "Đăng ký thất bại: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Lỗi chuẩn bị câu lệnh: " . $conn->error;
        }
    }
}

// Đóng kết nối
$conn->close();
