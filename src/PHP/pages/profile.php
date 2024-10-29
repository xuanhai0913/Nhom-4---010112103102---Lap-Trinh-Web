<?php
require_once('../config/db.php');

$conn = open_dataBase();

session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $result = getDataByKey('username', $username, '*');
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $avatar = $user['avatar'] ?: 'default-avatar.png'; // Gán giá trị mặc định nếu không có avatar
    } else {
        $avatar = 'default-avatar.png'; // Gán giá trị mặc định nếu không tìm thấy người dùng
    }
} else {
    header("Location: ../pages/index.php");
    exit();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-DyZ88mC6Up2uqSIL6qz6aSB1n0bR1o5B1Y5X44BZ9N8bL5lH5yT/M6lb1mjL8MQH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <title>Profile</title>
</head>

<body>
    <div class="container">
        <div class="profile">
            <div class="profile__title">
                Trang cá nhân
            </div>
            <div class="profile__info">
                <img src="../assets/upload/avatar/<?php echo htmlspecialchars($avatar); ?>" alt="User Avatar" class="profile__avatar" >
                <div>
                    <div class="username">
                        <?php echo htmlspecialchars($user['username']); ?>
                    </div>
                    <div class="name">
                        <?php echo htmlspecialchars($user['fullname']); ?>
                    </div>
                </div>
                <button>
                    Đổi ảnh
                </button>
            </div>
            <div class="profile__change">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                <div class="note">
                    <p>Bạn nên sử dụng một địa chỉ email mà bạn đang sử dụng để đảm bảo rằng bạn nhận được tất cả thông tin quan trọng từ chúng tôi. Hãy chắc chắn rằng địa chỉ email mới của bạn là chính xác và có thể truy cập được!</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>