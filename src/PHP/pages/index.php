<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Video Conference</title>
	<link rel="stylesheet" href="../../assets/css/base.css">
	<link rel="stylesheet" href="../../assets/css/log.css">
	<script src="../../assets/js/jquery-3.7.1.min.js"></script>
</head>

<body>
	<article class="container">
		<div class="wrapper">
			<div class="form-container" id="form">
				<div class="section__form section__form--signUp">
					<form method="post" id="form-register" class="form-log">
						<h1>Create Account</h1>
						<div class="social">
							<a href="#" class="social__link"><i class="fab fa-facebook-f"></i></a>
							<a href="#" class="social__link"><i class="fab fa-google-plus-g"></i></a>
							<a href="#" class="social__link"><i class="fab fa-linkedin-in"></i></a>
						</div>
						<span>or use your email for registration</span>
						<div class="input-form">
							<input type="text" placeholder="Name" name="username" id='input__username-register' class="input" pattern="[a-zA-Z0-9._]{5,}" />
							<span id="message__username-register" class="message"></span>
						</div>
						<div class="input-form">
							<input type="email" placeholder="Email" name="email" id="input__email-register" class="input"/>
							<span id="message__email-register" class="message"></span>
						</div>
						<div class="input-form">
							<input type="password" placeholder="Password" name="password" pattern="[a-z0-9]{5,}" id="input__password-register" class="input" />
							<span id="message__password-register" class="message"></span>
						</div>
						<button>Sign Up</button>
					</form>
				</div>
				<div class="section__form section__form--signIn" id="form-sign-in">

					<form id="form-login" method="post" class="form-log">
						<h1>Sign in</h1>
						<div class="social">
							<a href="#" class="social__link"><i class="fab fa-facebook-f"></i></a>
							<a href="#" class="social__link"><i class="fab fa-google-plus-g"></i></a>
							<a href="#" class="social__link"><i class="fab fa-linkedin-in"></i></a>
						</div>
						<span>or use your account</span>
						<div class="input-form">
							<input type="text" placeholder="User name" name="username" class="input" id="input__username-login"/>
							<span id="message__username-login" class="message"></span>
						</div>
						<div class="input-form">
							<input type="password" placeholder="Password" name="password" id="input__password-login" class="input"/>
							<span id="message__password-login" class="message"></span>
						</div>
						<a id="forgot" onclick="moveForgot();">Forgot your password?</a>
						<button>Sign In</button>

					</form>
					<div class="form-log">
						<div onclick="moveDefault();" class="backToSignIn">
							<i class="fa-solid fa-chevron-up"></i>
						</div>
						<form id="form-forgot" method="post">
							<h1>Forgot Password</h1>
							<span>Sử email mà bạn đã đăng ký để nhận mã.</span>
							<div class="input-form">
								<input type="email" name="email" placeholder="Email" class="input" id="input__email-forgot" />
								<span id="message__email-forgot" class="message"></span>
							</div>
							<button class="btn-send">Gửi mã</button>
						</form>
						<form id="form-verify-code">
							<div class="input-form">
								<input id="input__captcha-verify" type="text" placeholder="Mã xác nhận" name='verify-code' class="input"/>
								<span id="message__captcha-verify" class="message"></span>
							</div>
							<button id="btn-captcha" type="submit">Xác nhận</button>
						</form>
					</div>

				</div>

				<div class="section__overlay">
					<div class="overlay">
						<div class="overlay__panel overlay__panel--left">
							<h1>Welcome Back!</h1>
							<p>To keep connected with us please login with your personal info</p>
							<button class="ghost" id="signIn">Sign In</button>
						</div>
						<div class="overlay__panel overlay__panel--right">
							<h1>Hello, Friend!</h1>
							<p>Enter your personal details and start journey with us</p>
							<button class="ghost" id="signUp">Sign Up</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<article class="container">
</body>

<script src="../../assets/js/script.js"></script>

</html>