<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login | Ghufta Services</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('/assets/img/icon.ico') }}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ asset('/assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ asset('/assets/css/fonts.min.css') }}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/atlantis.css') }}">
</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<h3 class="text-center">Login</h3>
			<form action="{{ route('login') }}" method="post">
				@csrf
				<div class="login-form">
					<div class="form-group">
						<label for="email" class="placeholder"><b>Email</b></label>
						<input id="email" name="email" type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="password" class="placeholder"><b>Password</b></label>
						<a href="#" class="link float-right">Forget Password ?</a>
						<div class="position-relative">
							<input id="password" name="password" type="password" class="form-control" required>
							<div class="show-password">
								<i class="icon-eye"></i>
							</div>
						</div>
					</div>
					<div class="form-group float-right">
						<button type="submit" class="btn btn-primary btn-round btn-lg">Sign In</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script src="{{ asset('/assets/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('/assets/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('/assets/js/core/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/assets/js/atlantis.min.js') }}"></script>
</body>
</html>