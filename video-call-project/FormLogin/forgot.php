<?php
require_once('connection.php');

$conn = open_dataBase();

$stmt = null;

// Kiểm tra email đã có trong DB chưa.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    if (is_email_exists($email)) {
        $token = rand(100000,999999);
        $expiryTime = date('Y-m-d H:i:s', time() + 60);
        $stmt = $conn->prepare("UPDATE users SET token = ?, expired = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expiryTime, $email);

        if ($stmt->execute()) {
            echo "Gửi mã thành công!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Email không tồn tại!";
    }
    $title = "Update password";
    $content = '';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $user_token = $_POST['token'];

    // Lấy token và thời gian hết hạn từ cơ sở dữ liệu
    $stmt = $conn->prepare("SELECT token, expired FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($db_token, $db_expired);
    $stmt->fetch();

    $current_time = date('Y-m-d H:i:s');

    // Kiểm tra tính hợp lệ của token và thời gian hết hạn
    if ($user_token == $db_token && $current_time <= $db_expired) {
        echo "Mã xác thực hợp lệ. Bạn có thể đặt lại mật khẩu!";
        // Thực hiện bước tiếp theo để đặt lại mật khẩu
    } else {
        echo "Mã xác thực không hợp lệ hoặc đã hết hạn.";
    }

    $stmt->close();
}


$conn->close();
?>
