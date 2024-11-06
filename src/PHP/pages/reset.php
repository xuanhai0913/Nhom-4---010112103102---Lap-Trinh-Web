<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/css/base.css">
    <link rel="stylesheet" href="../../assets/css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../../assets/js/jquery-3.7.1.min.js"></script>
</head>

<body>
    <article class="container">
        <div class="wrapper">
            <div class="form-container" id="form">
                <div class="section__form section__form--signUp">
                    <div id="notification"></div>
                    <div class="form-reset">
                        <form id="form-forgot" >
                            <h1>Forgot Password</h1>
                            <span>Sử email mà bạn đã đăng ký để nhận mã.</span>
                            <input type="email" name="email" placeholder="Email" />
                            <button class="btn-send">Gửi mã</button>
                        </form>
                        <form id="form-verify-code">
                            <input id=" captcha" type="text" placeholder="Mã xác nhận" name='verify-code' />
                            <button id="btn-captcha" type="submit">Xác nhận</button>
                        </form>
                    </div>
                    <form id="form-reset" class="form-reset">
                        <h1>Reset Password</h1>
                        <span>Đặt lại mật khẩu của bạn.</span>
                        <input class="forgot__input" type='' placeholder="Mật khẩu mới">
                        <input class="forgot__input" type='' placeholder="Xác nhận mật khẩu">
                        <button>Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
        <article class="container">
</body>

<script src="../../assets/js/script.js"></script>


</html>