	<script>

	var app = Vue.createApp({
		data() {
			return {
				products: [],
				suppliers: <?= @$suppliers ? @$suppliers : "null"; ?>,
				purchase: {subtotal: null, igv: null, total: null, user_id: "<?= auth()->user()->id;?>", supplier_id: null, voucher_id: 1},
				purchasedetails: [],
				issearch: false,
				searchproducts: '',
				searchsuppliers: '',
				product: null,
				supplier: 'Proveedor',
				voucher: { name: 'Factura ', igv: 18},
				errors: {purchasedetail:null, supplier: null},
				text: null
			}
		},
		methods: {
			searchProducts() {
				values = this.products.filter(item => {
					let props= Object.values(item)
					return props.some(prop => prop==null ? null : prop.toLowerCase().includes(this.searchproducts.toLowerCase()))
				})

				return values.slice(0, 8)
			},
			searchSuppliers() {
			
				values = this.suppliers.filter(item => {
					let props= Object.values(item)
					return props.some(prop => prop==null ? null : prop.toLowerCase().includes(this.searchsuppliers.toLowerCase()))
				})

				return values.slice(0, 8)
				
			},
			addProduct(id, product, pricepurchase, pricesale) {
				this.searchproducts = ''
				this.purchasedetails.push({ productid: id, product: product, cant: null, pricepurchase: pricepurchase, pricesale: pricesale, amount: null, infopricesale: null })
			},
			subtotal() {
				count = 0
				this.purchasedetails.forEach(item => {
					count = Number(count) + Number(item.cant*item.pricepurchase)
				});
				return count.toFixed(2)
			},
			igv() {
				count = this.subtotal() * (this.voucher.igv/100)
				return count.toFixed(2)
			},
			total() {
				count = Number(this.subtotal()) + Number(this.igv())
				return count.toFixed(2)
			},
			savePurchase() {
				axios.post('<?= base_url("Purchase/Add/save");?>', {
					purchase: this.purchase,
					purchasedetails: this.purchasedetails
				}).then(response => {
					if(response.data == 'success'){ 
						window.location.href = "<?= base_url('compra');?>"
					} else {
						this.errors.purchasedetail = response.data["purchase.total"]
						this.errors.supplier = response.data["purchase.supplier_id"]

						setTimeout(() => {this.errors.purchasedetail = null, this.errors.supplier = null}, 5000);
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
				.get('<?= base_url("Purchase/Add/getProducts");?>')
				.then(response => (this.products = response.data))
		}
	}).mount('#purchase')

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