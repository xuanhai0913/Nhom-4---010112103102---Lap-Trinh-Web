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
