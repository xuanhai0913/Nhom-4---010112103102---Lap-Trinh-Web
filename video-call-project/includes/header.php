<?php
require_once('connection.php');

$conn = open_dataBase();
function getUserAvatar($user_id) {

    $sql = "SELECT avatar_url FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $avatar_url = "";
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $avatar_url = $row['avatar_url'];
    } else {
        $avatar_url = "https://example.com/default-avatar.jpg";
    }

    $stmt->close();
    $conn->close();

    return $avatar_url;
}

// Lấy avatar cho người dùng (thay đổi 1 bằng id người dùng thực tế)
$user_id = 1;
$avatar_url = getUserAvatar($user_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header.css">
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
                <img alt="User Avatar" height="40" src="<?php echo htmlspecialchars($avatar_url); ?>" />
            </div>
        </div>
    </div>
</body>

</html>
