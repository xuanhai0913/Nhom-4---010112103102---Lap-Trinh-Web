<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room</title>
    <link rel="stylesheet" href="../assets/css/room.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>

<body>

    <div class="container">
        <h2>Video Call Room</h2>
        <div class="input-group">
            <input id="userId" type="text" name="toUsername" placeholder="Your userID" value="ACBTYKKO5L">
            <button id="loginBtn" onclick="login()" disabled="">Login</button>
        </div>
        Logged in: <span id="loggedUserId" style="color: red">Not logged</span> |
        SdkVersion: <span id="sdkVersion" style="color: blue"></span>

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
                <i class="fas fa-check"></i> Check device
                <button id="joinBtn" onclick="testJoin()" disabled="">
                    <i class="fas fa-door-open"></i> Join room
                </button>
                <button id="shareScreenBtn" onclick="testShare()" disabled="">
                    <i class="fas fa-desktop"></i> Share Screen
                </button>
                <button id="muteBtn" onclick="testMute()">
                    <i class="fas fa-microphone-slash"></i> Mute
                </button>
                <button id="disableRemoteVideosBtn" onclick="testDisableRemoteVideosBtn()" disabled="">
                    <i class="fas fa-video-slash"></i> Disable all remote videos
                </button>
                <button id="disableRemoteAudiosBtn" onclick="testDisableRemoteAudiosBtn()" disabled="">
                    <i class="fas fa-volume-mute"></i> Disable all remote audios
                </button>
                <button id="disableVideoBtn" onclick="testDisableVideo()">
                    <i class="fas fa-video"></i> Disable local video
                </button>
                <button id="switchCameraBtn" onclick="switchCamera()" disabled="">
                    <i class="fas fa-sync-alt"></i> Switch Camera
                </button>
                <button class="pushable">
  <span class="shadow"></span>
  <span class="edge"></span>
  <span class="front">                    <i class="fas fa-sign-out-alt"></i> Leave room</span>
                </button>
        </div>

        <div class="status">
            Status: <span id="txtStatus" style="color: red">Not started</span>
        </div>

        <div id="videos"></div>
    </div>

</body>

</html>