<?php
require_once('../config/db.php');

$className = '';
$conn = open_dataBase();

// Xử lý thông tin đăng ký khi form được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Mã hóa mật khẩu

    // Kiểm tra nếu thông tin không trống
    empty_content_register($username, $email, $password);
    // Kiểm tra xem tên người dùng đã tồn tại
    if (isExists('username',$username)) {
        $className = 'input--error';
    } else if (isExists('email',$email)) {
        echo 'Email đã được sử dụng. Vui lòng nhập Email khác!';
    } else {

        // Chèn thông tin vào bảng
        $sql = "INSERT INTO users (username,fullname, password, email) VALUES (?, ?, ?,?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $username, $username, $password, $email);

            if ($stmt->execute()) {
                echo "Đăng ký thành công!";
                header('Location: ../pages/index.php');
                exit();
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
