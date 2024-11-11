<?php
require_once('../config/db.php');

$conn = open_dataBase();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit_save_avatar'])) {
        // Kiểm tra nếu có ảnh được tải lên
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
            // Định nghĩa thư mục lưu ảnh
            $upload_dir = '../../assets/images/avatar/upload/';
            $username = $_SESSION['username'];

            // Lấy thông tin về ảnh
            $file_name = $_FILES['avatar']['name'];
            $file_tmp = $_FILES['avatar']['tmp_name'];
            $file_size = $_FILES['avatar']['size'];
            $file_type = $_FILES['avatar']['type'];

            // Kiểm tra nếu ảnh hợp lệ (JPG, PNG, GIF)
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($file_type, $allowed_types)) {
                // Kiểm tra kích thước ảnh (tối đa 5MB)
                if ($file_size <= 5 * 1024 * 1024) {
                    // Tạo tên file theo tên người dùng
                    $new_file_name = $username . '.jpg';
                    $existing_file_path = $upload_dir . $new_file_name;

                    // Xóa ảnh cũ nếu tồn tại
                    if (file_exists($existing_file_path) && !unlink($existing_file_path)) {
                        echo "Lỗi khi xóa ảnh cũ.";
                        exit;
                    }

                    // Di chuyển ảnh vào thư mục upload
                    if (move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
                        // Cập nhật avatar vào bảng 'users'
                        $avatar_path = 'upload/' . $new_file_name;
                        $sql = "UPDATE users SET avatar = ? WHERE username = ?";

                        if ($stmt = $conn->prepare($sql)) {
                            $stmt->bind_param('ss', $avatar_path, $username);

                            if ($stmt->execute()) {
                                echo "Thay đổi ảnh hồ sơ thành công.";
                            } else {
                                echo "Lỗi khi lưu tên ảnh vào cơ sở dữ liệu: " . $stmt->error;
                            }

                            $stmt->close();
                        } else {
                            echo "Lỗi khi chuẩn bị câu lệnh SQL: " . $conn->error;
                        }
                    } else {
                        echo "Không thể tải ảnh lên.";
                    }
                } else {
                    echo "Ảnh quá lớn. Vui lòng chọn ảnh có kích thước nhỏ hơn 5MB.";
                }
            } else {
                echo "Loại file không hợp lệ. Vui lòng chọn ảnh JPG, PNG hoặc GIF.";
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Vui lòng chọn ảnh!'));
        }
    }
}

$conn->close();
?>