function testDisableRemoteVideosBtn() {
    if (!room.permissionControlRoom) {
        alert('You are not Host, permission denied');
        return;
    }

    subscribedTracks.forEach(function (track) {
        if (track.screen) {
            return;
        }

        track.disableRemoteVideo();
        $('#disableRemoteVideosBtn').attr('disabled', 'disabled');
    });
}

function testDisableRemoteAudiosBtn() {
    if (!room.permissionControlRoom) {
        alert('You are not Host, permission denied');
        return;
    }

    subscribedTracks.forEach(function (track) {
        if (track.screen) {
            return;
        }

        track.disableRemoteAudio();
        $('#disableRemoteAudiosBtn').attr('disabled', 'disabled');
    });
}

function testDisableVideo() {
    localTracks.forEach(function (track) {
        if (track.screen) {
            return;
        }

        console.log('hien tai track.localVideoEnabled=' + track.localVideoEnabled);

        if (track.localVideoEnabled) {
            //disable
            track.enableLocalVideo(false);
            $('#disableVideoBtn').html('Enable local video');
        } else {
            //enable
            track.enableLocalVideo(true);
            $('#disableVideoBtn').html('Disable local video');
        }
    });
}

function switchCamera() {
    localTracks.forEach(function (track) {
        if (track.screen) {
            return;
        }

        track.switchCamera();
    });
}