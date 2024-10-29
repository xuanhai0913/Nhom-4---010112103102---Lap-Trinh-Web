<?php
require_once('../config/db.php');

$conn = open_dataBase();

session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Sử dụng truy vấn chuẩn bị để bảo vệ chống lại SQL Injection
    // $stmt = $conn->prepare("SELECT avatar FROM users WHERE username = ?");
    // $stmt->bind_param("s", $username);
    // $stmt->execute();
    // $result = $stmt->get_result();
    $result = getDataByKey('username',$username,'avatar');

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $avatar = $user['avatar'] ?: 'default-avatar.png'; // Gán giá trị mặc định nếu không có avatar
    } else {
        $avatar = 'default-avatar.png'; // Gán giá trị mặc định nếu không tìm thấy người dùng
    }
} else {
    header("Location: ../../../pages/index.php");
    exit();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-DyZ88mC6Up2uqSIL6qz6aSB1n0bR1o5B1Y5X44BZ9N8bL5lH5yT/M6lb1mjL8MQH" crossorigin="anonymous">
    <title>Header</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="header__left">
                <img alt="Logo" height="40" src="https://storage.googleapis.com/a1aa/image/OuLMTCiw5vahCxbcAG1ZnlDFs54irzaCvxHmpBL6r5ec2W1JA.jpg" width="40" />
                <span>V2Meet</span>
            </div>
            <div class="header__right">
                <i class="fas fa-question-circle"></i>
                <i class="fas fa-cog"></i>
                <i class="fas fa-th"></i>
                <a href="profile.php"> <!-- Thêm thẻ <a> để liên kết tới profile.php -->
                    <img alt="User Avatar" height="40" src="../assets/upload/avatar/<?php echo htmlspecialchars($avatar); ?>" />
                </a>
            </div>
        </div>
    </div>
</body>
</html>