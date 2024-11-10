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
        echo json_encode(array('fullname' => $fullname, 'username' => $new_username, 'email' => $email));
        // Giới hạn độ dài username tối đa 20 ký tự
        if (strlen($new_username) > 20) {
            echo json_encode(array('status' => 'error', 'message' => 'Tên người dùng quá dài! Vui lòng nhập tối đa 20 ký tự.'));
            exit();
        } else if (strlen($fullname) > 50) {
            echo json_encode(array('status' => 'error', 'message' => 'Họ và tên quá dài! Vui lòng nhập tối đa 50 ký tự.'));
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
// echo json_encode(array('status' => 'error','fullname' => $user['fullname'], 'username' => $user['username'], 'email' => $user['email']));

// Đóng kết nối
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
    <form id="form-edit-profile" class="profile-edit" method="POST" action="">
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
            <button type="submit" name="submit_save_profile" class="btn-save-profile">
                <i class="icon fa fa-cloud"></i> Save
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
