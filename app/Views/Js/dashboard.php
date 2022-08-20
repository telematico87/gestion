	<script src="<?= base_url('assets/js/plugins/chartjs.min.js');?>"></script>
	
	<script>
		var app = Vue.createApp({
			data() {
				return {
					years: <?= @$years;?>,
					year: <?= date("Y");?>,
					salesweekamounts: null,
					salesweeknames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes','Sabado']
				}
			},
			methods: {
				graphChart() {
					
					try {
						var ctx = this.$refs.chartline.getContext("2d");
						var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50)

						gradientStroke.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
						gradientStroke.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
						gradientStroke.addColorStop(0, 'rgba(94, 114, 228, 0)');

						var chart = new Chart(ctx, {
							type: "line",
							data: {
								labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dec"],
								datasets: [{
									label: "Monto",
									tension: 0.4,
									borderWidth: 0,
									pointRadius: 0,
									borderColor: "#5e72e4",
									backgroundColor: gradientStroke,
									borderWidth: 3,
									fill: true,
									data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
									maxBarThickness: 6
								}],
							},
							options: {
								responsive: true,
								maintainAspectRatio: false,
								plugins: {
									legend: {
										display: false,
									}
								},
								interaction: {
									intersect: false,
									mode: 'index',
								},
								scales: {
									y: {
										grid: {
											drawBorder: false,
											display: true,
											drawOnChartArea: true,
											drawTicks: false,
											borderDash: [5, 5]
										},
										ticks: {
											display: true,
											padding: 10,
											color: '#fbfbfb',
											font: {
												size: 11,
												family: "Open Sans",
												style: 'normal',
												lineHeight: 2
											},
										}
									},
									x: {
										grid: {
											drawBorder: false,
											display: false,
											drawOnChartArea: false,
											drawTicks: false,
											borderDash: [5, 5]
										},
										ticks: {
											display: true,
											color: '#ccc',
											padding: 20,
											font: {
												size: 11,
												family: "Open Sans",
												style: 'normal',
												lineHeight: 2
											}
										}
									}
								}
							}
						})
					}
					catch(err) {
						chart = Chart.getChart("chartline");
					}
					
					axios.post('<?= base_url("Dashboard/getSalesGlobal");?>', {
						year: this.year
					}).then(response => {
						amounts = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]

						response.data.forEach(element => {
							amounts[Number(element.month)-1] = Number(element.amount)
						});

						chart.data.datasets[0].data = amounts
                		chart.update()
					})
				},
				readSalesWeek() {
					axios
						.get('<?= base_url("Dashboard/getSalesWeek");?>')
						.then(response => {
							amounts = [0, 0, 0, 0, 0, 0, 0]
							response.data.forEach(element => {
								amounts[Number(element.day)-1] = Number(element.data)
							});
							this.salesweekamounts = amounts
						})
				}
			},
			mounted () {
				this.graphChart()
				this.readSalesWeek()
			}
		}).mount('#dashboard')
	</script>
</body>

</html>