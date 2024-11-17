function checkForm() {
    var issue = document.getElementById('issue').value;
    var description = document.getElementById('description').value;
    var submitButton = document.getElementById('submit-btn');

    // Kiểm tra nếu 'issue' và 'description' có giá trị hợp lệ
    if (issue !== "chose" && description.trim() !== "") {
        submitButton.disabled = false; // Bật nút submit
    } else {
        submitButton.disabled = true; // Giữ nút submit bị vô hiệu hóa
    }
}

document.getElementById('issue').addEventListener('input', checkForm);
document.getElementById('description').addEventListener('input', checkForm);

$(document).ready(function () {
    $(".feedback").hide();
    $(".btn-feedback").click(function () {
        $(".feedback").toggle().css("opacity", "1");
    });
    $(".feedback__closeIcon").click(function () {
        $(".feedback").hide();
    });
    $(document).mousedown(function (e) {
        var feedback = $(".feedback");
        var feedbackButton = $(".btn-feedback");

        if (!feedback.is(e.target) && feedback.has(e.target).length === 0 &&
            !feedbackButton.is(e.target) && feedbackButton.has(e.target).length === 0) {
                feedback.hide();
            feedbackButton.removeClass("active");
        }
    });
});

$(document).ready(function() {
    // Xử lý sự kiện submit của form
    $("#feedback-form").submit(function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: '../../PHP/feedBack/feedback_action.php', // Kiểm tra đường dẫn
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response); 
                if (response.status === 'success') {
                    // Hiển thị thông báo thành công
                    $('#feedback-message').html('<div class="feedback-success-message"><h2>' + response.message + '</h2></div>');
                    // Ẩn form
                    $('#feedback-form').hide();
                } else {
                    // Hiển thị thông báo lỗi
                    $('#feedback-message').html('<div class="feedback-error-message"><h2>' + response.message + '</h2></div>');
                }
            },
            error: function() {
                $('#feedback-message').html('<div class="feedback-error-message"><h2>Đã có lỗi xảy ra, vui lòng thử lại sau!</h2></div>');
            }
        });
    });

    $(".feedback__closeIcon").click(function () {
        $('#feedback-form').hide();
        $('#feedback-message').html(''); // Xóa thông báo
        document.getElementById('feedback-form').reset(); // Reset form
        $('#feedback-form').show();
    });
});
