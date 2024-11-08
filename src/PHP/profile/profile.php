<head>
    <link rel="stylesheet" href="../../assets/css/base.css">
    <link rel="stylesheet" href="../../assets/css/profile.css">
    <script src="../../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../../assets/js/profile.js"></script>
</head>
<section class="profilePopup">
    <span class="profilePopup__closeIcon">
        <i class="fas fa-times"></i>
    </span>
    <div class="profilePopup__email">
        <h3><?php echo htmlspecialchars($user['email']); ?></h3>
        <span>Do <?php echo $domain; ?> quản lí</span>
    </div>

    <div class="profilePopup__avatar">
        <img class="avatar-edit" alt="User Avatar" height="40" src="../../assets/images/avatar/<?php echo htmlspecialchars($avatar); ?>" />
        <span class="avatar-edit">
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
<?php include 'avatar_edit.php'; ?>
<?php include 'profile_edit.php'; ?>