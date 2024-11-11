$(document).ready(function() {
    $('#form-edit-profile').on('submit', function(e) {
        e.preventDefault(); // Ngừng việc gửi form mặc định

        // Gửi AJAX request
        $.ajax({
            url: '../../PHP/profile/profile_edit.php', // Đặt URL nơi xử lý form
            type: 'POST',
            data: $(this).serialize() + '&submit_save_profile=true', // Serialize dữ liệu form
            dataType: 'json', // Đảm bảo server trả về JSON
            success: function(response) {
                console.log(response); // Kiểm tra dữ liệu trả về trong console
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
