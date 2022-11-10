<x-app-layout>
	<div class="p-4">
		<div class="mb-4">
			<h1 class="fs-18 fw-600 m-0">Pedidos</h1>
			<span class="text-muted fs-12">Detalle de pedido</span>
		</div>

		@php
			$pm = ['', 'Efectivo', 'Deposito/Transferencia', 'MercadoPago'];
			$st = ['', 'A coordinar', 'A domicilio'];
		@endphp

		<div class="py-sm-4 pb-4">
			@livewire('panel.order.status', ['order' => $order])
		</div>

		<div class="row">
			<div class="col">
				<div class="bg-dark-2 p-4 border-dashed rounded-4 mb-4">
					<h3 class="fs-18 fw-400">Detalles del pedido (#{{ str_pad($order -> id, 8, '0', STR_PAD_LEFT) }})</h3>

					<table class="table table-borderless text-white-50 fs-14 m-0">
						<tr class="border-bottom border-light border-opacity-10">
							<td class="ps-0">
								<img src="{{ asset('img/panel/ico-calendar.svg') }}" width="20" height="20" class="f-invert opacity-50 me-2 my-1">
								Fecha de creación
							</td>
							<td class="text-end pe-0">{{ $order -> created_at -> format('d/m/Y') }}</td>
						</tr>
						<tr class="border-bottom border-light border-opacity-10">
							<td class="ps-0">
								<img src="{{ asset('img/panel/ico-wallet.svg') }}" width="20" height="20" class="f-invert opacity-50 me-2 my-1">
								Método de pago
							</td>
							<td class="text-end pe-0">{{ $order -> payment_method ? $pm[$order -> payment_method] : 'Sin definir' }}</td>
						</tr>
						<tr>
							<td class="ps-0">
								<img src="{{ asset('img/panel/ico-truck.svg') }}" width="20" height="20" class="f-invert opacity-50 me-2 my-1">
								Método de envío
							</td>
							<td class="text-end pe-0">{{ $st[$order -> shipping_type] }}</td>
						</tr>
					</table>
				</div>
			</div>

			<div class="col">
				<div class="bg-dark-2 p-4 border-dashed rounded-4 mb-4">
					<h3 class="fs-18 fw-400">Detalles del cliente</h3>

					<table class="table table-borderless text-white-50 fs-14 m-0">
						<tr class="border-bottom border-light border-opacity-10">
							<td class="ps-0 text-nowrap">
								<img src="{{ asset('img/panel/ico-user.svg') }}" width="20" height="20" class="f-invert opacity-50 me-2 my-1">
								Nombre
							</td>
							<td class="text-end pe-0">{{ $order -> customer_name }}</td>
						</tr>
						<tr class="border-bottom border-light border-opacity-10">
							<td class="ps-0 text-nowrap">
								<img src="{{ asset('img/panel/ico-mail.svg') }}" width="20" height="20" class="f-invert opacity-50 me-2 my-1">
								Email
							</td>
							<td class="text-end pe-0" style="word-break: break-word;">{{ $order -> customer_email }}</td>
						</tr>
						<tr>
							<td class="ps-0 text-nowrap">
								<img src="{{ asset('img/panel/ico-phone.svg') }}" width="20" height="20" class="f-invert opacity-50 me-2 my-1">
								Teléfono
							</td>
							<td class="text-end pe-0">{{ $order -> customer_phone }}</td>
						</tr>
					</table>
				</div>
			</div>

			@if ( $order -> shipping_type == 2 )
				<div class="col">
					<div class="bg-dark-2 p-4 border-dashed rounded-4 mb-4">
						<h3 class="fs-18 fw-400">Detalles del envío</h3>

						<table class="table table-borderless text-white-50 fs-14 m-0">
							<tr class="border-bottom border-light border-opacity-10">
								<td class="ps-0">
									<img src="{{ asset('img/panel/ico-home.svg') }}" width="20" height="20" class="f-invert opacity-50 me-2 my-1">
									Dirección
								</td>
								<td class="text-end pe-0">{{ $order -> customer_address }} {{ $order -> customer_number }}</td>
							</tr>
							@if ( $order -> customer_neighborhood )
								<tr class="border-bottom border-light border-opacity-10">
									<td class="ps-0">
										<img src="{{ asset('img/panel/ico-home.svg') }}" width="20" height="20" class="f-invert opacity-50 me-2 my-1">
										Barrio
									</td>
									<td class="text-end pe-0">{{ $order -> customer_neighborhood }}</td>
								</tr>
							@endif
							<tr class="border-bottom border-light border-opacity-10">
								<td class="ps-0">
									<img src="{{ asset('img/panel/ico-marker.svg') }}" width="20" height="20" class="f-invert opacity-50 me-2 my-1">
									Ciudad
								</td>
								<td class="text-end pe-0">{{ $order -> customer_city }}</td>
							</tr>
							<tr>
								<td class="ps-0">
									<img src="{{ asset('img/panel/ico-marker.svg') }}" width="20" height="20" class="f-invert opacity-50 me-2 my-1">
									Provincia
								</td>
								<td class="text-end pe-0">{{ $order -> customer_province }}</td>
							</tr>
						</table>
					</div>
				</div>
			@else
				<div class="col">
					<div class="bg-dark-2 p-4 border-dashed rounded-4 mb-4">
						<h3 class="fs-18 fw-400">Detalles del envío</h3>

						<p class="fs-14 text-white-50">El cliente seleccionó <span class="fw-600">"Envío a coordinar"</span>. El envío se realizará a la dirección de la tienda.</p>
						<p class="fs-14 text-white-50">Recuerda mantener tu información actualizada para evitar inconvenientes.</p>
					</div>
				</div>
			@endif
		</div>

		<div class="bg-dark-2 p-4 border-dashed rounded-4 mb-4">
			<h3 class="fs-18 fw-400">Pedido #{{ str_pad($order -> id, 8, '0', STR_PAD_LEFT) }}</h3>

			<div class="table-responsive">
				<table class="table table-borderless">
                    <thead class="fs-12 text-muted opacity-50 text-uppercase">
						<tr>
							<th class="fw-600 ps-0">Producto</th>
							<th class="fw-600">SKU</th>
							<th class="fw-600 text-center">Cantidad</th>
							<th class="fw-600">Precio</th>
							<th class="fw-600 text-end pe-0">Subtotal</th>
						</tr>
					</thead>

                    <tbody class="text-white-50 fs-14">
						@foreach($order -> products as $item)
							<tr class="border-bottom-dashed align-middle">
								<td class="ps-0">
									<div class="d-flex align-items-center py-2">
										<img src="{{ asset($item -> product -> image ?? 'img/shop/default.png') }}" width="42" class="me-3 rounded-3">
										<div>
											{{ $item -> product_name }}
											@if ( $item -> variation )
												<span class="fs-12 text-nowrap">
													@php $variation = json_decode($item -> variation, true); @endphp
													@isset ( $variation['size'] )
														<br>Talle: {{ $variation['size'] }}
													@endisset
													@isset ( $variation['color'] )
														<br>Color: <span class="d-inline-block ratio ratio-1x1 border rounded-circle position-relative" style="width: 16px; top: 3px; background: {{ $variation['color'] }}"></span>
													@endisset
												</span>
											@endif
										</div>
									</div>
								</td>
								<td>{{ $item -> sku }}</td>
								<td class="text-center">{{ $item -> quantity }}</td>
								<td class="text-nowrap">$ {{ number_format(($item -> price_sale > 0) ? $item -> price_sale : $item -> price_regular, 2, ',', '.') }}</td>
								<td class="text-end pe-0 text-nowrap">
									$ {{ number_format((($item -> price_sale > 0) ? $item -> price_sale : $item -> price_regular) * $item -> quantity, 2, ',', '.') }}
								</td>
							</tr>
						@endforeach

						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-end">Subtotal</td>
							<td class="text-end pe-0 text-nowrap">$ {{ number_format($order -> subtotal, 2, ',', '.') }}</td>
						</tr>

						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-end">Envío</td>
							<td class="text-end pe-0 text-nowrap">{{ ($order -> shipping_type == 1) ? 'A coordinar' : '$ ' . number_format( $order -> shipping_cost, 2, ',', '.') }}</td>
						</tr>

						<tr class="fs-18 text-white">
							<td></td>
							<td></td>
							<td></td>
							<td class="text-end">Total</td>
							<td class="text-end pe-0 text-nowrap">$ {{ number_format($order -> total, 2, ',', '.') }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</x-app-layout>