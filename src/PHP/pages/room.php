<?php
session_start();
$roomId = isset($_SESSION['roomId']) ? $_SESSION['roomId'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Management</title>
    <link rel="stylesheet" href="../../assets/css/room.css">
    <link href="../../assets/css/base.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@0.20.0/dist/axios.min.js"></script>
    <script src="https://cdn.stringee.com/sdk/web/2.2.1/stringee-web-sdk.min.js"></script>
    <script src="../../assets/js/room/config.js"></script>
    <script src="../../assets/js/room/deviceSettings.js"></script>
    <script src="../../assets/js/room/Mute.js"></script>
    <script src="../../assets/js/room/roomManagement.js"></script>
    <script src="../../assets/js/room/share.js"></script>
    <script src="../../assets/js/room/utils.js"></script>
    <script src="../../assets/js/room/Video.js"></script>
    <script src="../../assets/js/room/videoDimensions.js"></script>
    <script src="../../assets/js/room/auth.js"></script>
    <script src="../../assets/js/room/api.js"></script>
    <script src="../../assets/js/room/script.js"></script>
</head>

<body>
    <?php include '../templates/header.php'; ?>

    <?php if ($roomId): ?>
        <div class="info">
            <p>Bạn đang ở trong phòng <strong><?php echo htmlspecialchars($roomId); ?></strong>.</p>
            <p>
                Gửi link này cho bạn bè cùng tham gia phòng:
                <a href="Room.php?roomId=<?php echo urlencode($roomId); ?>" target="_blank">
                    Room.php?roomId=<?php echo htmlspecialchars($roomId); ?>
                </a>.
            </p>
            <p>Hoặc bạn cũng có thể copy <code><?php echo htmlspecialchars($roomId); ?></code> để share.</p>
        </div>
    <?php else: ?>
        <p>Bạn chưa tham gia phòng nào. Vui lòng quay lại trang <a href="home.php">Home</a> để tạo hoặc tham gia phòng.</p>
    <?php endif; ?>

    <div class="container1">
        <h2><i class="fas fa-video"></i> Video Call Room</h2>
        <div class="video-container">
            <video id="localVideo" autoplay muted></video>
        </div>
        
        <div class="input-group">
            <select id="listCameras">
                <option value="">Choose camera</option>
            </select>
            <select id="videoDimensions">
                <option value="max">Max resolution</option>
                <option value="720p">720p (1280x720)</option>
                <option value="480p">480p (854x480)</option>
                <option value="360p">360p (640x360)</option>
                <option value="240p">240p (426x240)</option>
                <option value="default">default</option>
            </select>
            <select id="listMicrophones">
                <option value="">Choose Microphone</option>
            </select>
            <select id="listSpeakers">
                <option value="">Choose Speaker</option>
            </select>
        </div>

        <div class="video-controls">
            <button id="checkDeviceBtn" onclick="checkDevice()" disabled="">
                <i class="fas fa-check"></i> Check Device
            </button>
            <button id="shareScreenBtn" onclick="testShare()" disabled="">
                <i class="fas fa-desktop"></i> Share Screen
            </button>
            <button id="muteBtn" onclick="testMute()">
                <i class="fas fa-microphone-slash"></i> Mute
            </button>
        </div>
    </div>

    <script>
        // Tự động hiển thị camera khi vào trang
        function startCamera() {
            navigator.mediaDevices.getUserMedia({ video: true, audio: true })
                .then(stream => {
                    const videoElement = document.getElementById('localVideo');
                    videoElement.srcObject = stream;
                })
                .catch(error => {
                    console.error('Lỗi khi truy cập camera:', error);
                });
        }

        document.addEventListener('DOMContentLoaded', function () {
            startCamera();
        });
    </script>
</body>

</html>
