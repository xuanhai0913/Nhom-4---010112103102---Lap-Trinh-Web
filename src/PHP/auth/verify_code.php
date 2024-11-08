<?php
require_once('../config/db.php');
$conn = open_dataBase();
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codeByUser = $_POST['verify-code'] ?? '';
    $email = $_SESSION['email'] ?? '';
    if (!empty($email)) {
        // Kiem tra xem email da ton tai trong database chua
        $sql = "SELECT token FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $dbtoken = $result->fetch_assoc()['token'];

            if ($dbtoken === $codeByUser) {
                unset($_SESSION['verification_code']);
                echo json_encode(array('status' => 'success', 'message' => 'Mã xác nhận đã đúng', 'object' => 'captcha'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Sai mã xác thực', 'object' => 'captcha', 'form' => 'verify'));
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Vui lòng nhập email', 'object' => 'captcha', 'form' => 'verify'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Vui lòng nhập email', 'object' => 'captcha', 'form' => 'verify'));
    }
}
$conn->close();
?>
