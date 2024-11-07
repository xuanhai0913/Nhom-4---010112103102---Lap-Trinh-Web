<?php
include_once('../config/config.php');
$conn = open_dataBase();
session_start();
if ($_SESSION['email'] !== '') {
    $email = $_SESSION['email'];
    if ($_POST['password-first'] === '') {
        echo json_encode(array('status' => 'error', 'message' => 'Vui lòng nhập mật khẩu mới', 'object' => 'password', 'form' => 'first'));
        exit();
    }
    if ($_POST['password-second'] === '') {
        echo json_encode(array('status' => 'error', 'message' => 'Vui bạn nhập lại mật khẩu', 'object' => 'password', 'form' => 'second'));
        exit();
    }
    if ($_POST['password-first'] !== $_POST['password-second']) {
        echo json_encode(array('status' => 'error', 'message' => '2 mật khẩu không khớp', 'object' => 'password', 'form' => 'second'));
        exit();
    }

    $password = $_POST['password-first'];

    $sql = "UPDATE users SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $password, $email);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    echo json_encode(array('status' => 'success', 'message' => 'Đổi mật khẩu thành công!'));
}
?>