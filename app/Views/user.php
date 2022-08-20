<main class="main-content position-relative border-radius-lg" id="user">
	<!-- Navbar -->
	<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" data-scroll="false">
		<div class="container-fluid py-1 px-3">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
					<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white">Paginas</a></li>
					<li class="breadcrumb-item text-sm text-white active" aria-current="page">Usuario</li>
				</ol>
				<h6 class="font-weight-bolder text-white mb-0">Usuario</h6>
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
			<div class="col-lg-12 col-md-12">
				
				<!-- User List -->
				<div class="card mb-4">
					<div class="card-header pb-0">
						<div class="d-lg-flex">
							<div>
								<h5 class="mb-0">Todos los usuarios</h5>
							</div>
							<div class="ms-auto my-auto mt-lg-0 mt-4">
								<div class="ms-auto my-auto">
									<button class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#modalAdd" @click="resetValues"><i class="fa-solid fa-plus"></i> Nuevo</button>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body px-0 pb-0">
						<div class="table-head">
							<select class="form-select" v-model="range" v-on:change="page=1">
								<option value="5">5</option>
								<option value="10">10</option>
								<option value="15">15</option>
							</select>
							<input class="form-control" placeholder="Buscar..." v-model="search" v-on:keypress="page=1"/>
						</div>
						<div class="table-responsive">
							<table class="table align-items-center">
								<thead>
									<tr>
										<th class="text-uppercase text-xs font-weight-bolder opacity-7">Usuario</th>
										<th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">username</th>
										<th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">Email</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(item, index) in rows()">
										<td><img class="ps-3 w-10" :src="item.picture"><span class="text-xs ms-4 font-weight-bold">{{ item.fullname }}</span></td>
										<td><span class="text-xs font-weight-bold">{{ item.username }}</span></td>
										<td><span class="text-xs font-weight-bold">{{ item.email }}</span></td>
										<td class="text-lg pe-5">
											<span type="button" id="options" data-bs-toggle="dropdown"><i class="fa-solid fa-list"></i></span>
											<ul class="dropdown-menu" aria-labelledby="options">
												<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEdit" @click="readUser(index)">Editar</a></li>
												<li><a class="dropdown-item" @click="deleteUser(item.id)">Eliminar</a></li>
											</ul>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="table-pagination" v-if="before > 1">
							<ul>
								<li @click="page=page-1" :class="{ hide: page === 1 }"><</li>
								<li @click="page=page-2" :class="{ hide: page - 2 < 1 }">{{ page-2 }}</li>
								<li @click="page=page-1" :class="{ hide: page - 1 < 1 }">{{ page-1 }}</li>
								<li class="active">{{ page }}</li>
								<li @click="page=page+1" :class="{ hide: page + 1 > before }">{{ page+1 }}</li>
								<li @click="page=page+2" :class="{ hide: page + 2 > before }">{{ page+2 }}</li>
								<li @click="page=page+1" :class="{ hide: page === before }">></li>
							</ul>
						</div>
					</div>
				</div>

				<!-- Modal User Add -->
				<div class="modal fade" ref="modalAdd" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<form @submit.prevent="saveUser">
								<div class="modal-body">

									<div class="row">
										<div class="col-md-12">
											<h4 class="mb-2">Nuevo usuario</h4>
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">Nombre completo</label>
												<input v-model="fullname" class="form-control" type="text" placeholder="Nombre completo" :class="{ 'is-invalid': errors.fullname }">
												<div class="invalid-feedback">{{ errors.fullname }}</div>
											</div>
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">Nombre de usuario</label>
												<input v-model="username" class="form-control" type="text" placeholder="Nombre de usuario" :class="{ 'is-invalid': errors.username }">
												<div class="invalid-feedback">{{ errors.username }}</div>
											</div>
										</div>
										<div class="form-group">
											<label for="example-text-input" class="form-control-label">Email</label>
											<input v-model="email" class="form-control" type="text" placeholder="Email" :class="{ 'is-invalid': errors.email }">
											<div class="invalid-feedback">{{ errors.email }}</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">Contraseña</label>
												<input v-model="password" class="form-control" type="password" placeholder="Contraseña" :class="{ 'is-invalid': errors.password }">
												<div class="invalid-feedback">{{ errors.password }}</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">Confirma la contraseña</label>
												<input v-model="passwordconfirmation" class="form-control" type="password" placeholder="Confirma la contraseña" :class="{ 'is-invalid': errors.passwordconfirmation }">
												<div class="invalid-feedback">{{ errors.passwordconfirmation }}</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">N° Celular / Teléfono</label>
												<input v-model="phonenumber" class="form-control" type="text" placeholder="N° Celular / Teléfono" :class="{ 'is-invalid': errors.phonenumber }">
												<div class="invalid-feedback">{{ errors.phonenumber }}</div>
											</div>
											<div class="button-row d-flex mt-4 mb-2">
												<button class="btn bg-gradient-success ms-auto mb-0" type="submit">Guardar</button>
											</div>
										</div>
									</div>
									
								</div>
							</form>
						</div>
					</div>
				</div>

				<!-- Modal User Edit -->
				<div class="modal fade" ref="modalEdit" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<form @submit.prevent="updateUser">
								<div class="modal-body">

									<div class="row">
										<div class="col-md-12">
											<h4 class="mb-2">Actualizar usuario</h4>
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">Nombre completo</label>
												<input v-model="fullname" class="form-control" type="text" placeholder="Nombre completo" :class="{ 'is-invalid': errors.fullname }">
												<div class="invalid-feedback">{{ errors.fullname }}</div>
											</div>
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">Nombre de usuario</label>
												<input v-model="username" class="form-control" type="text" placeholder="Nombre de usuario" :class="{ 'is-invalid': errors.username }">
												<div class="invalid-feedback">{{ errors.username }}</div>
											</div>
										</div>
										<div class="form-group">
											<label for="example-text-input" class="form-control-label">Email</label>
											<input v-model="email" class="form-control" type="text" placeholder="Email" :class="{ 'is-invalid': errors.email }">
											<div class="invalid-feedback">{{ errors.email }}</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">Contraseña</label>
												<input v-model="password" class="form-control" type="password" placeholder="Contraseña" :class="{ 'is-invalid': errors.password }">
												<div class="invalid-feedback">{{ errors.password }}</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">Confirma la contraseña</label>
												<input v-model="passwordconfirmation" class="form-control" type="password" placeholder="Confirma la contraseña" :class="{ 'is-invalid': errors.passwordconfirmation }">
												<div class="invalid-feedback">{{ errors.passwordconfirmation }}</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">N° Celular / Teléfono</label>
												<input v-model="phonenumber" class="form-control" type="text" placeholder="N° Celular / Teléfono" :class="{ 'is-invalid': errors.phonenumber }">
												<div class="invalid-feedback">{{ errors.phonenumber }}</div>
											</div>
											<div class="button-row d-flex mt-4 mb-2">
												<button class="btn bg-gradient-success ms-auto mb-0" type="submit">Guardar</button>
											</div>
										</div>
									</div>
									
								</div>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>