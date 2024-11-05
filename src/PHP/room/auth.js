// auth.js
var userId;
var stringeeClient;
$(document).ready(function() {
    $('#userId').on('input', function() {
        const userIdValue = $(this).val();
        $('#loginBtn').prop('disabled', userIdValue.trim() === '');
    });
});

function login() {
    userId = $('#userId').val();
    if (!userId) {
        alert('Please enter your user ID');
        return;
    }

    if (!stringeeClient) {
        stringeeClient = new StringeeClient(STRINGEE_SERVER_ADDRS);
        settingsClientEvents(stringeeClient);
    }

    // Lấy token và kết nối đến Stringee
    getAccessTokenAndConnectToStringee(stringeeClient);
}

function settingsClientEvents(client) {
    client.on('authen', function (res) {
        console.log('on authen: ', res);
        if (res.r === 0) {
            $('#loginBtn').attr('disabled', 'disabled');
            $('#checkDeviceBtn').removeAttr('disabled');
            $('#loggedUserId').html(res.userId).css('color', 'blue');
        } else {
            alert('Authentication failed: ' + res.message);
        }
    });

    client.on('disconnect', function () {
        console.log('Disconnected');
    });

    client.on('connect', function (res) {
        console.log('Connected to Stringee:', res);
    });

    client.on('error', function (error) {
        console.error('Error:', error);
    });
}

function getAccessTokenAndConnectToStringee(client) {
    $.getJSON(getTokenUrl + "?userId=" + userId + "&roomId=" + roomId, function (res) {
        if (res.error) {
            alert('Error getting access token: ' + res.error);
            return;
        }
        client.connect(res.access_token);
        roomToken = res.room_token;
    }).fail(function() {
        alert('Failed to fetch token. Please try again.');
    });
}
