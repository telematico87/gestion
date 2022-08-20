	<script>

		var app = Vue.createApp({
			data() {
				return {
					// For Table
					users: <?= @$users;?>,
					range: 5,
    				page: 1,
					search: '',
					before: 0,
					// For Form
					id: null,
					fullname: null,
					username: null,
					email: null,
					password: null,
					passwordconfirmation: null,
					phonenumber: null,
					errors: { fullname: null, username: null, email: null, password: null, passwordconfirmation: null, phonenumber: null }
				}
			},
			methods: {
				readUsers() {
					axios
						.get('<?= base_url("User/getData");?>')
						.then(response => (this.users = response.data))
				},
				readUser(index) {
					this.id = this.rows()[index].id
					this.fullname = this.rows()[index].fullname
					this.username = this.rows()[index].username
					this.email = this.rows()[index].email
					this.password = this.rows()[index].password
					this.passwordconfirmation = this.rows()[index].passwordconfirmation
					this.phonenumber = this.rows()[index].phonenumber
					this.errors = { fullname: null, email: null, password: null, passwordconfirmation: null, phonenumber: null }
				},
				saveUser() {
					axios.post('<?= base_url("User/save");?>', {
						fullname: this.fullname,
						username: this.username,
						email: this.email,
						password: this.password,
						passwordconfirmation: this.passwordconfirmation,
						phonenumber: this.phonenumber,
					}).then(response => {

						if(response.data.type == 'success'){

							bootstrap.Modal.getInstance(this.$refs.modalAdd).hide();
							this.readUsers()
							
							Swal.fire({
								position: 'top-end',
								icon: response.data.type,
								title: response.data.type,
								text: response.data.message,
								showConfirmButton: false,
								timer: 3500
							})

						} else {
							this.errors.fullname = response.data.fullname
							this.errors.username = response.data.username
							this.errors.email = response.data.email
							this.errors.password = response.data.password
							this.errors.passwordconfirmation = response.data.passwordconfirmation
							this.errors.phonenumber = response.data.phonenumber
						}

					})
				},
				updateUser() {
					axios.post('<?= base_url("User/update");?>', {
						id: this.id,
						fullname: this.fullname,
						username: this.username,
						email: this.email,
						password: this.password,
						passwordconfirmation: this.passwordconfirmation,
						phonenumber: this.phonenumber,
					}).then(response => {
						if(response.data.type == 'success'){

							bootstrap.Modal.getInstance(this.$refs.modalEdit).hide();
							this.readUsers()

							Swal.fire({
								position: 'top-end',
								icon: response.data.type,
								title: response.data.type,
								text: response.data.message,
								showConfirmButton: false,
								timer: 3500
							})

						} else {
							this.errors.fullname = response.data.fullname
							this.errors.username = response.data.username
							this.errors.email = response.data.email
							this.errors.password = response.data.password
							this.errors.passwordconfirmation = response.data.passwordconfirmation
							this.errors.phonenumber = response.data.phonenumber
						}
					})
				},
				deleteUser(id) {
					axios.post('<?= base_url("User/delete");?>', {
						id: id,
					}).then(response => {
						this.readUsers()
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
					this.fullname = null
					this.username = null
					this.email = null
					this.password = null
					this.passwordconfirmation = null
					this.phonenumber = null
					this.errors = { fullname: null, username: null, email: null, password: null, passwordconfirmation: null, phonenumber: null }
				},
				rows() {
					values = this.users.filter(item => {
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
		}).mount('#user')

	</script>
</body>

</html>