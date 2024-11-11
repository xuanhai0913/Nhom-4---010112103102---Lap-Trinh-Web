<?php
require_once('../config/db.php');

$conn = open_dataBase();

// Giả sử bạn lấy username từ session hoặc từ cơ sở dữ liệu
session_start();
$username = $_SESSION['username'] ?? ''; // Lấy username từ session (hoặc thay thế bằng cách khác nếu cần)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra nếu file được gửi và không có lỗi
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../assets/images/avatar/upload/';
        // Lấy tên file và thay đổi tên file thành tên người dùng (username)
        $fileName = basename($_FILES['avatar']['name']);
        $newFileName = $username . '.jpg';
        $uploadFilePath = $uploadDir . $newFileName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Kiểm tra loại file (chỉ cho phép hình ảnh)
        $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $validExtensions = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $validExtensions)) {
            echo json_encode(array('status' => 'error', 'message' => 'Vui lòng chọn file ảnh hợp lệ.'));
            exit;
        }

        // Kiểm tra nếu ảnh cũ đã tồn tại và xóa nếu có
        if (file_exists($uploadFilePath)) {
            unlink($uploadFilePath);  // Xóa ảnh cũ
        }

        // Di chuyển file đến thư mục upload
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFilePath)) {
            // Lưu URL của ảnh vào cơ sở dữ liệu
            $stmt = $conn->prepare("UPDATE users SET avatar = ? WHERE username = ?");
            $avatarUrl = 'upload/' . $newFileName;
            $stmt->bind_param("ss", $avatarUrl, $username);

            if ($stmt->execute()) {
                echo json_encode(array('status' => 'success', 'message' => 'Thay đổi ảnh hồ sơ thành công.'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Lỗi không upload được ảnh. Vui lòng thử lại sau.'));
            }

            $stmt->close();
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Lỗi không upload được ảnh. Vui lòng thử lại sau.'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Vui lòng chọn ảnh.'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Yêu cầu không hợp lệ.'));
}

$conn->close();
?>
