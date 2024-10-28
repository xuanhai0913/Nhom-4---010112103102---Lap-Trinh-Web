<?php

require_once('../includes/db.php');
$conn = open_dataBase();

// Sử dụng PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; // Đường dẫn đến autoload.php của Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Kiểm tra xem email có hợp lệ không
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Địa chỉ email không hợp lệ.';
        exit();
    }

    $result = getDataByKey('email',$email,'username');

    if ($result->num_rows > 0) {
        // Tạo mã xác thực ngẫu nhiên
        $verification_code = rand(100000, 999999);

        // Lưu mã vào phiên (session) để so sánh sau này
        session_start();
        $_SESSION['verification_code'] = $verification_code;

        // Gửi email
        $mail = new PHPMailer(true);
        try {
            // Cấu hình máy chủ SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Máy chủ SMTP của Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'manhkinddiol@gmail.com'; // Địa chỉ email của bạn
            $mail->Password = 'kiuq ukui bsqi yqtd'; // Mật khẩu email hoặc mật khẩu ứng dụng
            $mail->Port = 465; // Sử dụng cổng 465 cho SMTPS
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Bảo mật SMTPS

            $mail->CharSet = "UTF-8";            
            
            // Người gửi và người nhận
            $mail->setFrom('manhkinddiol@gmail.com', 'V2meet - nơi ngọc trung tỏa sáng');
            $mail->addAddress($email);
            
            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = 'Mã xác thực của bạn';
            $mail->Body = "Mã xác thực của bạn là: <b>$verification_code</b>";
            
            $mail->send();
            echo "Mã xác đã được gửi đi. Vui lòng kiểm tra email.";
            
        } catch (Exception $e) {
            echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Email chưa có tài khoản, vui lòng tạo tài khoản.';
    }

}

$conn->close();
