
function joinRoomAndSubAllTracks() {
    let promise = new Promise(function (resolve, reject) {
        StringeeVideo.joinRoom(stringeeClient, roomToken).then(function (data) {
            console.log('join room success data: ', data);

            $('#shareScreenBtn').removeAttr('disabled');
            $('#leaveBtn').removeAttr('disabled');
            $('#muteBtn').removeAttr('disabled');
            $('#disableVideoBtn').removeAttr('disabled');
            $('#joinBtn').attr('disabled', 'disabled');
            $('#disableRemoteVideosBtn').removeAttr('disabled');
            $('#disableRemoteAudiosBtn').removeAttr('disabled');

//                        $('#switchCameraBtn').removeAttr('disabled');

            $('#txtStatus').html('Joined, Permission control room: ' + data.room.permissionControlRoom);

            room = data.room;

            //room events
            room.clearAllOnMethos();
            room.on('joinroom', function (event) {
                console.log('on join room: ' + JSON.stringify(event.info));
            });
            room.on('leaveroom', function (event) {
                console.log('on leave room: ' + JSON.stringify(event.info));
            });
            room.on('message', function (event) {
                console.log('on message: ' + JSON.stringify(event.info));
            });
            room.on('addtrack', function (event) {
                console.log('on add track: ' + JSON.stringify(event.info));
                var local = false;
                localTracks.forEach(function (localTrack2) {
                    if (localTrack2.serverId === event.info.track.serverId) {
                        console.log(localTrack2.serverId + ' is LOCAL');
                        local = true;
                    }
                });
                if (!local) {
                    subscribe(event.info.track);
                }
            });
            room.on('removetrack', function (event) {
                console.log('on remove track', event);
                var track = event.track;
                if (!track) {
                    return;
                }

                //todo remove
                localTracks.forEach((localTrack2, index) => {
                    if (localTrack2.serverId === track.serverId) {
                        localTracks.splice(index, 1);
                    }
                });
                subscribedTracks.forEach((subscribedTrack22, index) => {
                    if (subscribedTrack22.serverId === track.serverId) {
                        subscribedTracks.splice(index, 1);
                    }
                });

                var mediaElements = track.detach();
                mediaElements.forEach(function (videoElement) {
                    videoElement.remove();
                });
            });

            room.on('trackmediachange', function (event) {
                console.log('on track media change', event);
            });

            data.listTracksInfo.forEach(function (trackInfo) {
                subscribe(trackInfo);
            });

            resolve();
        }).catch(function (res) {
            reject();
            console.log('join room ERROR: ', res);
        });
    });
    return promise;
}

function subscribe(trackInfo) {
    var subOptions = {
        audio: true,
        video: true
    };

    room.subscribe(trackInfo.serverId, subOptions).then(function (track) {
        console.log('subscribe success: track', track);
        console.log('subscribe success: subOptions', subOptions);

        subscribedTracks.push(track);

        track.on('ready', function () {
            console.log('track on ready');

            var videoElement = track.attach();
            videoElement.setAttribute("style", "width: 300px;background: #424141;padding: 5px;height: 200px;margin: 5px");
            videoElement.setAttribute("controls", "true");

            if (selectedSpeakerId) {
                track.routeAudioToSpeaker(selectedSpeakerId);
            }

            document.body.appendChild(videoElement);
        });
    }).catch(function (res) {
        console.log('subscribe ERROR: ', res);
    });
}

function testUnpublish() {
    console.log('Unpublish');
    localTracks.forEach(function (localTrack) {
        room.unpublish(localTrack);

        localTrack.detachAndRemove();
    });
}

function testHangupCall() {
    localTracks.forEach(function (localTrack) {
        localTrack.close();
    });
}

function testLeave() {
    room.leave(true);

    localTracks.forEach(function (track) {
        track.close();
        track.detachAndRemove();
    });
    subscribedTracks.forEach(function (track) {
        track.detachAndRemove();
    });

    localTracks = [];
    subscribedTracks = [];
    room = null;

    $('#shareScreenBtn').attr('disabled', 'disabled');
    $('#leaveBtn').attr('disabled', 'disabled');
    $('#muteBtn').attr('disabled', 'disabled');
    $('#disableVideoBtn').attr('disabled', 'disabled');
    $('#checkDeviceBtn').removeAttr('disabled');
}

function sendMsg() {
    var msg = {
        a: 'b',
        c: 1,
        d: ['1', '2', '3']
    };
    room.sendMessage(msg).then(function () {
        console.log('send ok');
    }).catch(function (e) {
        console.log('send error', e);
    });
}

function showStatus(txtStatus) {
    $('#txtStatus').html(txtStatus);
}

function testMute() {
    localTracks.forEach(function (track) {
        if (track.muted) {
            //unmute
            console.log('unmute');
            track.mute(false);
            $('#muteBtn').html('Mute');
        } else {
            //mute
            console.log('mute');
            track.mute(true);
            $('#muteBtn').html('Unmute');
        }
    });
}