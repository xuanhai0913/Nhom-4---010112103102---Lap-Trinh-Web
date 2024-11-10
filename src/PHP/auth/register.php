<?php
require_once('../config/db.php');
$conn = open_dataBase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ob_clean(); // Xóa các ký tự không mong muốn trước khi gửi JSON

    $username = trim($conn->real_escape_string($_POST['username']));
    $email = trim($conn->real_escape_string($_POST['email']));
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    if (empty($username)) {
        echo json_encode(array('status' => 'error', 'message' => 'Vui lòng nhập đầy đủ thông tin!', 'object' => 'username', 'form' => 'register'));
        exit();
    }
    if (!preg_match('/^[a-zA-Z0-9._]{5,}$/', $username)) {
        echo json_encode(array('status' => 'error', 'message' => 'Chỉ sử dụng (a-z, A-Z, 0-9, ., _) và ít nhất 5 ký tự', 'object' => 'username', 'form' => 'register'));
        exit();
    }
    if (isExists('username', $username)) {
        echo json_encode(array('status' => 'error', 'message' => 'Tên đăng nhập này đã tồn tại.', 'object' => 'username', 'form' => 'register'));
        exit();
    }
    if (empty($email)) {
        echo json_encode(array('status' => 'error', 'message' => 'Vui lòng nhập thông tin email!', 'object' => 'email', 'form' => 'register'));
        exit();
    }
    if (isExists('email', $email)) {
        echo json_encode(array('status' => 'error', 'message' => 'Email đã được sử dụng.', 'object' => 'email', 'form' => 'register'));
        exit();
    }
    if (!isset($_POST['password']) || strlen(trim($_POST['password'])) === 0) {
        echo json_encode(array('status' => 'error', 'message' => 'Vui lòng nhập mật khẩu!', 'object' => 'password', 'form' => 'register'));
        exit();
    }
    if (preg_match('/[^a-zA-Z0-9]/', $_POST['password'])) {
        echo json_encode(array('status' => 'error', 'message' => 'Mật khẩu không chứa cách hoặc kí tự đặt biệt!', 'object' => 'password', 'form' => 'register'));
        exit();
    }

    $sql = "INSERT INTO users (username, fullname, password, email) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssss", $username, $username, $password, $email);
        if ($stmt->execute()) {
            echo json_encode(array('status' => 'success', 'message' => 'Đăng ký thành công!'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => "Đăng ký thất bại: " . $stmt->error, 'object' => 'register', 'form' => 'register'));
        }
        $stmt->close();
    } else {
        echo json_encode(array('status' => 'error', 'message' => "Lỗi chuẩn bị câu lệnh: " . $conn->error));
        exit();
    }
}
$conn->close();
