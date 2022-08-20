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
					typedocument: '',
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
					this.id = this.rows()[index].id
					this.name = this.rows()[index].name
					this.typedocument = this.rows()[index].typedocument
					this.numdocument = this.rows()[index].numdocument
					this.phonenumber = this.rows()[index].phonenumber
					this.email = this.rows()[index].email
					this.address = this.rows()[index].address
					this.errors = { name: null, typedocument: null, numdocument: null, phonenumber: null, email: null, address: null }
				},
				saveClient() {
					axios.post('<?= base_url("Client/save");?>', {
						name: this.name,
						typedocument: this.typedocument,
						numdocument: this.numdocument,
						phonenumber: this.phonenumber,
						email: this.email,
						address: this.address,
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
						typedocument: this.typedocument,
						numdocument: this.numdocument,
						phonenumber: this.phonenumber,
						email: this.email,
						address: this.address,
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
							this.errors.typedocument = response.data.typedocument
							this.errors.numdocument = response.data.numdocument
							this.errors.phonenumber = response.data.phonenumber
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