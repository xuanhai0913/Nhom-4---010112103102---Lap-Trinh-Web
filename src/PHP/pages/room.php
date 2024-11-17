<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Clone Zoom với Stringee hihi</title>

    <!-- import the webpage's stylesheet -->
    <link rel="stylesheet" href="/room.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@0.20.0/dist/axios.min.js"></script>
    <script src="https://cdn.stringee.com/sdk/web/2.2.1/stringee-web-sdk.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="container__content has-text-centered" v-cloak id="app">
            <div class="header">
                <div class="logo" v-if="room">
                    <img alt="Logo" height="50" src="logo.png" />
                </div>
                <div class="function">
                    <button class="function__create-room is-primary" v-if="!room" @click="createRoom">
                        <i class="fa-solid fa-plus"></i>
                        Tạo Meeting
                    </button>

                    <button class="join-room__button is-info" v-if="!room" @click="joinWithId">
                        Join Meeting
                        <div class="join-room__button-icon">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </button>

                    <button class="function__button is-info" v-if="room" @click="publish(true)">
                        Share Desktop
                    </button>
                    <!-- New control buttons -->
                    <button class="function__button" v-if="room" @click="toggleCamera">
                        <i :class="isCameraOn ? 'fa-solid fa-video' : 'fa-solid fa-video-slash'"></i>
                    </button>
                    <button class="function__button" v-if="room" @click="toggleMicrophone">
                        <i :class="isMicrophoneOn ? 'fa-solid fa-microphone' : 'fa-solid fa-microphone-slash'"></i>
                    </button>
                    <button class="function__button" v-if="room" @click="openSettings">
                        <i class="fa-solid fa-cog"></i>
                    </button>
                    <!-- Menu cài đặt -->
                    <div id="settingsMenu" v-if="showSettings" class="settings-menu">
                        <!-- Chọn Camera -->
                        <label for="videoSelect">Chọn Camera:</label>
                        <select id="videoSelect" v-model="selectedVideoDevice" @change="updateVideoDevice">
                            <option v-for="device in videoDevices" :key="device.deviceId" :value="device.deviceId">
                                {{ device.label || 'Camera ' + (videoDevices.indexOf(device) + 1) }}
                            </option>
                        </select>

                        <!-- Chọn Microphone -->
                        <label for="audioSelect">Chọn Microphone:</label>
                        <select id="audioSelect" v-model="selectedAudioDevice" @change="updateAudioDevice">
                            <option v-for="device in audioDevices" :key="device.deviceId" :value="device.deviceId">
                                {{ device.label || 'Micro ' + (audioDevices.indexOf(device) + 1) }}
                            </option>
                        </select>

                        <!-- Chọn Loa -->
                        <label for="audioOutputSelect">Chọn Loa:</label>
                        <select id="audioOutputSelect" v-model="selectedAudioOutput" @change="updateAudioOutput">
                            <option v-for="device in audioOutputs" :key="device.deviceId" :value="device.deviceId">
                                {{ device.label || 'Loa ' + (audioOutputs.indexOf(device) + 1) }}
                            </option>
                        </select>
                    </div>
                </div>
                <button class="btn-info" v-if="room" @click="toggleRoomInfo">
                    <i class="fa-solid fa-info"></i>
                </button>

                <div v-if="roomId && showRoomInfo" class="info-room" id="info-room">
                    <h3>Chi tiết về phòng họp</h3>
                    <p>
                        <strong>Thông tin về cách tham gia phòng</strong></br>
                        Gửi link này cho bạn bè cùng join room nhé
                        <a v-bind:href="roomUrl" target="_blank">{{roomUrl}}</a>, hoặc bạn cũng có thể copy <strong>{{roomId}}</strong> để share.
                    </p>
                </div>
            </div>
        </div>

        <div class="container__video">
            <div id="videos" class="videos">
            </div>
        </div>
    </div>
</body>
<script src="/api.js"></script>
<script src="/room.js"></script>

</html>