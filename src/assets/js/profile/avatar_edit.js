// Hàm hiển thị tab
function showTab(tab) {
    document.getElementById('default-avatar').style.display = tab === 'default' ? 'block' : 'none';
    document.getElementById('upload-avatar').style.display = tab === 'upload' ? 'block' : 'none';
    document.querySelectorAll('.tab').forEach(function (el) {
        el.classList.remove('active');
    });
    document.querySelector('.tab[onclick="showTab(\'' + tab + '\')"]').classList.add('active');
}

function closePreview() {
    document.getElementById('preview').style.bottom = '-100%';
}

// Tải file
function loadFile(event) {
    const file = event.target.files[0];
    const previewImage = document.getElementById('previewImage');
    const previewContainer = document.getElementById('preview');

    // Kiểm tra nếu file tồn tại và là file ảnh
    if (file && file.type.startsWith('image/')) {
        previewImage.src = URL.createObjectURL(file);
        previewContainer.style.bottom = '0';
    } else {
        // Cảnh báo nếu không phải file ảnh
        alert('Tệp không hợp lệ! Vui lòng chọn một tệp ảnh.');
    }
}


// Kéo và thả
document.addEventListener('dragover', function (event) {
    var uploadArea = document.getElementById('dragAndDrop');
    if (uploadArea.contains(event.target)) {
        event.preventDefault();
        document.getElementById('dragAndDrop').style.border = '2px dashed #1a73e8';
    } else document.getElementById('dragAndDrop').style.border = 'none';
});

document.addEventListener('drop', function (event) {
    document.getElementById('dragAndDrop').style.border = 'none';
    event.preventDefault();
    const files = event.dataTransfer.files;
    if (files.length > 0) {
        document.getElementById('fileInput').files = files;
        loadFile({ target: { files } });
    }
});


// Chụp ảnh
function openCameraModal() {
    const modal = document.getElementById('cameraModal');
    modal.style.display = 'block';

    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            const video = document.getElementById('video');
            video.srcObject = stream;

            document.getElementById('captureButton').onclick = () => {
                const canvas = document.createElement('canvas');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0);

                const dataUrl = canvas.toDataURL();

                // Chuyển đổi dataURL thành file
                const arr = dataUrl.split(',');
                const mime = arr[0].match(/:(.*?);/)[1];
                const bstr = atob(arr[1]);
                let n = bstr.length;
                const u8arr = new Uint8Array(n);
                while (n--) {
                    u8arr[n] = bstr.charCodeAt(n);
                }
                const file = new File([u8arr], 'captured.png', { type: mime });

                // Ghi file vào input
                const fileInput = document.getElementById('fileInput');
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;

                loadFile({ target: { files: [file] } });

                // Dừng camera và đóng modal
                stream.getTracks().forEach(track => track.stop());
                modal.style.display = 'none';
            };
        })
        .catch(error => console.error('Lỗi khi truy cập camera: ', error));
}

// Hàm xử lý nhấn đúp vào ảnh để cập nhật vào input
function changeAvatarDefault(event) {
    const fileInput = document.getElementById('fileInput');
    const dataTransfer = new DataTransfer();

    // Lấy ảnh từ element hiện tại (chắc chắn phải có ảnh được hiển thị trước đó)
    const newImageFile = event.target.src;
    fetch(newImageFile)
        .then(res => res.blob())
        .then(blob => {
            const file = new File([blob], 'image.png', { type: blob.type });
            dataTransfer.items.add(file);
            fileInput.files = dataTransfer.files;
            loadFile({ target: { files: [file] } });
        })
        .catch(error => console.error('Lỗi khi tải ảnh từ src: ', error));
}


$(document).ready(function() {
    $("#btn-save-avatar").click(function(e) {
        e.preventDefault(); // Ngừng sự kiện mặc định

        var formData = new FormData($('#form-edit-avatar')[0]); // Lấy dữ liệu form, bao gồm ảnh

        $.ajax({
            url: '../../PHP/profile/avatar_edit.php', // Địa chỉ file PHP xử lý tải ảnh
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false, // Không cần thiết lập contentType
            processData: false, // Không xử lý dữ liệu trước khi gửi
            success: function(response) {
                console.log(response);  // Kiểm tra dữ liệu trả về từ server
                if (response.status === 'success') {
                    alert(response.message); // Hiển thị thông báo thành công
                    location.reload();
                } else {
                    alert(response.message); // Hiển thị thông báo lỗi
                }
            },            
            error: function() {
                $("#message").html("Có lỗi xảy ra khi tải ảnh lên.");
            }
        });
    });
});