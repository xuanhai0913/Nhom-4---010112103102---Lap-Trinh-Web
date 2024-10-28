<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="base.css">
	<link rel="stylesheet" href="style.css">
	<script src="jquery-3.7.1.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
		integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<article class="container">
		<div class="wrapper">
			<div class="form-container" id="form">
				<div class="section__form section__form--signUp">
					<?php include "register.php"; ?>
					<form action="register.php" method="post">
						<h1>Create Account</h1>
						<div class="social">
							<a href="#" class="social__link"><i class="fab fa-facebook-f"></i></a>
							<a href="#" class="social__link"><i class="fab fa-google-plus-g"></i></a>
							<a href="#" class="social__link"><i class="fab fa-linkedin-in"></i></a>
						</div>
						<span>or use your email for registration</span>
						<input type="text" placeholder="Name" name="username" required />
						<input type="email" placeholder="Email" name="email" required />
						<input type="password" placeholder="Password" name="password" required/>
						<button>Sign Up</button>
					</form>
				</div>
				<div class="section__form section__form--signIn" id="form-sign-in">
					<?php include "login.php"; ?>
					<form action="login.php" method="post">
						<h1>Sign in</h1>
						<div class="social">
							<a href="#" class="social__link"><i class="fab fa-facebook-f"></i></a>
							<a href="#" class="social__link"><i class="fab fa-google-plus-g"></i></a>
							<a href="#" class="social__link"><i class="fab fa-linkedin-in"></i></a>
						</div>
						<span>or use your account</span>
						<input type="text" placeholder="User name" name="username" required class="<?php echo $className; ?>"/>
						<input type="password" placeholder="Password" name="password" required class="<?php echo $className; ?>"/>
						<a id="forgot" onclick="moveForgot();">Forgot your password?</a>
						<button>Sign In</button>
					
					</form>

					<form action="forgot.php" method="post" id="forgot">
						<div onclick="moveDefault();" class="backToSignIn">
							<i class="fa-solid fa-chevron-up"></i>
						</div>
						<h1>Forgot Password</h1>
						<span>Sử email mà bạn đã đăng ký để nhận mã.</span>
						<input type="email" name="email" required placeholder="Email" />
						<button class="btn-send" type="submit" ">Gửi mã</button>
						<?php include "forgot.php"; ?>
						<input id="captcha" type="text" placeholder="Mã xác nhận" />
						<button id="btn-captcha" type="button" onclick="moveResetPassword();">Xác nhận</button>
					</form>

					<form>
						<div onclick="moveDefault();" class="backToSignIn">
							<i class="fa-solid fa-chevron-up"></i>
						</div>
						<h1>Reset Password</h1>
						<span>Đặt lại mật khẩu của bạn.</span>
						<input class="forgot__input" type='' placeholder="Mật khẩu mới">
						<input class="forgot__input" type='' placeholder="Xác nhận mật khẩu">
						<button>Xác nhận</button>
					</form>
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

<script src="script.js"></script>

</html>