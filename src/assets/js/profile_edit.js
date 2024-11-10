$(document).ready(function() {
    // Xử lý sự kiện gửi form
    $('#form-edit-profile').on('submit', function(e) {
        e.preventDefault(); // Ngừng việc gửi form mặc định

        // Gửi AJAX request
        $.ajax({
            url: '../../PHP/profile/profile_edit.php', // Đặt URL nơi xử lý form, ở đây là trang hiện tại
            type: 'POST',
            data: $(this).serialize() + '&submit_save_profile=1', // Serialize dữ liệu form
            dataType: 'json',
            success: function(response) {
                response = JSON.parse(response);
                if (response.status === 'success') {
                    alert(response.message); // Hiển thị thông báo thành công
                } else {
                    alert(response.message); // Hiển thị thông báo lỗi
                }
            },
            error: function() {
                alert('Có lỗi xảy ra.');
            }
        });
    });
});