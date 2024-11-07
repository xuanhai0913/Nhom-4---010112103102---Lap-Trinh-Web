<?php
require_once('../config/db.php');

$conn = open_dataBase();

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Kiểm tra nếu các trường không bị bỏ trống
    if (empty($username)) {
        echo json_encode(array('status' => 'error', 'message' => 'Vui lòng nhập tên người dùng!', 'object' => 'username', 'form' => 'login'));
        exit();
    }
    // Nếu tên người dùng không tồn tại thì sẽ xuất thông báo lỗi và dừng lại.
    if (!isExists('username', $username)) {
        echo json_encode(array('status' => 'error', 'message' => 'Tên người dùng không tìm thấy!', 'object' => 'username', 'form' => 'login'));
        exit();
    }
    if (empty($password)) {
        echo json_encode(array('status' => 'error', 'message' => 'Vui lòng nhập mật khẩu!', 'object' => 'password', 'form' => 'login'));
        exit();
    }

    // Lấy mật khẩu đã mã hóa từ cơ sở dữ liệu dựa trên tên người dùng
    $result = getDataByKey('username', $username, 'password');

    // Kiểm tra nếu kết quả trả về có hàng dữ liệu
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password']; // Lấy mật khẩu đã mã hóa từ kết quả

        // Kiểm tra mật khẩu
        if (password_verify($password, $hashed_password)) {
            // Mật khẩu chính xác, bắt đầu phiên
            session_start();
            $_SESSION['username'] = $username; // Lưu thông tin người dùng vào phiên
            echo json_encode(array('status' => 'success', 'message' => 'Đăng nhập thành công!'));
            exit();
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Sai mật khẩu!', 'object' => 'password', 'form' => 'login'));
            exit();
        }
    }
}

$conn->close();
