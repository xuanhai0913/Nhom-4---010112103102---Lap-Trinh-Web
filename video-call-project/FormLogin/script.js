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

$(document).ready(function() {
    $("#captcha").hide();
    $("#btn-captcha").hide();
    $(".btn-send").click(function() {
        $("#captcha").show();
        $("#btn-captcha").show();
        $(this).text("Gửi lại");
    });
});
