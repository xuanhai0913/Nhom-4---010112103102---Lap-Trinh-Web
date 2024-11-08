<?php
require_once('../config/db.php');

$conn = open_dataBase();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit_save_avatar'])) {
        // Kiểm tra nếu có ảnh được tải lên
        if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
            // Định nghĩa thư mục lưu ảnh
            $upload_dir = '../../assets/images/avatar/upload/';
            $username = $_SESSION['username'];

            // Lấy thông tin về ảnh
            $file_name = $_FILES['file']['name'];
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_size = $_FILES['file']['size'];
            $file_type = $_FILES['file']['type'];

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
            echo "Vui lòng chọn một ảnh để tải lên.";
        }
    }
}

$conn->close();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay đổi ảnh hồ sơ</title>
    <link rel="stylesheet" href="../../assets/css/avatar_edit.css">
    <link rel="stylesheet" href="../../assets/css/base.css">
    <script src="../../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../../assets/js/avatar_edit.js"></script>
</head>
<div class="container-avatar-edit">
    <div class="avatar-edit__change avatar-edit__change--choose">
        <div class="choose__header">
            <span class="close-avatar-edit"><i class="fas fa-times"></i></span>
            <h1>Thay đổi ảnh hồ sơ</h1>
        </div>
        <div class="choose__tabs">
            <div class="btn-tab" onclick="showTab('default')">Hình mặc định</div>
            <div class="btn-tab btn-tab--active" onclick="showTab('upload')">Từ máy tính</div>
        </div>
        <div class="choose__avatar-default" id="default-avatar">
            <div class="section-title">Avatar mặc định</div>
            <div class="section-images">
                <?php
                $directory = '../../assets/images/avatar/default'; // Thư mục chứa ảnh
                $images = scandir($directory); // Lấy danh sách các tệp trong thư mục

                // Duyệt qua các tệp trong thư mục
                foreach ($images as $image) {
                    if (in_array(pathinfo($image, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
                        echo "<img src='$directory/$image' alt='$image' class='image-item' ondblclick='changeAvatarDefault(event)'>";
                    }
                }
                ?>
            </div>
        </div>
        <div class="choose__avatar-upload" id="upload-avatar" style="display: none;">
            <div class="section-upload">
                <div class="upload__dragAndDrop" id="dragAndDrop">
                    <img id="profileImage" class="upload__image" alt="Placeholder profile image" src="../../assets/images/avatar/default/default-avatar.png" />
                    <p>Kéo ảnh đến màn hình này</p>
                    <p>— hoặc —</p>
                </div>
                <div class="upload__buttons">
                    <button onclick="document.getElementById('fileInput').click();">
                        <i class="fas fa-upload"></i>
                        Tải lên từ máy tính
                    </button>
                    <button onclick="openCameraModal();">
                        <i class="fas fa-camera"></i>
                        Chụp ảnh
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="avatar-edit__change avatar-edit__change--preview" id="preview">
        <div class="preview__header">
            <h1>Ảnh hồ sơ mới của bạn</h1>
        </div>
        <form id="uploadForm" action="" method="POST" enctype="multipart/form-data">
            <input type="file" id="fileInput" name="file" accept="image/*" onchange="loadFile(event)" style="display: none;">
            <div class="preview__content">
                <img class="preview__content-image" id="previewImage" alt="Preview image" src="../../assets/images/avatar/default/default-avatar.png" />
                <div class="preview__content-btn">
                    <button type="button" class="btn-cancel" onclick="closePreview();">Huỷ</button>
                    <button type="submit" name="submit_save_avatar" class="btn-save" id="btn-save">Lưu làm ảnh hồ sơ</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Camera Modal -->
<div class="modal-content" id="cameraModal" style="display: none;">
    <video id="video" autoplay></video>
    <button id="captureButton"></button>
</div>