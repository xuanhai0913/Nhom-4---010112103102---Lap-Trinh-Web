const videoContainer = document.querySelector("#videos");

const vm = new Vue({
  el: "#app",
  data: {
    userToken: "",
    roomId: "",
    roomToken: "",
    room: undefined,
    callClient: undefined,
    localTrack: null,
    isCameraOn: true,
    isMicrophoneOn: true,
    showSettings: false,
    showRoomInfo: false,
    videoDevices: [],
    audioDevices: [],
    audioOutputs: [],
    selectedVideoDevice: "",
    selectedAudioDevice: "",
    selectedAudioOutput: ""
  },
  computed: {
    roomUrl: function () {
      return `https://${location.hostname}?room=${this.roomId}`;
    }
  },
  async mounted() {
    api.setRestToken();

    const urlParams = new URLSearchParams(location.search);
    const roomId = urlParams.get("room");
    if (roomId) {
      this.roomId = roomId;

      await this.join();
    }
  },
  methods: {
    authen: function () {
      return new Promise(async resolve => {
        const userId = `${(Math.random() * 100000).toFixed(6)}`;
        const userToken = await api.getUserToken(userId);
        this.userToken = userToken;

        if (!this.callClient) {
          const client = new StringeeClient();

          client.on("authen", function (res) {
            console.log("on authen: ", res);
            resolve(res);
          });
          this.callClient = client;
        }
        this.callClient.connect(userToken);
      });
    },
    publish: async function (screenSharing = false) {
      const localTrack = await StringeeVideo.createLocalVideoTrack(
        this.callClient,
        {
          audio: true,
          video: true,
          screen: screenSharing,
          videoDimensions: { width: 640, height: 360 }
        }
      );

      const videoElement = localTrack.attach();
      this.addVideo(videoElement);

      const roomData = await StringeeVideo.joinRoom(
        this.callClient,
        this.roomToken
      );
      const room = roomData.room;
      console.log({ roomData, room });

      if (!this.room) {
        this.room = room;
        room.clearAllOnMethos();
        room.on("addtrack", e => {
          const track = e.info.track;

          console.log("addtrack", track);
          if (track.serverId === localTrack.serverId) {
            console.log("local");
            return;
          }
          this.subscribe(track);
        });
        room.on("removetrack", e => {
          const track = e.track;
          if (!track) {
            return;
          }

          const mediaElements = track.detach();
          mediaElements.forEach(element => element.remove());
        });

        // Join existing tracks
        roomData.listTracksInfo.forEach(info => this.subscribe(info));
      }

      await room.publish(localTrack);
      console.log("room publish successful");
    },
    createRoom: async function () {
      const room = await api.createRoom();
      const { roomId } = room;
      const roomToken = await api.getRoomToken(roomId);

      this.roomId = roomId;
      this.roomToken = roomToken;
      console.log({ roomId, roomToken });

      await this.authen();
      await this.publish();
    },
    join: async function () {
      const roomToken = await api.getRoomToken(this.roomId);
      this.roomToken = roomToken;

      await this.authen();
      await this.publish();
    },
    joinWithId: async function () {
      const roomId = prompt("Dán Room ID vào đây nhé!");
      if (roomId) {
        this.roomId = roomId;
        await this.join();
      }
    },
    subscribe: async function (trackInfo) {
      const track = await this.room.subscribe(trackInfo.serverId);
      track.on("ready", () => {
        const videoElement = track.attach();
        this.addVideo(videoElement);
      });
    },
    addVideo: function (video) {
      video.setAttribute("controls", "true");
      video.setAttribute("playsinline", "true");
      videoContainer.appendChild(video);
    },
    toggleCamera: async function () {
      this.isCameraOn = !this.isCameraOn;
      if (this.localTrack) {
        this.localTrack.video = this.isCameraOn;
        if (this.isCameraOn) {
          this.localTrack.switchCamera(this.selectedVideoDevice);
        }
      }
    },

    toggleMicrophone: async function () {
      this.isMicrophoneOn = !this.isMicrophoneOn;
      if (this.localTrack) {
        this.localTrack.audio = this.isMicrophoneOn;
        if (this.isMicrophoneOn) {
          this.localTrack.switchMicrophone(this.selectedAudioDevice);
        }
      }
    },
    openSettings: async function () {
      this.showSettings = !this.showSettings;
      const devices = await navigator.mediaDevices.enumerateDevices();
      this.audioDevices = devices.filter(device => device.kind === "audioinput");
      this.videoDevices = devices.filter(device => device.kind === "videoinput");
      this.audioOutputs = devices.filter(device => device.kind === "audiooutput");

      this.selectedAudioDevice = this.audioDevices[0]?.deviceId || "";
      this.selectedVideoDevice = this.videoDevices[0]?.deviceId || "";
      this.selectedAudioOutput = this.audioOutputs[0]?.deviceId || "";
    },
    closeSettings: function () {
      this.showSettings = false;
    },
    updateVideoDevice: async function () {
      if (this.localTrack) {
        await this.localTrack.switchCamera(this.selectedVideoDevice);
      }
    },
    updateAudioDevice: async function () {
      if (this.localTrack) {
        await this.localTrack.switchMicrophone(this.selectedAudioDevice);
      }
    },
    updateAudioOutput: function () {
      const audioOutput = this.audioOutputs.find(
        device => device.deviceId === this.selectedAudioOutput
      );
      if (audioOutput) {
        const audioElement = document.querySelector("audio");
        audioElement.setSinkId(audioOutput.deviceId);
      }
    },
    toggleRoomInfo: function () {
      this.showRoomInfo = !this.showRoomInfo;
    }
  }
});
