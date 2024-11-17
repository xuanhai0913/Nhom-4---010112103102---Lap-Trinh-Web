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


// $(document).ready(function () {
//     // Đóng feedback khi click nút close-feedBack
//     $(document).on('click', '#close-feedBack', function () {
//         $('.feedBack').hide();
//     });

//     // Đóng success message khi click nút close-success
//     $(document).on('click', '#close-success', function () {
//         $('.feedBack').hide();
//     });
// });
