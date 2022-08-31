<main class="main-content position-relative border-radius-lg" id="client">
	<!-- Navbar -->
	<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" data-scroll="false">
		<div class="container-fluid py-1 px-3">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
					<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white">Paginas</a></li>
					<li class="breadcrumb-item text-sm text-white active" aria-current="page">Cliente</li>
				</ol>
				<h6 class="font-weight-bolder text-white mb-0">Cliente</h6>
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
				
				<!-- Client List -->
				<div class="card mb-4">
					<div class="card-header pb-0">
						<div class="d-lg-flex">
							<div>
								<h5 class="mb-0">Todos los clientes</h5>
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
										<th class="text-uppercase text-xs font-weight-bolder opacity-7">Cliente</th>
										<th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">T. Documento</th>
										<th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">N° Documento</th>
										<th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">Cel/Tel</th>
										<th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">Email</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(item, index) in rows()">
										<td class="px-4 text-xs font-weight-bold" width="20%">{{ item.name }}</td>
										<td width="15%"><span class="text-xs font-weight-bold">{{ item.type_document }}</span></td>
										<td width="15%"><span class="text-xs font-weight-bold">{{ item.num_document }}</span></td>
										<td width="15%"><span class="text-xs font-weight-bold">{{ item.phone_number }}</span></td>
										<td><span class="text-xs font-weight-bold">{{ item.email_notification }}</span></td>
										<td class="text-lg" width="6%">
											<span type="button" id="options" data-bs-toggle="dropdown"><i class="fa-solid fa-list"></i></span>
											<ul class="dropdown-menu" aria-labelledby="options">
												<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEdit" @click="readClient(index)">Editar</a></li>
												<li><a class="dropdown-item" @click="deleteClient(item.id)">Eliminar</a></li>
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

				<!-- Modal Client Add -->
				<div class="modal fade bd-example-modal-lg" ref="modalAdd" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
						<div class="modal-content">
							<form @submit.prevent="saveClient">
								<div class="modal-body">

									<div class="row">
										
											<h4 class="mb-2-centered" >Nuevo cliente</h4>
											<h6 class="card-subtitle mb-2 text-muted">Pertenencia</h6>
											<div class="col-md-4">
												<div class="form-group">
													<label>Responsable</label>
													<select class="form-select" v-model="responsible" :class="{ 'is-invalid': errors.responsible }">
														<option disabled value="">Selecione</option>
														<option value="AMED">Amed</option>
														<option value="KAREN">Karen</option>
														<option value="YUSEPI">Yusepi</option>
													</select>
													<div class="invalid-feedback">{{ errors.responsible }}</div>
												</div>
											</div>	
											<h6 class="card-subtitle mb-2 text-muted">Datos del Servicio</h6>
											
											<div class="col-md-4">
											<div class="form-group">
												<label>T. Operador</label>
												<select class="form-select" v-model="type_operator" :class="{ 'is-invalid': errors.type_operator }">
													<option disabled value="">Selecione</option>
													<option value="MOV">Movistar</option>
													<option value="ENT">Entel</option>
													<option value="BIT">Bitel</option>
												</select>
												<div class="invalid-feedback">{{ errors.type_operator }}</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>T. Servicio</label>
												<select class="form-select" v-model="type_service" :class="{ 'is-invalid': errors.type_service }">
													<option disabled value="">Selecione</option>
													<option value="MOV">Móvil</option>
													<option value="HOG">Hogar</option>
												</select>
												<div class="invalid-feedback">{{ errors.type_service }}</div>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">N° Celular / Teléfono</label>
												<input v-model="phone_number" class="form-control" type="text" placeholder="N° Celular / Teléfono" :class="{ 'is-invalid': errors.phone_number }">
												<div class="invalid-feedback">{{ errors.phone_number }}</div>
											</div>
										</div>

										<div class="col-md-6">	
											<div class="form-group">
													<label for="example-text-input" class="form-control-label">Cuenta financiera</label>
													<input v-model="financial_account" class="form-control" type="text" placeholder="Cuenta financiera" :class="{ 'is-invalid': errors.financial_account }">
													<div class="invalid-feedback">{{ errors.financial_account }}</div>
												</div>
										</div>

										<div class="col-md-6">	
											<div class="form-group">
													<label for="example-text-input" class="form-control-label">Dirección Instalación</label>
													<input v-model="address_install" class="form-control" type="text" placeholder="Dirección Instalación" :class="{ 'is-invalid': errors.address-install }">
													<div class="invalid-feedback">{{ errors.address-install }}</div>
												</div>
										</div>
										<h6 class="card-subtitle mb-2 text-muted">Datos del cliente</h6>
											<div class="col-md-3">
												<div class="form-group">
													<label>T. Persona</label>
													<select class="form-select" v-model="type_person" :class="{ 'is-invalid': errors.type_person }">
														<option disabled value="">Selecione</option>
														<option value="NAT">Natural</option>
														<option value="JUR">Juridica</option>
													</select>
													<div class="invalid-feedback">{{ errors.type_person }}</div>
												</div>
											</div>	
											<div class="col-md-4">
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">Prenombres</label>
													<input v-model="name" class="form-control" type="text" placeholder="Prenombres" :class="{ 'is-invalid': errors.name }">
													<div class="invalid-feedback">{{ errors.name }}</div>
												</div>
											</div>	

											<div class="col-md-5">
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">Razón Social</label>
													<input v-model="bussines_name" class="form-control" type="text" placeholder="Prenombres" :class="{ 'is-invalid': errors.bussines_name }">
													<div class="invalid-feedback">{{ errors.bussines_name }}</div>
												</div>
											</div>	
											<div class="col-md-4">
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">Apellido Paterno</label>
													<input v-model="apellido_paterno" class="form-control" type="text" placeholder="Apellido Paterno" :class="{ 'is-invalid': errors.apellido_paterno }">
													<div class="invalid-feedback">{{ errors.apellido_paterno }}</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">Apellido Materno</label>
													<input v-model="apellido_materno" class="form-control" type="text" placeholder="Apellido Materno" :class="{ 'is-invalid': errors.apellido_materno }">
													<div class="invalid-feedback">{{ errors.apellido_materno }}</div>
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">Representante</label>
													<input v-model="representante" class="form-control" type="text" placeholder="Representante" :class="{ 'is-invalid': errors.representante }">
													<div class="invalid-feedback">{{ errors.representante }}</div>
												</div>
											</div>

											<div class="col-md-6">
											
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">Dni Representante</label>
												<input v-model="dni_representante" class="form-control" type="text" placeholder="Dni Representante" :class="{ 'is-invalid': errors.dni_representante }">
												<div class="invalid-feedback">{{ errors.dni_representante }}</div>
											</div>
										</div>

										
										<div class="col-md-2">
											<div class="form-group">
												<label>T. Documento</label>
												<select class="form-select" v-model="type_document" :class="{ 'is-invalid': errors.type_document }">
													<option disabled value="">Selecione</option>
													<option value="DNI">DNI</option>
													<option value="RUC">RUC</option>
													<option value="PAS">PASAPORTE</option>
												</select>
												<div class="invalid-feedback">{{ errors.type_document }}</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">N° Documento</label>
												<input v-model="num_document" class="form-control" type="text" placeholder="N° Documento" :class="{ 'is-invalid': errors.num_document }">
												<div class="invalid-feedback">{{ errors.num_document }}</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="exampleFormControlTextarea1">Direccion Real/Fiscal</label>
												<textarea v-model="address_rf" class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Direccion" :class="{ 'is-invalid': errors.address_rf }"></textarea>
												<div class="invalid-feedback">{{ errors.address_rf }}</div>
											</div>
										</div>

										<div class="col-md-4">
											
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">F. Nacimiento</label>
												<input v-model="fecha-nacimiento" class="form-control" type="date" placeholder="F. Nacimiento" :class="{ 'is-invalid': errors.fecha-nacimiento }">
												<div class="invalid-feedback">{{ errors.fecha-nacimiento }}</div>
											</div>
										</div>

										<div class="col-md-8">
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">Lugar de Nacimiento</label>
												<input v-model="place_birth" class="form-control" type="text" placeholder="Lugar de Nacimiento" :class="{ 'is-invalid': errors.place-birth }">
												<div class="invalid-feedback">{{ errors.place-birth }}</div>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">Madre</label>
												<input v-model="madre" class="form-control" type="text" placeholder="Madre" :class="{ 'is-invalid': errors.madre }">
												<div class="invalid-feedback">{{ errors.madre }}</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">Padre</label>
												<input v-model="padre" class="form-control" type="text" placeholder="Padre" :class="{ 'is-invalid': errors.padre }">
												<div class="invalid-feedback">{{ errors.padre }}</div>
											</div>
										</div>
										
									
												
											<div class="col-md-4">
									
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">F. Emision Dni</label>
													<input v-model="fecha_emision" class="form-control" type="date" placeholder="F. Emision" :class="{ 'is-invalid': errors.fecha_emision }">
													<div class="invalid-feedback">{{ errors.fecha_emision }}</div>
												</div>
											</div>

											<div class="col-md-4">
										
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">F. Vencimiento  Dni</label>
													<input v-model="fecha_vencimiento" class="form-control" type="date" placeholder="F. vencimiento" :class="{ 'is-invalid': errors.fecha_vencimiento }">
													<div class="invalid-feedback">{{ errors.fecha_vencimiento }}</div>
												</div>
											</div>

											<div class="col-md-4">
									
									<div class="form-group">
										<label for="example-text-input" class="form-control-label">Departamento</label>
										<input v-model="deparment" class="form-control" type="text" placeholder="Departamento" :class="{ 'is-invalid': errors.deparment }">
										<div class="invalid-feedback">{{ errors.deparment }}</div>
									</div>
								</div>
								
								<div class="col-md-4">
									
									<div class="form-group">
										<label for="example-text-input" class="form-control-label">Provincia</label>
										<input v-model="province" class="form-control" type="text" placeholder="Provincia" :class="{ 'is-invalid': errors.province }">
										<div class="invalid-feedback">{{ errors.province }}</div>
									</div>
								</div>


								<div class="col-md-4">
									
									<div class="form-group">
										<label for="example-text-input" class="form-control-label">Distrito</label>
										<input v-model="district" class="form-control" type="text" placeholder="Distrito" :class="{ 'is-invalid': errors.district }">
										<div class="invalid-feedback">{{ errors.district }}</div>
									</div>
								</div>		

										
											<h6 class="card-subtitle mb-2 text-muted">Datos del contacto</h6>
											
											<div class="col-md-6">
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">Persona Recomienda</label>
													<input v-model="recomienda" class="form-control" type="text" placeholder="Persona Recomienda" :class="{ 'is-invalid': errors.recomienda }">
													<div class="invalid-feedback">{{ errors.recomienda }}</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">Celular</label>
													<input v-model="contact_phone" class="form-control" type="text" placeholder="Celular" :class="{ 'is-invalid': errors.contact_phone }">
													<div class="invalid-feedback">{{ errors.contact_phone }}</div>
												</div>
											</div>
											
											<h6 class="card-subtitle mb-2 text-muted">Datos de Notificación</h6>
											<div class="col-md-4">	
													<div class="form-group">
															<label for="example-text-input" class="form-control-label">Correo</label>
															<input v-model="email_notification" class="form-control" type="text" placeholder="Email" :class="{ 'is-invalid': errors.email_notification }">
															<div class="invalid-feedback">{{ errors.email_notification }}</div>
														</div>
												</div>
																				

												<div class="col-md-6">
													<div class="form-group">
														<label for="exampleFormControlTextarea1">Dirección Notifición</label>
														<textarea v-model="address_notification" class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Dirección Notifición" :class="{ 'is-invalid': errors.address_notification }"></textarea>
														<div class="invalid-feedback">{{ errors.address_notification }}</div>
													</div>
												</div>

												<h6 class="card-subtitle mb-2 text-muted">Datos de Facturación</h6>
														<div class="col-md-6">
															<div class="form-group">
																<label>Ciclo</label>
																<select class="form-select" v-model="cycle" :class="{ 'is-invalid': errors.cycle }">
																	<option disabled value="">Selecione</option>
																	<option value="1">Ciclo 1</option>
																	<option value="2">Ciclo 2</option>
																	<option value="6">Ciclo 6</option>
																	<option value="16">Ciclo 16</option>
																	<option value="18">Ciclo 18</option>
																	<option value="19">Ciclo 19</option>
																	<option value="24">Ciclo 24</option>
																</select>
																<div class="invalid-feedback">{{ errors.cycle }}</div>
															</div>
														</div>

														<div class="col-md-4">
									
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">F. Emision </label>
													<input v-model="fecha_emision_facturacion" class="form-control" type="date" placeholder="F. Emision" :class="{ 'is-invalid': errors.fecha-emision-facturacion }">
													<div class="invalid-feedback">{{ errors.fecha_emision_facturacion }}</div>
												</div>
											</div>

											<div class="col-md-4">
										
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">F. Vencimiento </label>
													<input v-model="fecha_vencimiento_facturacion" class="form-control" type="date" placeholder="F. vencimiento" :class="{ 'is-invalid': errors.fecha-vencimiento-facturacion }">
													<div class="invalid-feedback">{{ errors.fecha_vencimiento_facturacion }}</div>
												</div>
											</div>

								
											
										<div class="col-md-6">
											<div class="form-group">
												<label for="exampleFormControlTextarea1">Dirección Facturación</label>
												<textarea v-model="address_billing" class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Dirección Facturación" :class="{ 'is-invalid': errors.address_billing }"></textarea>
												<div class="invalid-feedback">{{ errors.address_billing }}</div>
											</div>
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

				<!-- Modal Client Add -->
				<div class="modal fade bd-example-modal-lg" ref="modalEdit" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
						<div class="modal-content">
							<form @submit.prevent="updateClient">
							<div class="modal-body">

									<div class="row">
										
											<h4 class="mb-2">Actualizar cliente</h4>
											<h6 class="card-subtitle mb-2 text-muted">Pertenencia</h6>
											<div class="col-md-4">
												<div class="form-group">
													<label>Responsable</label>
													<select class="form-select" v-model="responsible" :class="{ 'is-invalid': errors.responsible }">
														<option disabled value="">Selecione</option>
														<option value="AMED">Amed</option>
														<option value="KAREN">Karen</option>
														<option value="YUSEPI">Yusepi</option>
													</select>
													<div class="invalid-feedback">{{ errors.responsible }}</div>
												</div>
											</div>	
											<h6 class="card-subtitle mb-2 text-muted">Datos del Servicio</h6>
											
											<div class="col-md-4">
											<div class="form-group">
												<label>T. Operador</label>
												<select class="form-select" v-model="type_operator" :class="{ 'is-invalid': errors.type_operator }">
													<option disabled value="">Selecione</option>
													<option value="MOV">Movistar</option>
													<option value="ENT">Entel</option>
													<option value="BIT">Bitel</option>
												</select>
												<div class="invalid-feedback">{{ errors.type_operator }}</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>T. Servicio</label>
												<select class="form-select" v-model="type_service" :class="{ 'is-invalid': errors.type_service }">
													<option disabled value="">Selecione</option>
													<option value="MOV">Móvil</option>
													<option value="HOG">Hogar</option>
												</select>
												<div class="invalid-feedback">{{ errors.type_service }}</div>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">N° Celular / Teléfono</label>
												<input v-model="phone_number" class="form-control" type="text" placeholder="N° Celular / Teléfono" :class="{ 'is-invalid': errors.phone_number }">
												<div class="invalid-feedback">{{ errors.phone_number }}</div>
											</div>
										</div>

										<div class="col-md-6">	
											<div class="form-group">
													<label for="example-text-input" class="form-control-label">Cuenta financiera</label>
													<input v-model="financial_account" class="form-control" type="text" placeholder="Cuenta financiera" :class="{ 'is-invalid': errors.financial_account }">
													<div class="invalid-feedback">{{ errors.financial_account }}</div>
												</div>
										</div>

										<div class="col-md-6">	
											<div class="form-group">
													<label for="example-text-input" class="form-control-label">Dirección Instalación</label>
													<input v-model="address_install" class="form-control" type="text" placeholder="Dirección Instalación" :class="{ 'is-invalid': errors.address-install }">
													<div class="invalid-feedback">{{ errors.address-install }}</div>
												</div>
										</div>
										<h6 class="card-subtitle mb-2 text-muted">Datos del cliente</h6>
											<div class="col-md-3">
												<div class="form-group">
													<label>T. Persona</label>
													<select class="form-select" v-model="type_person" :class="{ 'is-invalid': errors.type_person }">
														<option disabled value="">Selecione</option>
														<option value="NAT">Natural</option>
														<option value="JUR">Juridica</option>
													</select>
													<div class="invalid-feedback">{{ errors.type_person }}</div>
												</div>
											</div>	
											<div class="col-md-4">
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">Prenombres</label>
													<input v-model="name" class="form-control" type="text" placeholder="Prenombres" :class="{ 'is-invalid': errors.name }">
													<div class="invalid-feedback">{{ errors.name }}</div>
												</div>
											</div>	

											<div class="col-md-5">
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">Razón Social</label>
													<input v-model="bussines_name" class="form-control" type="text" placeholder="Prenombres" :class="{ 'is-invalid': errors.bussines_name }">
													<div class="invalid-feedback">{{ errors.bussines_name }}</div>
												</div>
											</div>	
											<div class="col-md-4">
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">Apellido Paterno</label>
													<input v-model="apellido_paterno" class="form-control" type="text" placeholder="Apellido Paterno" :class="{ 'is-invalid': errors.apellido_paterno }">
													<div class="invalid-feedback">{{ errors.apellido_paterno }}</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">Apellido Materno</label>
													<input v-model="apellido_materno" class="form-control" type="text" placeholder="Apellido Materno" :class="{ 'is-invalid': errors.apellido_materno }">
													<div class="invalid-feedback">{{ errors.apellido_materno }}</div>
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">Representante</label>
													<input v-model="representante" class="form-control" type="text" placeholder="Representante" :class="{ 'is-invalid': errors.representante }">
													<div class="invalid-feedback">{{ errors.representante }}</div>
												</div>
											</div>

											<div class="col-md-6">
											
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">Dni Representante</label>
												<input v-model="dni_representante" class="form-control" type="text" placeholder="Dni Representante" :class="{ 'is-invalid': errors.dni_representante }">
												<div class="invalid-feedback">{{ errors.dni_representante }}</div>
											</div>
										</div>

										
										<div class="col-md-2">
											<div class="form-group">
												<label>T. Documento</label>
												<select class="form-select" v-model="type_document" :class="{ 'is-invalid': errors.type_document }">
													<option disabled value="">Selecione</option>
													<option value="DNI">DNI</option>
													<option value="RUC">RUC</option>
													<option value="PAS">PASAPORTE</option>
												</select>
												<div class="invalid-feedback">{{ errors.type_document }}</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">N° Documento</label>
												<input v-model="num_document" class="form-control" type="text" placeholder="N° Documento" :class="{ 'is-invalid': errors.num_document }">
												<div class="invalid-feedback">{{ errors.num_document }}</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="exampleFormControlTextarea1">Direccion Real/Fiscal</label>
												<textarea v-model="address_rf" class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Direccion" :class="{ 'is-invalid': errors.address_rf }"></textarea>
												<div class="invalid-feedback">{{ errors.address_rf }}</div>
											</div>
										</div>

										<div class="col-md-4">
											
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">F. Nacimiento</label>
												<input v-model="fecha-nacimiento" class="form-control" type="date" placeholder="F. Nacimiento" :class="{ 'is-invalid': errors.fecha-nacimiento }">
												<div class="invalid-feedback">{{ errors.fecha-nacimiento }}</div>
											</div>
										</div>

										<div class="col-md-8">
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">Lugar de Nacimiento</label>
												<input v-model="place_birth" class="form-control" type="text" placeholder="Lugar de Nacimiento" :class="{ 'is-invalid': errors.place-birth }">
												<div class="invalid-feedback">{{ errors.place-birth }}</div>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">Madre</label>
												<input v-model="madre" class="form-control" type="text" placeholder="Madre" :class="{ 'is-invalid': errors.madre }">
												<div class="invalid-feedback">{{ errors.madre }}</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="example-text-input" class="form-control-label">Padre</label>
												<input v-model="padre" class="form-control" type="text" placeholder="Padre" :class="{ 'is-invalid': errors.padre }">
												<div class="invalid-feedback">{{ errors.padre }}</div>
											</div>
										</div>
										

												
											<div class="col-md-4">

												<div class="form-group">
													<label for="example-text-input" class="form-control-label">F. Emision Dni</label>
													<input v-model="fecha_emision" class="form-control" type="date" placeholder="F. Emision" :class="{ 'is-invalid': errors.fecha_emision }">
													<div class="invalid-feedback">{{ errors.fecha_emision }}</div>
												</div>
											</div>

											<div class="col-md-4">
										
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">F. Vencimiento  Dni</label>
													<input v-model="fecha_vencimiento" class="form-control" type="date" placeholder="F. vencimiento" :class="{ 'is-invalid': errors.fecha_vencimiento }">
													<div class="invalid-feedback">{{ errors.fecha_vencimiento }}</div>
												</div>
											</div>

											<div class="col-md-4">

									<div class="form-group">
										<label for="example-text-input" class="form-control-label">Departamento</label>
										<input v-model="deparment" class="form-control" type="text" placeholder="Departamento" :class="{ 'is-invalid': errors.deparment }">
										<div class="invalid-feedback">{{ errors.deparment }}</div>
									</div>
									</div>

									<div class="col-md-4">

									<div class="form-group">
										<label for="example-text-input" class="form-control-label">Provincia</label>
										<input v-model="province" class="form-control" type="text" placeholder="Provincia" :class="{ 'is-invalid': errors.province }">
										<div class="invalid-feedback">{{ errors.province }}</div>
									</div>
									</div>


									<div class="col-md-4">

									<div class="form-group">
										<label for="example-text-input" class="form-control-label">Distrito</label>
										<input v-model="district" class="form-control" type="text" placeholder="Distrito" :class="{ 'is-invalid': errors.district }">
										<div class="invalid-feedback">{{ errors.district }}</div>
									</div>
									</div>		

										
											<h6 class="card-subtitle mb-2 text-muted">Datos del contacto</h6>
											
											<div class="col-md-6">
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">Persona Recomienda</label>
													<input v-model="recomienda" class="form-control" type="text" placeholder="Persona Recomienda" :class="{ 'is-invalid': errors.recomienda }">
													<div class="invalid-feedback">{{ errors.recomienda }}</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">Celular</label>
													<input v-model="contact_phone" class="form-control" type="text" placeholder="Celular" :class="{ 'is-invalid': errors.contact_phone }">
													<div class="invalid-feedback">{{ errors.contact_phone }}</div>
												</div>
											</div>
											
											<h6 class="card-subtitle mb-2 text-muted">Datos de Notificación</h6>
											<div class="col-md-4">	
													<div class="form-group">
															<label for="example-text-input" class="form-control-label">Correo</label>
															<input v-model="email_notification" class="form-control" type="text" placeholder="Email" :class="{ 'is-invalid': errors.email_notification }">
															<div class="invalid-feedback">{{ errors.email_notification }}</div>
														</div>
												</div>
																				

												<div class="col-md-6">
													<div class="form-group">
														<label for="exampleFormControlTextarea1">Dirección Notifición</label>
														<textarea v-model="address_notification" class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Dirección Notifición" :class="{ 'is-invalid': errors.address_notification }"></textarea>
														<div class="invalid-feedback">{{ errors.address_notification }}</div>
													</div>
												</div>

												<h6 class="card-subtitle mb-2 text-muted">Datos de Facturación</h6>
														<div class="col-md-6">
															<div class="form-group">
																<label>Ciclo</label>
																<select class="form-select" v-model="cycle" :class="{ 'is-invalid': errors.cycle }">
																	<option disabled value="">Selecione</option>
																	<option value="1">Ciclo 1</option>
																	<option value="2">Ciclo 2</option>
																	<option value="6">Ciclo 6</option>
																	<option value="16">Ciclo 16</option>
																	<option value="18">Ciclo 18</option>
																	<option value="19">Ciclo 19</option>
																	<option value="24">Ciclo 24</option>
																</select>
																<div class="invalid-feedback">{{ errors.cycle }}</div>
															</div>
														</div>

														<div class="col-md-4">

												<div class="form-group">
													<label for="example-text-input" class="form-control-label">F. Emision </label>
													<input v-model="fecha_emision_facturacion" class="form-control" type="date" placeholder="F. Emision" :class="{ 'is-invalid': errors.fecha-emision-facturacion }">
													<div class="invalid-feedback">{{ errors.fecha_emision_facturacion }}</div>
												</div>
											</div>

											<div class="col-md-4">
										
												<div class="form-group">
													<label for="example-text-input" class="form-control-label">F. Vencimiento </label>
													<input v-model="fecha_vencimiento_facturacion" class="form-control" type="date" placeholder="F. vencimiento" :class="{ 'is-invalid': errors.fecha-vencimiento-facturacion }">
													<div class="invalid-feedback">{{ errors.fecha_vencimiento_facturacion }}</div>
												</div>
											</div>


											
										<div class="col-md-6">
											<div class="form-group">
												<label for="exampleFormControlTextarea1">Dirección Facturación</label>
												<textarea v-model="address_billing" class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Dirección Facturación" :class="{ 'is-invalid': errors.address_billing }"></textarea>
												<div class="invalid-feedback">{{ errors.address_billing }}</div>
											</div>
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
		</div>