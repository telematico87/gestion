	<script>

	var app = Vue.createApp({
		data() {
			return {
				// For Form
				id: null,
				fullname: '<?= auth()->user()->full_name;?>',
				phonenumber: '<?= auth()->user()->phone_number;?>',
				address: '<?= auth()->user()->address;?>',
				preview: '<?= auth()->user()->picture;?>',
				errors: { fullname: null, phonenumber: null, address: null }
			}
		},
		created() {},
		methods: {
			readProfile() {
				axios
					.get('<?= base_url("Profile/getData");?>')
					.then(response => {
						this.fullname = response.data.fullname
						this.phonenumber = response.data.phonenumber
						this.address = response.data.address
					})
			},
			readFile(event) {

				const file = event.target.files[0];
				const form = new FormData();
				form.append('profilefile', file);

				if(file.type.includes('image')){
					this.uploadFile(URL.createObjectURL(file), form);
				} else {
					this.uploadFile("<?= base_url('assets/img/illustrations/icon-documentation.svg');?>", form);
				}

				event.target.value=null;

			}, 
			uploadFile(urlData, formData) {
				Swal.fire({
					imageUrl: urlData,
					confirmButtonText: 'Subir archivo'
				}).then((result) => {

					if (result.isConfirmed) {
						axios({
						method: 'post',
						url: '<?= base_url("Profile/uploadFile");?>',
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
			saveProfile() {
				axios.post('<?= base_url("Profile/save");?>', {
					fullname: this.fullname,
					phonenumber: this.phonenumber,
					address: this.address
				}).then(response => {

					if(response.data.type == 'success'){

						this.readProfile()
						
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
						this.errors.phonenumber = response.data.phonenumber
						this.errors.address = response.data.address
					}

				})
			}
		},
		mounted () {
		}
	}).mount('#profile')

	</script>
</body>

</html>