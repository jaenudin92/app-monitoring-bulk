<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url(); ?>assets/" data-template="vertical-menu-template-free">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<title>Login Page</title>
	<meta name="description" content="" />
	<link rel="icon" type="image/x-icon" href="<?= base_url(); ?>assets/img/favicon/favicon.ico" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/css2.css" rel="stylesheet"/>
	<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/fonts/boxicons.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
	<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/demo.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/css/pages/page-auth.css" />
	<script src="<?= base_url(); ?>assets/vendor/js/helpers.js"></script>
	<script src="<?= base_url(); ?>assets/js/config.js"></script>
</head>

<body>
	<!-- Content -->

	<div class="container-xxl">
		<div class="authentication-wrapper authentication-basic container-p-y">
			<div class="authentication-inner">
				<!-- Register -->
				<div class="card">
					<div class="card-body">
						<!-- Logo -->
						<div class="app-brand justify-content-center">
							<a href="index.html" class="app-brand-link gap-2">
								<span class="app-brand-text demo text-body fw-bolder text-uppercase">Login Page</span>
							</a>
						</div>
						<!-- /Logo -->
						<h4 class="mb-2">Welcome to app! 👋</h4>
						<p class="mb-4">Please sign-in to your username and password</p>

						<form id="formAuthentication" class="mb-3" method="POST">
							<div class="mb-3">
								<label for="username" class="form-label">Username</label>
								<input type="text" class="form-control" id="username" name="username" placeholder="Enter username" autofocus />
								<small class="text-danger" id="msg-username"></small>
							</div>
							<div class="mb-3">
								<label for="password" class="form-label">Password</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
								<small class="text-danger" id="msg-password"></small>
							</div>
							<div class="mb-3">
								<button class="btn btn-primary d-grid w-100" id="btn-sign" type="submit">Sign in</button>
							</div>
						</form>

						<p class="text-center">
							<span>PT. Paragon Innovation</span>
						</p>
					</div>
				</div>
				<!-- /Register -->
			</div>
		</div>
	</div>

	<!-- Core JS -->
	<!-- build:js assets/vendor/js/core.js -->
	<script src="<?= base_url(); ?>assets/vendor/libs/jquery/jquery.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/libs/popper/popper.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/js/bootstrap.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/js/menu.js"></script>
	<script src="<?= base_url(); ?>assets/js/main.js"></script>
	<script src="<?= base_url(); ?>assets/js/buttons.js"></script>
	<script src="<?= base_url(); ?>assets/js//sweetalert2.all.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function (){

			function getBaseUrl()
			{
				var url = location.href;
				var index = url.search("index.php");
				var base_url = url.substr(0,index);
				return base_url;
			}

			$("#formAuthentication").submit(function(e){
				e.preventDefault();

				$.ajax({
					type: "POST",
					url: getBaseUrl()+"Login/process",
					data: $(this).serialize(),
					dataType: "json",
					beforeSend: function(){
						$("#btn-sign").attr("disabled","disabled");
					},
					success: function(response) {

						if (response.error) {
							if (response.username_error != '') {
								$("#msg-username").html(response.username_error);
							}else{
								$("#msg-username").html("");
							}
							if (response.password_error != '') {
								$("#msg-password").html(response.password_error);
							}else{
								$("#msg-password").html("");
							}
							if (response.errdetail == 'errup') {
								Swal.fire({
									text: response.msg,
									icon: 'error',
									confirmButtonText: 'Close'
								})
							}else if (response.errdetail == 'erru') {
								Swal.fire({
									text: response.msg,
									icon: 'error',
									confirmButtonText: 'Close'
								})
							}else if (response.errdetail == 'errp') {
								Swal.fire({
									text: response.msg,
									icon: 'error',
									confirmButtonText: 'Close'
								})
							}
						}
						if (response.success) {
							Swal.fire({
								text: 'Welcome',
								icon: 'success',
								showConfirmButton: false,
								timer: 1200
							});
							$("#msg-username").html("");
							$("#msg-password").html("");
							$("#formAuthentication")[0].reset();
							setInterval(function () {
								window.location.href = response.url;
							}, 1200);
						}
						$("#btn-sign").attr("disabled",false);
					}
				})
			})

		});
	</script>
</body>
</html>
