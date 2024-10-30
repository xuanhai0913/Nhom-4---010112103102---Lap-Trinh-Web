<?php
// verify_code.php
require_once('../config/db.php');
$conn = open_dataBase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy mã xác thực từ người dùng
    $codeByUser = $_POST['verify_code'] ?? '';
    $email = $_POST['email'] ?? '';

    // Kiểm tra xem email có tồn tại trong phiên hay không
    if (!empty($email)) {
        // Lấy token trong database dựa trên email
        $result = getDataByKey('token', 'email', $email);
        
        if ($result->num_rows > 0) {
            $dbtoken = $result->fetch_assoc()['token'];
            
            // So sánh mã xác thực từ người dùng với mã trong cơ sở dữ liệu
            if ($dbtoken === $codeByUser) {
                echo "Mã xác nhận đã đúng";
                // Có thể thực hiện thêm các hành động ở đây như chuyển hướng người dùng hoặc xóa mã xác thực
                unset($_SESSION['verification_code']); // Xóa mã trong session nếu không cần nữa
            } else {
                echo "Mã xác nhận sai. Vui lòng nhập lại!";
            }
        } else {
            echo 'Không lấy được dữ liệu trong database';
        }
    } else {
        echo 'Email không tồn tại trong phiên.';
    }
}
$conn->close();
?>