	<script>

		var app = Vue.createApp({
			data() {
				return {
					// For Table
					clients: <?= @$clients;?>,
					range: 5,
    				page: 1,
					search: '',
					before: 0,
					// For Form
					id: null,
					name: null,
					madre:null,
					padre:null,
					phone_number:'',
					type_document: '',
					type_person: '',
					type_service: '',
					type_operator: '',
					responsible:'',
					financial_account:'',
					address_install:'',
					bussines_name:'',
					cycle:'',
					numdocument: null,
					phonenumber: null,
					email: null,
					address: null,
					errors: { name: null, typedocument: null, numdocument: null, phonenumber: null, email: null, address: null }
				}
			},
			methods: {
				readClients() {
					axios
						.get('<?= base_url("Client/getData");?>')
						.then(response => (this.clients = response.data))
				},
				readClient(index) {
					console.log(this.rows()[index]);
					
					this.id = this.rows()[index].id
					this.name = this.rows()[index].name
					this.type_document = this.rows()[index].type_document
					this.num_document = this.rows()[index].num_document
					this.phone_number = this.rows()[index].phone_number
					this.email = this.rows()[index].email
					this.address = this.rows()[index].address
					this.responsible = this.rows()[index].responsible
					this.type_operator = this.rows()[index].type_operator
					this.type_service = this.rows()[index].type_service
					this.address_install = this.rows()[index].address_install
					this.representante = this.rows()[index].representante
					this.fecha_nacimiento = this.rows()[index].fecha_nacimiento
					this.place_birth = this.rows()[index].place_birth
					this.madre = this.rows()[index].madre
					this.padre = this.rows()[index].padre
					this.bussines_name = this.rows()[index].bussines_name
					this.fecha_emision = this.rows()[index].fecha_emision
					this.department = this.rows()[index].department
					this.province = this.rows()[index].province

					this.district = this.rows()[index].district
					this.recomienda = this.rows()[index].recomienda
					this.contact_phone = this.rows()[index].contact_phone
					this.email_notification = this.rows()[index].email_notification
					this.address_notification = this.rows()[index].address_notification

					this.fecha_emision_facturacion = this.rows()[index].fecha_emision_facturacion
					this.fecha_vencimiento_facturacion = this.rows()[index].fecha_vencimiento_facturacion
					this.address_billing = this.rows()[index].address_billing
					this.address_rf = this.rows()[index].address_rf
					this.cycle = this.rows()[index].cycle

					this.errors = { name: null, type_document: null, num_document: null, phone_number: null, email: null, address: null }
				},
				saveClient() {
					axios.post('<?= base_url("Client/save");?>', {
						name: this.name,
						type_document: this.type_document,
						num_document: this.num_document,
						phone_number: this.phone_number,
						email: this.email,
						address: this.address,
					
						responsible: this.responsible,
						type_operator: this.type_operator,
						type_service: this.type_service,
						address_install: this.address_install,
						representante: this.representante,
						dni_representante: this.dni_representante,
						fecha_nacimiento: this.fecha_nacimiento,
						place_birth: this.place_birth,
						madre: this.madre,
						padre: this.padre,
						bussines_name:this.bussines_name,
						fecha_emision: this.fecha_emision,
						department: this.department,
						province: this.province,
						district: this.district,
						recomienda: this.recomienda,	
						contact_phone: this.contact_phone,	
						email_notification: this.email_notification,
						address_notification: this.address_notification,	
						fecha_emision_facturacion: this.fecha_emision_facturacion,		
						fecha_vencimiento_facturacion: this.fecha_vencimiento_facturacion,	
						address_billing: this.address_billing,
						address_rf: this.address_rf,
						
						cycle: this.cycle,	
						
						

					}).then(response => {

						if(response.data.type == 'success'){

							bootstrap.Modal.getInstance(this.$refs.modalAdd).hide();
							this.readClients()
							
							Swal.fire({
								position: 'top-end',
								icon: response.data.type,
								title: response.data.type,
								text: response.data.message,
								showConfirmButton: false,
								timer: 3500
							})

						} else {
							this.errors.name = response.data.name
							this.errors.typedocument = response.data.typedocument
							this.errors.numdocument = response.data.numdocument
							this.errors.phonenumber = response.data.phonenumber
							this.errors.email = response.data.email
							this.errors.address = response.data.address
						}

					})
				},
				updateClient() {
					axios.post('<?= base_url("Client/update");?>', {
						id: this.id,	
						name: this.name,
						type_document: this.type_document,
						num_document: this.num_document,
						phone_number: this.phone_number,
						email: this.email,
						address: this.address,
					
						responsible: this.responsible,
						type_operator: this.type_operator,
						type_service: this.type_service,
						address_install: this.address_install,
						representante: this.representante,
						dni_representante: this.dni_representante,
						fecha_nacimiento: this.fecha_nacimiento,
						place_birth: this.place_birth,
						madre: this.madre,
						padre: this.padre,
						bussines_name:this.bussines_name,
						fecha_emision: this.fecha_emision,
						department: this.department,
						province: this.province,
						district: this.district,
						recomienda: this.recomienda,	
						contact_phone: this.contact_phone,	
						email_notification: this.email_notification,
						address_notification: this.address_notification,	
						fecha_emision_facturacion: this.fecha_emision_facturacion,		
						fecha_vencimiento_facturacion: this.fecha_vencimiento_facturacion,	
						address_billing: this.address_billing,
						address_rf: this.address_rf,
						
						cycle: this.cycle,	
					}).then(response => {
						if(response.data.type == 'success'){

							bootstrap.Modal.getInstance(this.$refs.modalEdit).hide();
							this.readClients()

							Swal.fire({
								position: 'top-end',
								icon: response.data.type,
								title: response.data.type,
								text: response.data.message,
								showConfirmButton: false,
								timer: 3500
							})

						} else {
							this.errors.name = response.data.name
							this.errors.type_document = response.data.typedocument
							this.errors.num_document = response.data.numdocument
							this.errors.phone_number = response.data.phonenumber
							this.errors.email = response.data.email
							this.errors.address = response.data.address
						}
					})
				},
				deleteClient(id) {
					axios.post('<?= base_url("Client/delete");?>', {
						id: id,
					}).then(response => {
						this.readClients()
						Swal.fire({
							position: 'top-end',
							icon: response.data.type,
							title: response.data.type,
							text: response.data.message,
							showConfirmButton: false,
							timer: 3500
						})
					})
				},
				resetValues() {
					this.name = null
					this.typedocument = ''
					this.numdocument = null
					this.phonenumber = null
					this.email = null
					this.address = null
					this.errors = { name: null, typedocument: null, numdocument: null, phonenumber: null, email: null, address: null }
				},
				rows() {
					values = this.clients.filter(item => {
						let props= Object.values(item);
						return props.some(prop => prop==null ? null : prop.toLowerCase().includes(this.search.toLowerCase()))
					})

					range = this.range
					offset = range * (this.page - 1)
					this.before = Math.ceil(values.length / range)
			
					return values.slice(offset, Number(range) + Number(offset))
   				}
			},
			mounted () {
			}
		}).mount('#client')

	</script>
</body>

</html>