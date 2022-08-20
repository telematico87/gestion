	<script>
		Vue.createApp({
			data() {
				return {
					categories: <?= @$categories ? @$categories : 'null';?>,
					search: '',
					preview: "<?= @$product->picture;?>",
					barcode: "<?= @$product->barcode;?>",
					name: "<?= @$product->name;?>",
					description: "<?= @$product->description;?>",
					category: {id: "<?= @$product->categoryid;?>", name: "<?= @$product->category ? @$product->category: 'Categorias';?>"},
					errors: [{ barcode: null }, { category: null }, { name: null }, { description: null }]
				}
			},
			methods: {
				readFile(event) {

					const file = event.target.files[0];
					const form = new FormData();
					form.append('productfile', file);

					if(file.type.includes('image')){
						this.uploadFile(URL.createObjectURL(file), form);
					} else {
						this.uploadFile("<?= base_url('assets/img/illustrations/icon-documentation.svg');?>", form);
					}

					event.target.value=null;

				},
				searchCategories() {
					values = this.categories.filter(item => {
						let props= Object.values(item)
						return props.some(prop => prop==null ? null : prop.toLowerCase().includes(this.search.toLowerCase()))
					})

					return values.slice(0, 8)
					
				},
				uploadFile(urlData, formData) {
					Swal.fire({
						imageUrl: urlData,
						confirmButtonText: 'Subir archivo'
					}).then((result) => {

						if (result.isConfirmed) {
							axios({
							method: 'post',
							url: '<?= base_url("Product/Add/uploadFile");?>',
							data: formData,
							headers: { "Content-Type": 'multipart/form-data' }
							}).then(response => {

								if(response.data.type=='success'){
									this.preview = urlData
								}
								
								Swal.fire({
									position: 'top-end',
									icon: response.data.type,
									title: response.data.type,
									text: response.data.message,
									showConfirmButton: false,
									timer: 3500
								})
								
							})
						}
						
					})
				},
				saveProduct() {
					axios.post('<?= base_url("Product/Add/save");?>', {
						barcode: this.barcode,
						category: this.category.id,
						name: this.name,
						description: this.description
					}).then(response => {
						if(response.data == 'success'){
							window.location.href = "<?= base_url('producto');?>"
						} else {
							this.errors.barcode = response.data.barcode
							this.errors.category = response.data.category
							this.errors.name = response.data.name
							this.errors.description = response.data.description
						}
					})
				},
				updateProduct() {
					axios.post('<?= base_url("Product/Edit/save");?>', {
						barcode: this.barcode,
						category: this.category.id,
						name: this.name,
						description: this.description
					}).then(response => {
						if(response.data == 'success'){
							window.location.href = "<?= base_url('producto');?>"
						} else {
							this.errors.barcode = response.data.barcode
							this.errors.category = response.data.category
							this.errors.name = response.data.name
							this.errors.description = response.data.description
						}
					})
				}
			},
			mounted () {
			}
		}).mount('#product')

	</script>
	
	<script>
		<?php if(session("success")):?>
		Swal.fire({
			position: 'top-end',
			icon: 'success',
			title: 'Success',
			text: '<?= session("success");?>',
			showConfirmButton: false,
			timer: 3000
		})
		<?php endif;?>

		<?php if(session("error")):?>
		Swal.fire({
			position: 'top-end',
			icon: 'error',
			title: 'Oops...',
			text: '<?= session("error") ?>',
			showConfirmButton: false,
			timer: 3000
		})
		<?php endif; ?>
	</script>
</body>

</html>