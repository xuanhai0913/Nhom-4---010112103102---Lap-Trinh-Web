document.addEventListener('DOMContentLoaded', function () {
    // Nút tạo phòng mới
    document.getElementById('createRoomButton').addEventListener('click', function () {
        // Tạo mã phòng ngẫu nhiên
        const roomId = 'room_' + Math.floor(Math.random() * 10000);

        // Lưu roomId vào session qua AJAX và chuyển hướng đến Room.php
        $.ajax({
            url: 'saveRoom.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ roomId: roomId }),
            success: function (response) {
                if (response.success) {
                    window.location.href = `Room.php?roomId=${roomId}`;
                } else {
                    alert('Có lỗi xảy ra khi tạo phòng.');
                }
            }
        });
    });

    // Nút tham gia phòng bằng mã phòng
    document.getElementById('joinRoomButton').addEventListener('click', function () {
        const roomId = document.getElementById('roomCode').value.trim();

        if (roomId) {
            $.ajax({
                url: 'saveRoom.php',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ roomId: roomId }),
                success: function (response) {
                    if (response.success) {
                        window.location.href = `Room.php?roomId=${roomId}`;
                    } else {
                        alert('Có lỗi xảy ra khi tham gia phòng.');
                    }
                }
            });
        } else {
            alert('Vui lòng nhập mã phòng hợp lệ.');
        }
    });
});

// Hàm dán mã phòng (nếu cần)
function pasteRoomCode() {
    navigator.clipboard.readText().then(
        text => document.getElementById('roomCode').value = text
    ).catch(err => console.error('Không thể dán mã phòng:', err));
}
