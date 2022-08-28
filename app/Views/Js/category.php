	<script>

		var app = Vue.createApp({
			data() {
				return {
					// For Table
					categorys: <?= @$categorys;?>,
					range: 5,
    				page: 1,
					search: '',
					before: 0,
					// For Form
					id: null,
					name: null,
					description: null,
					errors: [{ name: null }, { description: null }]
				}
			},
			created() {},
			methods: {
				readCategorys() {
					axios
						.get('<?= base_url("Category/getData");?>')
						.then(response => (this.categorys = response.data))
				},
				readCategory(index) {
					this.id = this.rows()[index].id
					this.name = this.rows()[index].name
					this.description = this.rows()[index].description
					this.errors = [{ name: null }, { description: null }]
				},
				saveCategory() {
					axios.post('<?= base_url("Category/save");?>', {
						name: this.name,
						description: this.description
					}).then(response => {

						if(response.data.type == 'success'){

							bootstrap.Modal.getInstance(this.$refs.modalAdd).hide();
							this.readCategorys()
							
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
							this.errors.description = response.data.description
						}

					})
				},
				updateCategory() {
					axios.post('<?= base_url("Category/update");?>', {
						id: this.id,
						name: this.name,
						description: this.description
					}).then(response => {
						if(response.data.type == 'success'){

							bootstrap.Modal.getInstance(this.$refs.modalEdit).hide();
							this.readCategorys()

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
							this.errors.description = response.data.description
						}
					})
				},
				deleteCategory(id) {
					axios.post('<?= base_url("Category/delete");?>', {
						id: id,
					}).then(response => {
						this.readCategorys()
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
					this.description = null
					this.errors = [{ name: null }, { description: null }]
				},
				rows() {
					values = this.categorys.filter(item => {
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
		}).mount('#category')

	</script>
</body>

</html>