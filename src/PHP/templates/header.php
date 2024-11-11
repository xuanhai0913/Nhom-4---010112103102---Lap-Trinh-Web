<?php
require_once('../config/db.php');

$conn = open_dataBase();

// Kiểm tra xem người dùng đã đăng nhập chưa
session_start();
// Kiểm tra nếu chưa đăng nhập chưa
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $result = getDataByKey('username', $username, '*');

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $avatar = $user['avatar'] ?: 'default/default-avatar.png'; // Gán giá trị mặc định nếu không có avatar
        $email = $user['email'];
        $domain = substr($email, strrpos($email, '@') + 1);
    } else {
        $avatar = 'default/default-avatar.png'; // Gán giá trị mặc định nếu không tìm thấy người dùng
    }
} else {
    header("Location: ../pages/index.php");
    exit();
}

$conn->close();
?>

<head>
    <link rel="stylesheet" href="../../assets/css/base.css">
    <link rel="stylesheet" href="../../assets/css/header.css">
    <script src="../../assets/js/includes/jquery-3.7.1.min.js"></script>
    <script src="../../assets/js/templates/header.js"></script>
</head>
<div class="header">
    <div class="header__left">
        <a href="home.php">
            <img alt="Logo" height="50" src="../../assets/images/static/logo.png" />
        </a>
    </div>
    <div class="header__right">
        <p id="datetime"></p>
        <i class="fas fa-question-circle"></i>
        <i class="fas fa-cog"></i>
        <i class="fas fa-th"></i>
        <div id="btn-avatar" class="btn-avatar">
            <img alt="User Avatar" height="40" src="../../assets/images/avatar/<?php echo htmlspecialchars($avatar); ?>" onerror="this.onerror=null; this.src='../../assets/images/avatar/default/default-avatar.png';"/>
        </div>
    </div>
</div>
<?php include '../profile/profile.php'; ?>