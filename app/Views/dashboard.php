<main class="main-content position-relative border-radius-lg" id="dashboard">
	<!-- Navbar -->
	<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" data-scroll="false">
		<div class="container-fluid py-1 px-3">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
					<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white">Paginas</a></li>
					<li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
				</ol>
				<h6 class="font-weight-bolder text-white mb-0">Dashboard</h6>
			</nav>
			<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4">
				<div class="ms-md-auto pe-md-3 d-flex align-items-center">
					<div class="input-group-search">
						<span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
						<input type="text" class="form-control" placeholder="Buscar...">
					</div>
				</div>
				<ul class="navbar-nav justify-content-end">
					<li class="nav-item dropdown auth-dropdown px-3 d-flex align-items-center">
						<a class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
							<span class="d-sm-inline d-none me-1"><?= auth()->user()->full_name;?></span>
							<img src="<?= auth()->user()->picture;?>" class="profile-img rounded-circle img-fluid border border-2 border-white">
						</a>
						<ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownMenuButton">
							<li><a class="dropdown-item border-radius-md" href="<?= base_url('perfil');?>"><i class="fa-solid fa-user me-1"></i> Ver perfil</a></li>
							<form method="POST" action="<?= route_to('logout');?>">
								<li><button class="dropdown-item border-radius-md" type="submit"><i class="fa-solid fa-right-from-bracket me-1"></i> Cerrar sessión</button></li>
							</form>
						</ul>
					</li>
					<li class="nav-item d-xl-none ps-0 d-flex align-items-center">
						<a class="nav-link text-white p-0" onclick="toggleSidenav()">
							<div class="sidenav-toggler-inner">
								<i class="sidenav-toggler-line bg-white"></i>
								<i class="sidenav-toggler-line bg-white"></i>
								<i class="sidenav-toggler-line bg-white"></i>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- End Navbar -->
	<div class="container-fluid py-4">
		<div class="row">
			<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
				<div class="card">
					<div class="card-body p-3">
						<div class="row">
							<div class="col-8">
								<div class="numbers">
									<p class="text-sm mb-0 text-uppercase font-weight-bold">Proveedores</p>
									<h5 class="font-weight-bolder"><?= $supplier;?></h5>
								</div>
							</div>
							<div class="col-4 text-end">
								<div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
									<i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
								</div>
							</div>
							<div class="col-12">
								<p class="mb-0">Desde siempre</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
				<div class="card">
					<div class="card-body p-3">
						<div class="row">
							<div class="col-8">
								<div class="numbers">
									<p class="text-sm mb-0 text-uppercase font-weight-bold">Productos</p>
									<h5 class="font-weight-bolder"><?= $product;?></h5>
								</div>
							</div>
							<div class="col-4 text-end">
								<div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
									<i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
								</div>
							</div>
							<div class="col-12">
								<p class="mb-0">Desde siempre</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
				<div class="card">
					<div class="card-body p-3">
						<div class="row">
							<div class="col-8">
								<div class="numbers">
									<p class="text-sm mb-0 text-uppercase font-weight-bold">Clientes</p>
									<h5 class="font-weight-bolder"><?= $client;?></h5>
								</div>
							</div>
							<div class="col-4 text-end">
								<div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
									<i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
								</div>
							</div>
							<div class="col-12">
								<p class="mb-0">Desde siempre</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6">
				<div class="card">
					<div class="card-body p-3">
						<div class="row">
							<div class="col-8">
								<div class="numbers">
									<p class="text-sm mb-0 text-uppercase font-weight-bold">Ventas</p>
									<h5 class="font-weight-bolder"><i class="fa-solid fa-dollar-sign h5 mb-0"></i><?= number_format($sale->totalselling, 2);?></h5>
								</div>
							</div>
							<div class="col-4 text-end">
								<div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
									<i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
								</div>
							</div>
							<div class="col-12">
								<p class="mb-0">Desde siempre</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-4 mb-4">
			<div class="col-lg-7 mb-lg-0 mb-4">
				<div class="card z-index-2 h-100">
					<div class="card-header pb-0 pt-3 bg-transparent">
						<div class="d-md-flex">
							<h6 class="text">Resumen de ventas</h6>
							<dvi class="ms-auto">
								<div class="dropdown">
									<button class="btn bg-gradient-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">{{ year }}</button>
									<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
										<li v-for="item in years"><a class="dropdown-item" @click="year = item.year, graphChart()">{{ item.year }}</a></li>
									</ul>
								</div>
							</dvi>
						</div>
					</div>
					<div class="card-body p-3">
						<div class="chart">
							<canvas ref="chartline" class="chart-canvas" height="300" id="chartline"></canvas>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-5 col-md-12 mt-4 mt-lg-0">
				<div class="card h-100">
					<div class="card-header pb-0 p-3">
						<div class="d-flex align-items-center">
							<h6 class="mb-0">Ventas de la semana</h6>
							<div class="d-flex justify-content-center ms-auto">
								<i class="fa-solid fa-business-time h4"></i>
							</div>
						</div>
					</div>
					<div class="card-body p-3">
						<div class="row">
							<div class="col-lg-12 col-12">
								<div v-for="(item, index) in salesweekamounts" class="d-flex px-2 py-2 pt-1">
									<div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center"><i class="fa-solid fa-calendar text-white opacity-10"></i></div>
									<div class="d-flex flex-column justify-content-center"><h6 class="mb-0 text-sm">{{ salesweeknames[index] }}</h6></div>
									<div class="ms-auto"><span class="text-xs font-weight-bold"><i class="fa-solid fa-dollar-sign"></i>{{ item.toFixed(2) }}</span></div>
								</div>
							</div>
						</div>
					</div>
          		</div>
        	</div>

		</div>