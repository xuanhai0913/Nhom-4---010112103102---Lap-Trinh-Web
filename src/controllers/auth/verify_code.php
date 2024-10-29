<?php
// verify_code.php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_code = $_POST['verification_code'];
    $saved_code = $_SESSION['verification_code'] ?? '';

    if ($input_code == $saved_code) {
        echo "Mã xác thực thành công!";
        // Xóa mã xác thực đã lưu
        unset($_SESSION['verification_code']);
    } else {
        echo "Mã xác thực không chính xác!";
    }
}
?>
