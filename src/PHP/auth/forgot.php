<?php
require_once('../config/db.php');

$conn = open_dataBase();
// Sử dụng PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once(__DIR__ . '/../../../vendor/autoload.php'); // Đường dẫn đến autoload.php của Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Kiểm tra xem email có hợp lệ không
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array('status' => 'error', 'message' => 'Email không hợp lệ', 'object' => 'email', 'form' => 'forgot'));
        exit();
    }

    // Kiểm tra xem email có tồn tại trong cơ sở dữ liệu không
    $result = getDataByKey('email', $email, 'username');
    
    // Nếu không tìm thấy email trong cơ sở dữ liệu, trả về thông báo lỗi
    if ($result->num_rows <= 0) {
        echo json_encode(array('status' => 'error', 'message' => 'Email chưa có tài khoản, vui lòng tạo tài khoản!', 'object' => 'email', 'form' => 'forgot'));
        exit();
    }

    // Tạo mã xác thực ngẫu nhiên
    $verification_code = rand(100000, 999999);

    // Cập nhật mã token vào database.
    $sql = 'UPDATE users SET token = ? WHERE email = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $verification_code, $email);
    session_start();
    $_SESSION['email'] = $email;

    if ($stmt->execute()) {
        // Gửi email
        $mail = new PHPMailer(true);
        try {
            // Cấu hình máy chủ SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Máy chủ SMTP của Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'trungbed1ve@gmail.com'; // Địa chỉ email của bạn
            $mail->Password = 'uaiq ygpc ypfy cfod'; // Mật khẩu email hoặc mật khẩu ứng dụng
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
            echo json_encode(array('status' => 'success', 'message' => 'Mã xác thực đã được gửi đi!'));
            exit();
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'message' => "Không thể gửi email. Lỗi: {$mail->ErrorInfo}", 'object' => 'email', 'form' => 'forgot'));
            exit();
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => "Không thể gửi email. Lỗi: " . $stmt->error, 'object' => 'email', 'form' => 'forgot'));
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
