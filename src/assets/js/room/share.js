function testShare() {
    var pubOptions = {
        screen: true,
        screenAudio: true
    };

    var localTrack33 = new StringeeVideoTrack(stringeeClient, pubOptions);
    localTrack33.isLocal = true;

    var promiseLocalTrackInit = localTrack33.init();
    promiseLocalTrackInit.then(function (localTrack1) {
        //ready for publish
//                    $('#joinBtn').removeAttr('disabled');
//                    $('#checkDeviceBtn').attr('disabled', 'disabled');

        testPublish(localTrack33);

        //play local video
        var videoElement = localTrack1.attach();
        videoElement.setAttribute("style", "width: 300px;background: black;padding: 5px;height: 200px;margin: 5px");
        videoElement.setAttribute("controls", "true");
        document.body.appendChild(videoElement);

    }).catch(function (res) {
        console.log('create Local Video Track ERROR: ', res);
        showStatus(res.name + ": " + res.message);
    });
}
function testJoin() {
    testPublish(localTrack22);
}

function testPublish(localTrack1) {
    console.log('create Local Video Track success: ', localTrack1);
//                localTracks.push(localTrack1);

    if (!room) {
        joinRoomAndSubAllTracks().then(function () {
            room.publish(localTrack1).then(function () {
                console.log('publish Local Video Track success: ' + localTrack1.serverId);
            }).catch(function (error1) {
                console.log('publish Local Video Track ERROR: ', error1);
            });
        }).catch();
    } else {
        room.publish(localTrack1).then(function () {
            console.log('publish Local Video Track success: ' + localTrack1.serverId);
        }).catch(function (error1) {
            console.log('publish Local Video Track ERROR: ', error1);
        });
    }
}