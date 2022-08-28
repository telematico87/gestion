<script>

var app = Vue.createApp({
	data() {
		return {
			// For table
			suppliers: <?= @$suppliers;?>,
			range: 5,
			page: 1,
			search: '',
			before: 0,
			// For Form
			id: null,
			ruc: null,
			phonenumber: null,
			email: null,
			errors: [{ name: null }, { ruc: null }, { phonenumber: null }, { email: null }]
		}
	},
	created() {},
	methods: {
		readSuppliers() {
			axios
				.get('<?= base_url("Supplier/getData");?>')
				.then(response => (this.suppliers = response.data))
		},
		readSupplier(index) {
			this.id = this.rows()[index].id
			this.name = this.rows()[index].name
			this.ruc = this.rows()[index].ruc
			this.phonenumber = this.rows()[index].phone_number
			this.email = this.rows()[index].email
			this.errors = [{ name: null }, { ruc: null }, { phonenumber: null }, { email: null }]
		},
		saveSupplier() {
			axios.post('<?= base_url("Supplier/save");?>', {
				name: this.name,
				ruc: this.ruc,
				phonenumber: this.phonenumber,
				email: this.email
			}).then(response => {

				if(response.data.type == 'success'){

					bootstrap.Modal.getInstance(this.$refs.modalAdd).hide();
					this.readSuppliers()
					
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
					this.errors.ruc = response.data.ruc
					this.errors.phonenumber = response.data.phonenumber
					this.errors.email = response.data.email
				}

			})
		},
		updateSupplier() {
			axios.post('<?= base_url("Supplier/update");?>', {
				id: this.id,
				name: this.name,
				ruc: this.ruc,
				phonenumber: this.phonenumber,
				email: this.email
			}).then(response => {
				if(response.data.type == 'success'){

					bootstrap.Modal.getInstance(this.$refs.modalEdit).hide();
					this.readSuppliers()

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
					this.errors.ruc = response.data.ruc
					this.errors.phonenumber = response.data.phonenumber
					this.errors.email = response.data.email
				}
			})
		},
		deleteSupplier(id) {
			axios.post('<?= base_url("Supplier/delete");?>', {
				id: id,
			}).then(response => {
				this.readSuppliers()
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
			this.ruc = null
			this.phonenumber = null
			this.email = null
			this.errors = [{ name: null }, { ruc: null }, { phonenumber: null }, { email: null }]
		},
		rows() {
			values = this.suppliers.filter(item => {
				let props= Object.values(item);
				return props.some(prop => prop==null ? null : prop.toLowerCase().includes(this.search.toLowerCase()))
			})

			range = this.range
			offset = range * (this.page - 1)
			this.before = Math.ceil(values.length / range);
			
			return values.slice(offset, Number(range) + Number(offset))
		}
	},
	mounted () {
	}
}).mount('#supplier')

</script>
</body>

</html>