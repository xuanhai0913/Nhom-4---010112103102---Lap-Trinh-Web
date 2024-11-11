// deviceSettings.js
var selectedCameraId, selectedMicrophoneId, selectedSpeakerId;

$(document).ready(function () {
    $('#loginBtn').removeAttr('disabled');

    $("#listCameras").change(function () {
        selectedCameraId = $("#listCameras").val();
        localTrack22.changeDevice('video', selectedCameraId);
    });

    $("#listMicrophones").change(function () {
        selectedMicrophoneId = $("#listMicrophones").val();
        localTrack22.changeDevice('audio', selectedMicrophoneId);
    });

    $("#listSpeakers").change(function () {
        selectedSpeakerId = $("#listSpeakers").val();
        subscribedTracks.forEach(track => track.routeAudioToSpeaker(selectedSpeakerId));
    });
});

function checkDevice() {
    var pubOptions = { audio: true, video: true, screen: false, videoDimensions: getVideoWH() };
    localTrack22 = new StringeeVideoTrack(stringeeClient, pubOptions);
    localTrack22.init().then(localTrack => {
        localTracks.push(localTrack);
        $('#joinBtn').removeAttr('disabled');
        $('#checkDeviceBtn').attr('disabled', 'disabled');
    }).catch(res => console.log('Error creating Local Video Track:', res));
}
