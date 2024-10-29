<?php
require_once('../config/db.php');

session_start();

$className = '';
$conn = open_dataBase();

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    session_start();
    $_SESSION['username'] = $username;

    empty_content_login($username, $password);

    // Kiểm tra xem tên người dùng có tồn tại không
    if (isExists('username',$username)) {
        // Lấy mật khẩu đã mã hóa từ cơ sở dữ liệu dựa trên tên người dùng
        $result = getDataByKey('username', $username, 'password');
        
        // Kiểm tra nếu kết quả trả về có hàng dữ liệu
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password']; // Lấy mật khẩu đã mã hóa từ kết quả

            // Kiểm tra mật khẩu
            if (password_verify($password, $hashed_password)) {
                $_SESSION['username'] = $username; // Lưu thông tin người dùng vào phiên
                header('Location: ../../../../pages/home.php');
                exit();
            } else {
                echo 'Sai tên người dùng hoặc mật khẩu!';
            }
        } else {
            echo 'Sai tên người dùng hoặc mật khẩu!';
        }
    } else {
        echo 'Sai tên người dùng hoặc mật khẩu!';
    }
}
?>
