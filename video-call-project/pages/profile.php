<?php
require_once('../FormLogin/connection.php');

$conn = open_dataBase();

session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    header("Location: ../FormLogin/login.php");
    exit();
}

$username = $_SESSION['username'];

// Sử dụng truy vấn chuẩn bị để bảo vệ chống lại SQL Injection
$stmt = $conn->prepare("SELECT avatar, fullname, email FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $avatar = $user['avatar'] ?: 'default-avatar.png'; // Gán giá trị mặc định nếu không có avatar
    $fullname = htmlspecialchars($user['fullname']);
    $email = htmlspecialchars($user['email']);
} else {
    // Nếu không tìm thấy thông tin người dùng
    $avatar = 'default-avatar.png';
    $fullname = 'N/A';
    $email = 'N/A';
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-DyZ88mC6Up2uqSIL6qz6aSB1n0bR1o5B1Y5X44BZ9N8bL5lH5yT/M6lb1mjL8MQH" crossorigin="anonymous">
    <title>Profile</title>
</head>

<body>
    <div class="container">
        <div class="profile">
            <div class="profile__header">
                <img src="assets/upload/avatar/<?php echo htmlspecialchars($avatar); ?>" alt="User Avatar" class="profile__avatar">
                <h2><?php echo $fullname; ?></h2>
                <p><?php echo $email; ?></p>
            </div>
            <div class="profile__body">
                <h3>Thông tin cá nhân</h3>
                <form action="update_profile.php" method="post">
                    <div class="form-group">
                        <label for="fullname">Họ và tên:</label>
                        <input type="text" id="fullname" name="fullname" value="<?php echo $fullname; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="form-group">
                        <button type="submit">Cập nhật thông tin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
