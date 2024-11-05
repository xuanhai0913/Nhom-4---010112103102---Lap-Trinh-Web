// roomManagement.js
function createRoom() {
    const accessToken = 'eyJjdHkiOiJzdHJpbmdlZS1hcGk7dj0xIiwidHlwIjoiSldUIiwiYWxnIjoiSFMyNTYifQ.eyJqdGkiOiJTSy4wLmtLbkliWjBxZGZSbGd4T0pzODBrNEFiWjNkYTh4Rk0tMTczMDcyOTE3MiIsImlzcyI6IlNLLjAua0tuSWJaMHFkZlJsZ3hPSnM4MGs0QWJaM2RhOHhGTSIsImV4cCI6MTczMzMyMTE3MiwicmVzdF9hcGkiOnRydWV9.YPTdcHM0uzC7y3gBNzxS3nzI_pywC4jIrPn78wMwENc';
    const roomName = $('#roomNameInput').val();
    const uniqueName = $('#uniqueNameInput').val();

    $.ajax({
        url: 'https://api.stringee.com/v1/room2/create',
        type: 'POST',
        headers: { 'X-STRINGEE-AUTH': accessToken, 'Content-Type': 'application/json' },
        data: JSON.stringify({ name: roomName, uniqueName: uniqueName }),
        success: function(response) {
            if (response.r === 0) {
                $('#roomIdDisplay').text('Room ID: ' + response.roomId);
                joinRoom(response.data.roomId);
            } else {
                alert('Error creating room: ' + response.message);
            }
        },
        error: function(error) { console.error('Error creating room:', error); }
    });
}

function listRooms() {
    const accessToken = 'eyJjdHkiOiJzdHJpbmdlZS1hcGk7dj0xIiwidHlwIjoiSldUIiwiYWxnIjoiSFMyNTYifQ.eyJqdGkiOiJTSy4wLmtLbkliWjBxZGZSbGd4T0pzODBrNEFiWjNkYTh4Rk0tMTczMDcyOTE3MiIsImlzcyI6IlNLLjAua0tuSWJaMHFkZlJsZ3hPSnM4MGs0QWJaM2RhOHhGTSIsImV4cCI6MTczMzMyMTE3MiwicmVzdF9hcGkiOnRydWV9.YPTdcHM0uzC7y3gBNzxS3nzI_pywC4jIrPn78wMwENc';
    $.ajax({
        url: 'https://api.stringee.com/v1/room2/list',
        type: 'GET',
        headers: { 'X-STRINGEE-AUTH': accessToken },
        success: function(response) {
            console.log('Room list:', response);
        },
        error: function(error) {
            console.error('Error listing rooms:', error);
        }
    });
}

function deleteRoom() {
    const accessToken = 'eyJjdHkiOiJzdHJpbmdlZS1hcGk7dj0xIiwidHlwIjoiSldUIiwiYWxnIjoiSFMyNTYifQ.eyJqdGkiOiJTSy4wLmtLbkliWjBxZGZSbGd4T0pzODBrNEFiWjNkYTh4Rk0tMTczMDcyOTE3MiIsImlzcyI6IlNLLjAua0tuSWJaMHFkZlJsZ3hPSnM4MGs0QWJaM2RhOHhGTSIsImV4cCI6MTczMzMyMTE3MiwicmVzdF9hcGkiOnRydWV9.YPTdcHM0uzC7y3gBNzxS3nzI_pywC4jIrPn78wMwENc';
    const roomIdToDelete = $('#deleteRoomId').val();

    $.ajax({
        url: 'https://api.stringee.com/v1/room2/delete',
type: 'DELETE',
        headers: { 'X-STRINGEE-AUTH': accessToken, 'Content-Type': 'application/json' },
        data: JSON.stringify({ roomId: roomIdToDelete }),
        success: function(response) { console.log('Room deleted:', response); },
        error: function(error) { console.error('Error deleting room:', error); }
    });
}
