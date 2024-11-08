<?php
require_once('../config/db.php');

$conn = open_dataBase();

$username = $_SESSION['username']; // Lấy username từ session sau khi đăng nhập

// Lấy thông tin người dùng hiện tại
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nhận dữ liệu từ form
    $fullname = $_POST['fullname'];
    $new_username = $_POST['username'];
    $email = $_POST['email'];

    // Kiểm tra dữ liệu hợp lệ và xử lý cập nhật
    if (!empty($fullname) && !empty($new_username) && !empty($email)) {
        // Kiểm tra username và email đã tồn tại chưa
        $check_query = "SELECT * FROM users WHERE (username = ? OR email = ?) AND username != ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("sss", $new_username, $email, $username);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            echo "Username hoặc email đã được sử dụng!";
        } else {
            // Cập nhật thông tin người dùng
            $update_query = "UPDATE users SET fullname = ?, username = ?, email = ? WHERE username = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("ssss", $fullname, $new_username, $email, $username);

            if ($update_stmt->execute()) {
                echo "Cập nhật hồ sơ thành công!";
                // Cập nhật thông tin người dùng trong $user để hiển thị lại
                $user['fullname'] = $fullname;
                $user['username'] = $new_username;
                $user['email'] = $email;
                $_SESSION['username'] = $new_username; // Cập nhật session với username mới
            } else {
                echo "Lỗi cập nhật hồ sơ: " . $conn->error;
            }
        }
    } else {
        echo "Vui lòng điền đầy đủ thông tin!";
    }
}

$conn->close();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay đổi ảnh hồ sơ</title>
    <link rel="stylesheet" href="../../assets/css/profile_edit.css">
    <link rel="stylesheet" href="../../assets/css/base.css">
    <script src="../../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../../assets/js/profile_edit.js"></script>
</head>
<div class="container-profile-edit">
    <form class="profile-edit" method="POST" action="">
        <div class="profile-edit__header">
            <span class="close-profile-edit"><i class="fas fa-times"></i></span>
            <h1>Thay đổi hồ sơ của bạn</h1>
        </div>
        <div class="profile-edit__info">
            <img src="../../assets/images/avatar/default/default-avatar.png" alt="avatar">
            <section class="info-name">
                <h4><?php echo htmlspecialchars($user['fullname']); ?></h4>
                <span><?php echo htmlspecialchars($user['username']); ?></span>
            </section>
            <button type="submit" class="btn-save-profile">
                <div class="btn-wrapper">
                    <div class="btn-wrapper-icon">
                        <i class="icon fa fa-cloud"></i>
                    </div>
                </div>
                <span>Lưu</span>
            </button>
        </div>
        <div class="profile-edit__form">
            <div class="form-item">
                <label for="fullname">Họ và tên</label>
                <input type="text" name="fullname" id="fullname" placeholder="Họ và tên" value="<?php echo htmlspecialchars($user['fullname']); ?>">
            </div>
            <div class="form-item">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username" value="<?php echo htmlspecialchars($user['username']); ?>">
            </div>
            <div class="form-item">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" value="<?php echo htmlspecialchars($user['email']); ?>">
            </div>
        </div>
    </form>
</div>
