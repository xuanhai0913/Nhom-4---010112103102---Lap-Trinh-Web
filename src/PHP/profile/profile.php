<head>
    <link rel="stylesheet" href="../../assets/css/base.css">
    <link rel="stylesheet" href="../../assets/css/profile.css">
    <link rel="stylesheet" href="../../assets/css/avatar_edit.css">
    <link rel="stylesheet" href="../../assets/css/profile_edit.css">
    <script src="../../assets/js/includes/jquery-3.7.1.min.js"></script>
</head>

<section class="profilePopup">
    <div id="response_message"></div>
    <span class="profilePopup__closeIcon">
        <i class="fas fa-times"></i>
    </span>
    <div class="profilePopup__email">
        <h3><?php echo htmlspecialchars($user['email']); ?></h3>
        <span>Do <?php echo $domain; ?> quản lí</span>
    </div>

    <div class="profilePopup__avatar">
        <img class="avatar-edit" alt="User Avatar" height="40" src="../../assets/images/avatar/<?php echo htmlspecialchars($avatar); ?> " onerror="this.onerror=null; this.src='../../assets/images/avatar/default/default-avatar.png';"/>
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


<!-- Phần hiển thị edit Avatar -->
<div class="container-avatar-edit">
    <div class="avatar-edit__change avatar-edit__change--choose">
        <div class="choose__header">
            <span class="close-avatar-edit"><i class="fas fa-times"></i></span>
            <h1>Thay đổi ảnh hồ sơ</h1>
        </div>
        <div class="choose__tabs">
            <div class="btn-tab" onclick="showTab('default')">Hình mặc định</div>
            <div class="btn-tab btn-tab--active" onclick="showTab('upload')">Từ máy tính</div>
        </div>
        <div class="choose__avatar-default" id="default-avatar">
            <div class="section-title">Avatar mặc định</div>
            <div class="section-images">
                <?php
                $directory = '../../assets/images/avatar/default'; // Thư mục chứa ảnh
                $images = scandir($directory); // Lấy danh sách các tệp trong thư mục

                // Duyệt qua các tệp trong thư mục
                foreach ($images as $image) {
                    if (in_array(pathinfo($image, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
                        echo "<img src='$directory/$image' alt='$image' class='image-item' ondblclick='changeAvatarDefault(event)'>";
                    }
                }
                ?>
            </div>
        </div>
        <div class="choose__avatar-upload" id="upload-avatar" style="display: none;">
            <div class="section-upload">
                <div class="upload__dragAndDrop" id="dragAndDrop">
                    <img id="profileImage" class="upload__image" alt="Placeholder profile image" src="../../assets/images/avatar/default/default-avatar.png" />
                    <p>Kéo ảnh đến màn hình này</p>
                    <p>— hoặc —</p>
                </div>
                <div class="upload__buttons">
                    <button onclick="document.getElementById('fileInput').click();">
                        <i class="fas fa-upload"></i>
                        Tải lên từ máy tính
                    </button>
                    <button onclick="openCameraModal();">
                        <i class="fas fa-camera"></i>
                        Chụp ảnh
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="avatar-edit__change avatar-edit__change--preview" id="preview">
        <div class="preview__header">
            <h1>Ảnh hồ sơ mới của bạn</h1>
            <div id="message"></div>
        </div>
        <form id="form-edit-avatar" action="" method="POST" enctype="multipart/form-data">
            <input type="file" id="fileInput" name="avatar" accept="image/*" onchange="loadFile(event)" style="display: none;">
            <div class="preview__content">
                <img class="preview__content-image" id="previewImage" alt="Preview image" src="../../assets/images/avatar/default/default-avatar.png" />
                <div class="preview__content-btn">
                    <button type="button" class="btn-cancel" onclick="closePreview();">Huỷ</button>
                    <button type="submit" name="submit_save_avatar" class="btn-save_avatar" id="btn-save-avatar">Lưu làm ảnh hồ sơ</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Camera Modal -->
<div class="modal-content" id="cameraModal" style="display: none;">
    <video id="video" autoplay></video>
    <button id="captureButton"></button>
</div>


<!-- Phần hiển thị edit Profile -->
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
<script src="../../assets/js/profile/profile.js"></script>
<script src="../../assets/js/profile/avatar_edit.js"></script>
<script src="../../assets/js/profile/profile_edit.js"></script>