<x-app-layout>
	<div class="p-4">
		<div class="mb-4">
			<h1 class="fs-18 fw-600 m-0">eCommerce Dashboard</h1>
    		<span class="text-muted fs-12">Bienvenido</span>
		</div>

		@if ( Auth::user() -> user_type == 1 || Auth::user() -> user_type == 3 )
			<div class="row">
				<div class="col-md-6">

					<div class="row">
						<div class="col-md-6">
							<div class="bg-dark-2 p-4 border-dashed rounded-4 mb-4">
								<h1 class="mb-0 lh-1"><span class="text-muted fs-14 position-relative" style="top: -10px;">$</span>{{ number_format($orderTotalMonth, 2, ',', '.') }}</h1>
								<span class="fs-12 text-muted fw-600">Ingresos brutos</span>

								<div class="d-flex mt-4">
									<div id="chart" class="w-100 h-100"></div>
									<div class="pt-1 fs-14">
										@foreach ($cats as $cat)
											<span class="text-nowrap">$ {{ number_format($cat['sales'], 2, ',', '.') }}<br></span>
										@endforeach
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="bg-dark-2 border-dashed rounded-4 mb-4 px-4 pt-4">
								<h1 class="mb-0 lh-1"><span class="text-muted fs-14 position-relative" style="top: -10px;">$</span>{{ number_format($array_today, 2, ',', '.') }}</h1>
								<span class="fs-12 text-muted fw-600">Ventas diarias</span>

								<div id="chart2" class="mt-4"></div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="bg-dark-2 p-4 border-dashed rounded-4 mb-4">
								<h1 class="mb-0 lh-1">{{ $orders -> count() }}</h1>
								<span class="fs-12 text-muted fw-600">Pedidos este mes</span>

								<div class="mt-5"></div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="bg-dark-2 p-4 border-dashed rounded-4 mb-4">
								<h1 class="mb-0 lh-1">{{ $shops -> count() }}</h1>
								<span class="fs-12 text-muted fw-600">Nuevas tiendas este mes</span>

								<div class="mt-5 ps-3">
									@foreach ($shops -> sortByDesc('id') -> take(5) as $shop)
										<a class="ratio ratio-1x1 rounded-circle bg-white border border-2 bg-img-contain d-inline-block shadow" href="{{ route('admin.shops.show', $shop -> shop) }}" data-bs-toggle="tooltip" title="{{ $shop -> shop -> shop_name }}" style="background-image: url({{ asset($shop -> shop -> logo ?? 'img/admin/default.png') }}); margin-left: -15px; width: 48px"></a>
									@endforeach
									<a href="{{ route('admin.shops.index') }}" class="ratio ratio-1x1 rounded-circle bg-dark border border-secondary border-2 text-center text-secondary fs-14 bg-img-contain d-inline-block shadow" style="margin-left: -15px; width: 48px">
										<div style="padding-top: 12px;">
											+{{ $shops -> count() - 5 }}
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<div class="col-md-6">
					<div class="bg-dark-2 p-4 border-dashed rounded-4 mb-4">
						<h1 class="mb-0 fs-18 lh-1">Venta anual</h1>
						<span class="fs-12 text-muted fw-600">Ingreso bruto total</span>
						<h1 class="mb-0 lh-1 mt-4"><span class="text-muted fs-14 position-relative" style="top: -10px;">$</span>{{ number_format(array_sum($saleMonth), 2, ',', '.') }}</h1>

						<div id="chart3" class="mt-4"></div>
					</div>
				</div>
			</div>
		@endif
	</div>

	@push('scripts')

		@php
			$series = [];
			$labels = [];
		@endphp
		@foreach ($cats as $cat)
			@php
				$series[] = $cat['sales']; 
				$labels[] = $cat['name']; 
			@endphp
		@endforeach

		<style type="text/css">
			#chart svg .apexcharts-graphical {
				transform: translate(0);
			}
			#chart svg .apx-legend-position-right {
				right: 25px !important;
			}
		</style>

		<script type="text/javascript">
			var options = {
				chart: {
					type: 'donut',
					background: 'transparent',
					parentHeightOffset: 0,
				},
				stroke: {
					show: false
				},
				series: [{{ implode(',', $series) }}],
				labels: ['{{ implode("','", $labels) }}'],
				legend: {
					fontFamily: 'Poppins, Arial',
					offsetY: -20,
					horizontalAlign: 'left',
					onItemClick: {
						toggleDataSeries: false
					},
					onItemHover: {
						highlightDataSeries: false
					},
					itemMargin: {
						horizontal: 0,
						vertical: 0
					},
				},
				markers: {
					onClick: undefined,
				},
				dataLabels: {
					enabled: false,
				},
				tooltip: {
					enabled: false,
				},
				states: {
					hover: {
						filter: {
							type: 'none',
							value: 0,
						}
					},
					active: {
						allowMultipleDataPointsSelection: false,
						filter: {
							type: 'none',
							value: 0,
						}
					},
				},
				theme: {
					mode: 'dark',
				}
			}

			var chart = new ApexCharts(document.querySelector("#chart"), options);

			chart.render();

			var options2 = {
				chart: {
					type: 'bar',
					background: 'transparent',
					toolbar: {
						show: false,
					},
					height: '105px',
					sparkline: {
						enabled: true
					},
				},
				theme: {
					mode: 'dark',
				},
				grid: {
					show: false,
				},
				dataLabels: {
					enabled: false,
				},
				xaxis: {
					labels: {
						show: false,
					},
					axisBorder: {
						show: false,
					},
					axisTicks: {
						show: false,
					},
				},
				yaxis: {
					labels: {
						show: false,
					},
				},
				plotOptions: {
					bar: {
						borderRadius: 8,
						columnWidth: '40%',
					}
				},
				series: [{
					name: ["Total"],
					data: [
						@foreach ($array_totals as $at)
							{
								x: 'Total',
								y: {{ $at }}
							},
						@endforeach
					]
				}],
				labels: ['{!! implode("','", $array_days) !!}']
			}
			var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
			chart2.render();


			const money = new Intl.NumberFormat("de-DE");

			var options3 = {
				chart: {
					type: 'area',
					height: '275px',
					background: 'transparent',
					toolbar: {
						show: false,
					},
				},
				dataLabels: {
					enabled: false
				},
				series: [
					{
						name: ["Total"],
						data: [{{ implode(',', $saleMonth) }}]
					}
				],
				labels: [ '{!! implode("','", $month_year) !!}'],
				colors: ['#b8d935'],
				fill: {
					type: "gradient",
					gradient: {
						shadeIntensity: 1,
						opacityFrom: 0.5,
						opacityTo: 0,
						stops: [0, 100]
					}
				},
				grid: {
					strokeDashArray: 4,
					borderColor: 'rgba(255,255,255,.1)',
				},
				xaxis: {
					axisTicks: {
						show: false,
					},
					labels: {
						style: {
							colors: 'rgba(255,255,255,.3)',
						},
					},
				},
				yaxis: {
					labels: {
						style: {
							colors: 'rgba(255,255,255,.3)',
						},
						formatter: function (value) {
							return "$ " + money.format(value);
						},
					},
				},
				theme: {
					mode: 'dark',
				},
			}
			var chart3 = new ApexCharts(document.querySelector("#chart3"), options3);
			chart3.render();
		</script>
	@endpush
</x-app-layout>