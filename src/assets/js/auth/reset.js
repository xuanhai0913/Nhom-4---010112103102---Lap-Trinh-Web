$('#form-reset').submit(function (e) {
    e.preventDefault();
    clearErrors();
    $.ajax({
        type: 'POST',
        url: '../../PHP/auth/resetPassword.php',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (response) {
            console.log(response);
            if (response.status === 'error') {
                showError(response.object, response.message, response.form);
            } else {
                setInterval(function () {
                    location = '../../PHP/auth/logout.php';
                }, 3000);
                showAlert(response.message, 'success');
            }
        }
    });
});
function showError(object, message, form) {
    document.querySelector(`#input__${object}-${form}`).classList.add('input--error');
    document.querySelector(`#message__${object}-${form}`).innerHTML = "<i class='fas fa-exclamation-circle'></i> " + message;
    document.querySelector(`#message__${object}-${form}`).style.display = 'block';
}

function clearErrors() {
    // Xóa lớp 'input--error' và ẩn tất cả thông báo lỗi
    document.querySelectorAll('.input--error').forEach(element => {
        element.classList.remove('input--error');
    });
    document.querySelectorAll('.message').forEach(element => {
        element.style.display = 'none';
        element.innerHTML = '';
    });
}