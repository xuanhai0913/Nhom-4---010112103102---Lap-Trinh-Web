const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const form = document.getElementById('form');
const formInput = document.getElementById('form-sign-in');

signUpButton.addEventListener('click', () => {
    form.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    form.classList.remove("right-panel-active");
});

function moveForgot() {
    formInput.style.top = '-100%';
}

function moveResetPassword() {
    formInput.style.top = '-200%';
}

function moveDefault() {
    formInput.style.top = '0%';
}

$(document).ready(function () {
    $("#captcha").hide();
    $("#btn-captcha").hide();
    $(".btn-send").click(function () {
        $("#captcha").show();
        $("#btn-captcha").show();
        $(this).text("Gửi lại");
    });
});

$('#form-register').submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: '../../PHP/auth/register.php',
        data: $(this).serialize(),
        success: function (response) {
            response = JSON.parse(response);
            console.log(response);
            if (response.status === 'error') {
                alert(response.message);
            } else {
                alert(response.message);
                sessionStorage.setItem('focusLoginInput', 'true'); // Lưu cờ trạng thái
                location.reload();
            }
        }
    });
});

$(document).ready(function () {
    if (sessionStorage.getItem('focusLoginInput') === 'true') {
        $('#form-login input:first').focus(); // Trỏ vào input đầu tiên của form login
        sessionStorage.removeItem('focusLoginInput'); // Xóa cờ trạng thái sau khi sử dụng
    }
});



$('#form-login').submit(function (e) {
    e.preventDefault();
    clearErrors(); // Xóa lớp 'input--error' và tất cả thông báo lỗi
    $.ajax({
        type: 'POST',
        url: '../../PHP/auth/login.php',
        data: $(this).serialize(),
        success: function (response) {
            response = JSON.parse(response);
            console.log(response);
            if (response.status === 'error') {
                if (response.object === 'password') {
                    showError('password',response.message);
                }
                if (response.object === 'username') {
                    showError('username',response.message);
                } 

            } else {
                window.location.href = '../../PHP/pages/home.php';
            }
        }
    });
});

$('#form-forgot').submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: '../../PHP/auth/forgot.php',
        data: $(this).serialize(),
        success: function (response) {
            response = JSON.parse(response);
            console.log(response);
            if (response.status === 'error') {
                showError('email',response.message);             
            } else {
                alert(response.message);
            }
        }
    });
});

$('#form-verify-code').submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: '../../PHP/auth/verify_code.php',
        data: $(this).serialize(),
        success: function (response) {
            try {
                response = JSON.parse(response);
                alert(response.message);
            } catch (error) {
                console.error("Error parsing JSON:", error, response);
                alert("Có lỗi xảy ra khi xử lý phản hồi.");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
            alert("Có lỗi xảy ra khi gửi yêu cầu.");
        }
    });
});




function showError(object, message) {
    document.querySelector(`#input__${object}`).classList.add('input--error');
    document.querySelector(`#message__${object}`).innerHTML = "<i class='fas fa-exclamation-circle'></i> " + message;
    document.querySelector(`#message__${object}`).style.display = 'block';
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