<?php
session_start();
header('Content-Type: application/json'); // Đảm bảo định dạng JSON
require_once('../config/db.php');

$conn = open_dataBase();

if (isset($_SESSION['email']) && $_SESSION['email'] !== '') {
    $email = $_SESSION['email'];

    if (empty($_POST['password-first'])) {
        echo json_encode(['status' => 'error', 'message' => 'Vui lòng nhập mật khẩu mới', 'object' => 'password', 'form' => 'first']);
        exit();
    }
    if (empty($_POST['password-second'])) {
        echo json_encode(['status' => 'error', 'message' => 'Vui bạn nhập lại mật khẩu', 'object' => 'password', 'form' => 'second']);
        exit();
    }
    if ($_POST['password-first'] !== $_POST['password-second']) {
        echo json_encode(['status' => 'error', 'message' => '2 mật khẩu không khớp', 'object' => 'password', 'form' => 'second']);
        exit();
    }

    // Lấy mật khẩu hiện tại từ cơ sở dữ liệu
    $sql = "SELECT password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($current_password_hash);
    $stmt->fetch();
    $stmt->close();

    // Kiểm tra mật khẩu mới có giống mật khẩu hiện tại không
    if (password_verify($_POST['password-first'], $current_password_hash)) {
        echo json_encode(['status' => 'error', 'message' => 'Mật khẩu mới phải khác với mật khẩu hiện tại!', 'object' => 'password', 'form' => 'first']);
        exit();
    }

    // Mã hóa mật khẩu mới và cập nhật vào cơ sở dữ liệu
    $new_password_hash = password_hash($_POST['password-first'], PASSWORD_DEFAULT);

    $sql = "UPDATE users SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $new_password_hash, $email);
    $stmt->execute();

    echo json_encode(['status' => 'success', 'message' => 'Đổi mật khẩu thành công!']);
    $stmt->close();
    $conn->close();
} else {
    header("Location: ../pages/index.php");
    exit();
}
?>