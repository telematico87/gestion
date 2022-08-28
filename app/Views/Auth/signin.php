<!--
=========================================================
* Argon Dashboard 2 - v2.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="../assets/img/favicon.png">
	<title>Gestion v1</title>
	<!-- Fonts and icons -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
	<!-- Nucleo Icons -->
	<link href="<?= base_url('assets/css/nucleo-icons.css');?>" rel="stylesheet"/>
	<!-- CSS Files -->
	<link id="pagestyle" href="<?= base_url('assets/css/argon-dashboard.css');?>" rel="stylesheet"/>
</head>

<body class="">
	<main class="main-content mt-0">
		<section>
			<div class="page-header min-vh-100">
				<div class="container">
					<div class="row">
						<div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
							<div class="card card-plain">
								<div class="card-header pb-0 text-start">
									<h4 class="font-weight-bolder">Sign In</h4>
									<p class="mb-0">Ingrese su correo electrónico y contraseña para iniciar sesión</p>
								</div>
								<div class="card-body">
									<form method="post" action="<?= route_to('login');?>" class="mt-4">
										<?= csrf_field() ?>
										<div class="mb-3">
											<input type="text" value="<?= old('email')?>" class="form-control form-control-lg" placeholder="Email" name="email" aria-label="Email">
										</div>
										<div class="mb-3">
											<input type="password" class="form-control form-control-lg" placeholder="Password" name="password" aria-label="Password">
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="remember" id="remember">
											<label class="form-check-label" for="remember">Remember me</label>
										</div>
										<div class="text-center">
											<button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
							<div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('<?= base_url('assets/img/illustrations/bg.jpg');?>');background-size: cover;">
								<span class="mask bg-gradient-primary opacity-6"></span>
								
								
							</div>
						</div>
					</div>
				</div>	
			</div>
		</section>
	</main>
	<!-- Core JS Files -->
	<script src="<?= base_url('assets/js/core/popper.min.js');?>"></script>
	<script src="<?= base_url('assets/js/core/bootstrap.min.js');?>"></script>
	<script src="<?= base_url('assets/js/plugins/sweetalert2.js');?>"></script>
	<script>
		<?php if(session()->has('error')):?>
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: '<?= session('error');?>',
			})
		<?php endif;?>
		<?php if(session('errors')): ?>
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Correo o contraseña incorrecto.',
			})
		<?php endif ?>
	</script>
</body>

</html>