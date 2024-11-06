<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay đổi ảnh hồ sơ</title>
    <link rel="stylesheet" href="../../assets/css/profile_edit.css">
    <link rel="stylesheet" href="../../assets/css/base.css">
    <script src="../../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../../assets/js/profile_edit.js"></script>
</head>
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
        </div>
        <form id="uploadForm" action="" method="POST" enctype="multipart/form-data">
            <input type="file" id="fileInput" name="file" accept="image/*" onchange="loadFile(event)" style="display: none;">
            <div class="preview__content">
                <img class="preview__content-image" id="previewImage" alt="Preview image" src="../../assets/images/avatar/default/default-avatar.png" />
                <div class="preview__content-btn">
                    <button type="button" class="btn-cancel" onclick="closePreview();">Huỷ</button>
                    <button type="submit" name="submit" class="btn-save" id="btn-save">Lưu làm ảnh hồ sơ</button>
                </div>
            </div>
        </form>
    </div>
</div>