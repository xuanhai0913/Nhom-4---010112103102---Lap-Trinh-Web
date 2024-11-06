<?php
require_once('../config/db.php');
$conn = open_dataBase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ob_clean(); // Xóa các ký tự không mong muốn trước khi gửi JSON

    $username = trim($conn->real_escape_string($_POST['username']));
    $email = trim($conn->real_escape_string($_POST['email']));
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    if (empty($username) || empty($email) || empty($password)) {
        echo json_encode(array('status' => 'error', 'message' => 'Vui lòng điền đầy đủ thông tin đăng ký.'));
        exit();
    }

    if (isExists('username', $username)) {
        echo json_encode(array('status' => 'error', 'message' => 'Tên đăng nhập này đã tồn tại.'));
        exit();
    } elseif (isExists('email', $email)) {
        echo json_encode(array('status' => 'error', 'message' => 'Email đã được sử dụng.'));
        exit();
    } else {
        $sql = "INSERT INTO users (username, fullname, password, email) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ssss", $username, $username, $password, $email);
            if ($stmt->execute()) {
                echo json_encode(array('status' => 'success', 'message' => 'Đăng ký thành công!'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => "Đăng ký thất bại: " . $stmt->error));
            }
            $stmt->close();
        } else {
            echo json_encode(array('status' => 'error', 'message' => "Lỗi chuẩn bị câu lệnh: " . $conn->error));
            exit();
        }
    }
}
$conn->close();
