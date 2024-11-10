<?php
require_once('../config/db.php');

$conn = open_dataBase();

// Lấy thông tin người dùng hiện tại
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra form đã được gửi và có phải là form thay đổi thông tin người dùng
    if (isset($_POST['submit_save_profile'])) {
        // Nhận dữ liệu từ form và lọc dữ liệu
        $fullname = trim($_POST['fullname']);
        $new_username = trim($_POST['username']);
        $email = trim($_POST['email']);
        // Giới hạn độ dài username tối đa 20 ký tự
        if (strlen($new_username) > 20 || strlen($new_username) < 5) {
            echo json_encode(array('status' => 'error', 'message' => 'Tên người dùng có độ dài không phù hợp! Vui lòng nhập lại.'));
            exit();
        } else if (strlen($fullname) > 36 || strlen($fullname) < 5) {
            echo json_encode(array('status' => 'error', 'message' => 'Họ và tên có độ dài không phù hợp! Vui lòng nhập lại.'));
            exit();
        }
        else {
            // Kiểm tra dữ liệu hợp lệ và xử lý cập nhật
            if (!empty($fullname) && !empty($new_username) && !empty($email)) {
                // Kiểm tra username và email đã tồn tại chưa
                $check_query = "SELECT * FROM users WHERE (username = ? OR email = ?) AND username != ?";
                $check_stmt = $conn->prepare($check_query);
                $check_stmt->bind_param("sss", $new_username, $email, $username);
                $check_stmt->execute();
                $check_result = $check_stmt->get_result();

                if ($check_result->num_rows > 0) {
                    echo json_encode(array('status' => 'error', 'message' => 'Tên người dùng hoặc email đã được sử dụng. Vui lòng chọn tên người dùng khác hoặc email khác.'));
                    exit();
                } else {
                    // Cập nhật thông tin người dùng
                    $update_query = "UPDATE users SET fullname = ?, username = ?, email = ? WHERE username = ?";
                    $update_stmt = $conn->prepare($update_query);
                    $update_stmt->bind_param("ssss", $fullname, $new_username, $email, $username);

                    if ($update_stmt->execute()) {                       
                        // Cập nhật thông tin người dùng trong $user để hiển thị lại
                        $user['fullname'] = $fullname;
                        $user['username'] = $new_username;
                        $user['email'] = $email;

                        // Cập nhật session với username mới
                        session_start();
                        $_SESSION['username'] = $new_username;
                        echo json_encode(array('status' => 'success', 'message' => 'Cập nhật hồ sơ thành công.')); 
                        exit();
                    } else {
                        echo json_encode(array('status' => 'error', 'message' => 'Lỗi cập nhật hồ sơ, vui lòng thử lại sau.'));
                        exit();
                    }
                }
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Vui lòng điền đầy đủ thông tin!'));
                exit();
            }
        }
    }

}


// Đóng kết nối
$conn->close();
?>