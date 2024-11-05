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

function submitForm(formId, actionUrl) {
    const form = document.getElementById(formId);
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch(actionUrl, {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                const notification = document.getElementById('notification');
                notification.textContent = data;
                notification.style.display = 'block';
            })
            .catch(error => console.error('Error:', error));
    });
}

submitForm('form-register', '../auth/register.php');
submitForm('form-login', '../auth/login.php');
submitForm('form-forgot-password', '../auth/forgot.php');
submitForm('form-verify-code', '../auth/verify_code.php');
