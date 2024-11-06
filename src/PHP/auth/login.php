<?php
require_once('../config/db.php');

$conn = open_dataBase();

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Kiểm tra nếu các trường không bị bỏ trống
    if (empty($username) || empty($password)) {
        echo json_encode(array('status' => 'error', 'message' => 'Vui lòng điền đầy đủ tên người dùng và mật khẩu.'));
        exit();
    }

    // Kiểm tra xem tên người dùng có tồn tại không
    if (isExists('username', $username)) {
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
                echo json_encode(array('status' => 'error', 'message' => 'Sai mật khẩu!'));
                exit();
            }
        }   
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Sai tên người!'));
        exit();
    }
}

$conn->close();
?>