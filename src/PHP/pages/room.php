<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Management</title>
    <link rel="stylesheet" href="../../assets/css/room.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../room/config.js"></script>
    <script src="../room/deviceSettings.js"></script>
    <script src="../room/Mute.js"></script>
    <script src="../room/roomManagement.js"></script>
    <script src="../room/share.js"></script>
    <script src="../room/utils.js"></script>
    <script src="../room/Video.js"></script>
    <script src="../room/videoDimensions.js"></script>
    <script src="../room/auth.js"></script>

</head>

<body>

    <div class="container">
        <div class="room-container">
            <h3><i class="fas fa-users"></i> V2meet</h3>
            <input id="roomNameInput" type="text" placeholder="Room Name">
            <input id="uniqueNameInput" type="text" placeholder="Unique Name">

            <div class="buttons">
                <button class="primary" onclick="createRoom()">
                    <i class="fas fa-plus"></i> Create Room
                </button>
                <div id="roomIdDisplay"></div>
            </div>

            <div class="buttons">
                <button onclick="listRooms()">
                    <i class="fas fa-list"></i> List Rooms
                </button>
                <input id="deleteRoomId" type="text" placeholder="Room ID to delete">
                <button onclick="deleteRoom()">
                    <i class="fas fa-trash"></i> Delete Room
                </button>
            </div>
            <div id="roomList">
                <!-- Danh sách phòng sẽ được tạo ở đây -->
            </div>
            <div class="status">
                Status: <span id="txtStatus">Not started</span>
            </div>
        </div>

        <div class="container">
            <h2><i class="fas fa-video"></i> Video Call Room</h2>
            <div class="input-group">
                <input id="userId" type="text" name="toUsername" placeholder="Your userID" value="ACBTYKKO5L">
                <button id="loginBtn" onclick="login()" disabled="">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
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
                    <i class="fas fa-check"></i> Check Device
                </button>
                <button id="joinBtn" onclick="testJoin()" disabled="">
                    <i class="fas fa-door-open"></i> Join Room
                </button>
                <button id="shareScreenBtn" onclick="testShare()" disabled="">
                    <i class="fas fa-desktop"></i> Share Screen
                </button>
                <button id="muteBtn" onclick="testMute()">
                    <i class="fas fa-microphone-slash"></i> Mute
                </button>
                <button id="disableRemoteVideosBtn" onclick="testDisableRemoteVideosBtn()" disabled="">
                    <i class="fas fa-video-slash"></i> Disable Remote Videos
                </button>
                <button id="disableRemoteAudiosBtn" onclick="testDisableRemoteAudiosBtn()" disabled="">
                    <i class="fas fa-volume-mute"></i> Disable Remote Audios
                </button>
                <button id="disableVideoBtn" onclick="testDisableVideo()">
                    <i class="fas fa-video"></i> Disable Local Video
                </button>
                <button id="switchCameraBtn" onclick="switchCamera()" disabled="">
                    <i class="fas fa-sync-alt"></i> Switch Camera
                </button>
            </div>

            <div id="videos">
                <!-- Video Elements Go Here -->
            </div>
        </div>
    </div>
    

</body>

</html>