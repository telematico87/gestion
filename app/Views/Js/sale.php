	<script>

	Vue.createApp({
		data() {
			return {
				products: [],
				clients: <?= @$clients; ?>,
				sale: {subtotal: null, igv: null, discount: '', total: null, user_id:  "<?= auth()->user()->id;?>", client_id: null, voucher_id: 1},
				saledetails: [],
				issearch: false,
				searchproducts: '',
				searchclients: '',
				product: null,
				client: 'Clientes',
				voucher: { name: 'Factura ', igv: 18},
				errors: {total:null, client: null}
			}
		},
		methods: {
			searchProducts() {
				values = this.products.filter(item => {
					let props= Object.values(item)
					return props.some(prop => prop==null ? null: prop.toLowerCase().includes(this.searchproducts.toLowerCase()))
				})

				return values.slice(0, 8)
			},
			searchClients() {
			
				try {
					values = this.clients.filter(item => {
						let props= Object.values(item)
						return props.some(prop => prop==null ? null : prop.toLowerCase().includes(this.searchclients.toLowerCase()))
					})
					
					return values.slice(0, 8)
				} catch {}

			},
			addProduct(index) {
				this.saledetails.push(Object.assign(this.searchProducts()[index], { cant: 0, amount: 0 }))
				this.searchproducts = ''
			},
			subtotal() {
				count = 0
				this.saledetails.forEach(item => {
					count = Number(count) + Number(item.cant*item.pricesale)
				});
				return count.toFixed(2)
			},
			igv() {
				count = this.subtotal() * (this.voucher.igv/100)
				return count.toFixed(2)
			},
			total() {
				this.sale.igv = this.igv()
				count = (Number(this.subtotal()) - Number(this.sale.discount)) + Number(this.igv())
				return count.toFixed(2)
			},
			saveSale() {
				axios.post('<?= base_url("Sale/Add/save");?>', {
					sale: this.sale,
					saledetails: this.saledetails
				}).then(response => {
					if(response.data == 'success'){ 
						window.location.href = "<?= base_url('venta');?>"
					} else {
						this.errors.total = response.data["sale.total"]
						this.errors.client = response.data["sale.client_id"]

						setTimeout(() => {this.errors.total = null, this.errors.client = null}, 2000);
					}
				})
			},
			currencyValue(evt) {
				value = evt.target.value
				regex = /[0-9.]/;
				
				if(value == '.'){
					data = ''
				} else if(!regex.test(evt.data)) {
					data = value.trim().replace(/[^0-9.]/, '')
				} else {
					data = value.trim().slice(0, value.indexOf('.') === -1 ? value.length : value.indexOf('.') + 3)
				}

				evt.target.value = data
				return data
			},
			integerValue(evt) {
				value = evt.target.value
				regex = /[0-9]/;

				if(!regex.test(evt.data)) {
					data = value.trim().replace(/[^0-9]/, '')
				} else {
					data = value
				}

				evt.target.value = data
				return data
			}
		},
		mounted () {
			axios
				.get('<?= base_url("Sale/Add/getProducts");?>')
				.then(response => (this.products = response.data))
		}
	}).mount('#sales')

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
	</script>
</body>

</html>