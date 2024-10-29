<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room</title>
</head>

<body>

    <div>
        <input id="userId" type="text" name="toUsername" style="width: 200px;" placeholder="Your userID"
            value="ACBTYKKO5L">
        <button id="loginBtn" onclick="login()" disabled="">Login</button>
        Logged in: <span id="loggedUserId" style="color: red">Not logged</span> |
        SdkVersion: <span id="sdkVersion" style="color: blue"></span>
    </div>
    <div>
        <br>
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


        <br><br>

        <button id="checkDeviceBtn" onclick="checkDevice()" disabled="">Check device</button>

        <button id="joinBtn" onclick="testJoin()" disabled="">Join room</button>

        <button id="shareScreenBtn" onclick="testShare()" disabled="">Share Screen</button>


        <button id="muteBtn" onclick="testMute()">Mute</button>

        <button id="disableRemoteVideosBtn" onclick="testDisableRemoteVideosBtn()" disabled="">Disable all remote
            videos</button>
        <button id="disableRemoteAudiosBtn" onclick="testDisableRemoteAudiosBtn()" disabled="">Disable all remote
            audios</button>

        <button id="disableVideoBtn" onclick="testDisableVideo()">Disable local video</button>

        <button id="switchCameraBtn" onclick="switchCamera()" disabled="">Switch Camera (mobile only)</button>

        <button id="leaveBtn" onclick="testLeave()" disabled="">Leave room</button>

        Status: <span id="txtStatus" style="color: red">Not started</span>
    </div>

    <div id="videos"></div>

</body>

</html>