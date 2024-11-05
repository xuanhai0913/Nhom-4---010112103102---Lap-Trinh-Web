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
        $avatar = $user['avatar'] ?: 'default-avatar.png'; // Gán giá trị mặc định nếu không có avatar
        $email = $user['email'];
        $domain = substr($email, strrpos($email, '@') + 1);
    } else {
        $avatar = 'default-avatar.png'; // Gán giá trị mặc định nếu không tìm thấy người dùng
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-DyZ88mC6Up2uqSIL6qz6aSB1n0bR1o5B1Y5X44BZ9N8bL5lH5yT/M6lb1mjL8MQH" crossorigin="anonymous">
    <script src="../../assets/js/header.js"></script>
</head>

<body>
    <div class="header">
        <div class="header__left">
            <a href="home.php">
                <img alt="Logo" height="50" src="../../assets/images/logo.png" />
            </a>
        </div>
        <div class="header__right">
            <p id="datetime"></p>
            <i class="fas fa-question-circle"></i>
            <i class="fas fa-cog"></i>
            <i class="fas fa-th"></i>
            <div id="btn-avatar" class="btn-avatar">
                <img alt="User Avatar" height="40" src="../../assets/upload/avatar/<?php echo htmlspecialchars($avatar); ?>" />
            </div>
        </div>

        <!-- profile -->
        <section class="profilePopup">
            <span class="profilePopup__closeIcon">
                <i class="fas fa-times"></i>
            </span>
            <div class="profilePopup__email">
                <h3><?php echo htmlspecialchars($user['email']); ?></h3>
                <span>Do <?php echo $domain; ?> quản lí</span>
            </div>

            <div class="profilePopup__avatar">
                <img class="avatar__image" alt="User Avatar" height="40" src="../../assets/upload/avatar/<?php echo htmlspecialchars($avatar); ?>" />
                <span class="avatar__edit">
                    <i class="fas fa-pencil-alt"></i>
                </span>
            </div>

            <h2 class="profilePopup__fullname">Chào <?php echo htmlspecialchars($user['fullname']); ?>,</h2>

            <span class="profilePopup__username"><?php echo htmlspecialchars($user['username']); ?></span>

            <div class="profilePopup__actions">
                <button class="action action__edit">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Chỉnh sửa
                </button>
                <button class="action action__logout">
                    <i class="fas fa-sign-out-alt"></i>
                    Đăng xuất
                </button>
            </div>
        </section>
    </div>
</body>