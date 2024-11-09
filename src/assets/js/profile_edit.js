$(document).ready(function() {
    // Xử lý sự kiện gửi form
    $('#form-edit-profile').on('submit', function(e) {
        e.preventDefault(); // Ngừng việc gửi form mặc định

        // Gửi AJAX request
        $.ajax({
            url: '../../PHP/auth/profile_edit.php', // Đặt URL nơi xử lý form, ở đây là trang hiện tại
            type: 'POST',
            data: $(this).serialize(), // Serialize dữ liệu form
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message); // Hiển thị thông báo thành công
                } else {
                    alert(response.message); // Hiển thị thông báo lỗi
                }
            },
            error: function() {
                alert('Có lỗi xảy ra, vui lòng thử lại sau.');
            }
        });
    });
});