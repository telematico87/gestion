<main class="main-content position-relative border-radius-lg" id="profile">
	<!-- Navbar -->
	<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" data-scroll="false">
		<div class="container-fluid py-1 px-3">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
					<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Paginas</a></li>
					<li class="breadcrumb-item text-sm text-white active" aria-current="page">Perfil</li>
				</ol>
				<h6 class="font-weight-bolder text-white mb-0">Perfil</h6>
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
							<span class="d-sm-inline d-none me-1">{{ fullname }}</span>
							<img :src="preview" class="profile-img rounded-circle img-fluid border border-2 border-white">
						</a>
						<ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownMenuButton">
							<li><a class="dropdown-item border-radius-md" :href=""><i class="fa-solid fa-user me-1"></i> Ver perfil</a></li>
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
			<div class="col-lg-7 col-md-8">
				<div class="card card-profile">
					<div class="card-header pb-0">
						<div class="d-flex">
							<div class="picture ms-auto me-auto">
								<input type="file" @change="readFile" id="profileFile">
								<label for="profileFile">
									<img :src="preview" class="rounded-circle img-fluid border border-4 border-white">
								</label>
							</div>
						</div>
						<p class="mb-0">Editar perfil</p>
					</div>
					<div class="card-body">
						<form @submit.prevent="saveProfile">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="example-text-input" class="form-control-label">Nombre completo</label>
										<input v-model="fullname" class="form-control" type="text" placeholder="Nombre completo" :class="{ 'is-invalid': errors.fullname }">
										<div class="invalid-feedback">{{ errors.fullname }}</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="example-text-input" class="form-control-label">N° Celular/Teléfono</label>
										<input v-model="phonenumber" class="form-control" type="text" placeholder="N° Celular/Teléfono" :class="{ 'is-invalid': errors.phonenumber }">
										<div class="invalid-feedback">{{ errors.phonenumber }}</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="example-text-input" class="form-control-label">Dirección</label>
										<textarea v-model="address" class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Dirección (opcional)" :class="{ 'is-invalid': errors.address }"></textarea>
										<div class="invalid-feedback">{{ errors.address }}</div>
									</div>
									<div class="button-row d-flex mt-4 mb-2">
										<button class="btn bg-gradient-success ms-auto mb-0" type="submit">Guardar</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>