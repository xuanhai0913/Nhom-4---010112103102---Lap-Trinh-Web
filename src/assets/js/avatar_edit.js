// Hàm hiển thị tab
function showTab(tab) {
    document.getElementById('default-avatar').style.display = tab === 'default' ? 'block' : 'none';
    document.getElementById('upload-avatar').style.display = tab === 'upload' ? 'block' : 'none';
    document.querySelectorAll('.tab').forEach(function(el) {
        el.classList.remove('active');
    });
    document.querySelector('.tab[onclick="showTab(\'' + tab + '\')"]').classList.add('active');
}

function closePreview() {
    document.getElementById('preview').style.bottom = '-100%';
}

// Tải file
function loadFile(event) {
    const previewImage = document.getElementById('previewImage');
    previewImage.src = URL.createObjectURL(event.target.files[0]);
    document.getElementById('preview').style.bottom = '0';
}

// Kéo và thả
document.addEventListener('dragover', function(event) {
    var uploadArea = document.getElementById('dragAndDrop');
    if (uploadArea.contains(event.target)) {
        event.preventDefault();
        document.getElementById('dragAndDrop').style.border = '2px dashed #1a73e8';
    } else document.getElementById('dragAndDrop').style.border = 'none';
});

document.addEventListener('drop', function(event) {
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