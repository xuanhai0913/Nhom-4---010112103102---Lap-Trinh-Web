// auth.js
var userId;
var stringeeClient;

function login() {
    userId = $('#userId').val();
    if (!userId) {
        alert('Please enter your user ID');
        return;
    }

    if (!stringeeClient) {
        stringeeClient = new StringeeClient(STRINGEE_SERVER_ADDRS);
        settingsClientEvents(stringeeClient);
        getAccessTokenAndConnectToStringee(stringeeClient);
    }
}

function settingsClientEvents(client) {
    client.on('authen', function (res) {
        console.log('on authen: ', res);
        if (res.r === 0) {
            $('#loginBtn').attr('disabled', 'disabled');
            $('#checkDeviceBtn').removeAttr('disabled');
            $('#loggedUserId').html(res.userId).css('color', 'blue');
        }
    });

    client.on('disconnect', function () {
        console.log('Disconnected');
    });
}

function getAccessTokenAndConnectToStringee(client) {
    $.getJSON(getTokenUrl + "?userId=" + userId + "&roomId=" + roomId, function (res) {
        client.connect(res.access_token);
        roomToken = res.room_token;
    });
}
