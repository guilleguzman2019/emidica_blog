<x-shop-layout shop="{{ $shop -> slug }}">
	<x-slot name="titlePage">| Detalle del pedido #{{ str_pad($order -> id, 8, '0', STR_PAD_LEFT) }}</x-slot>

	@php
		$status_order = ['', 'Pendiente de pago', 'Pagado', 'Pago en proceso', 'Rechazado', 'Solicitud de envío', 'Solicitud de envío aprobada', 'En preparación', 'Listo para entregar', 'Despachado', 'Cancelado'];
		$status_color = ['', 'success bg-opacity-10', 'success text-white', 'success bg-opacity-50 text-white', 'danger text-white', 'primary bg-opacity-50', 'primary', 'secondary', 'warning', 'info', 'dark text-white'];
		$payment_method = ['', 'Efectivo', 'Deposito/Transferencia', 'Mercado Pago'];
	@endphp

	<div class="header-category py-4 text-secondary">
		<div class="container">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb m-0">
					<li class="breadcrumb-item fs-14"><a href="{{ route('shop.index', $shop) }}">Home</a></li>
					<li class="breadcrumb-item fs-14">Orden</li>
					<li class="breadcrumb-item fs-14 active" aria-current="page">Detalle</li>
				</ol>
			</nav>
		</div>
	</div>

	<div class="container py-sm-5 py-4 my-sm-5">
		<div class="text-center mb-5">
			<img src="{{ asset('img/shop/ico-bag.svg') }}" width="48" class="mb-4">
			<h1 class="fs-28 fw-300 text-uppercase mb-4">Muchas gracias. Recibimos tu orden.</h1>

			@if ( $order -> status == 1 )
				
				@if ( $shop -> user -> suscriber -> plan == 2 && ( $shop -> bank || $shop -> mpago ) )
					<p>Elige tu método de pago:</p>
				@endif

				@if ( $shop -> user -> suscriber -> plan == 2 && ( $shop -> bank || $shop -> mpago ) )
					<div class="d-sm-flex justify-content-center">
						@if ( $shop -> cash )
							<label class="border-dashed mb-3 mb-sm-0 mx-3 text-nowrap d-flex align-items-center justify-content-center py-3 px-5 rounded-3 payment_method" onclick="$('.payment_method').removeClass('active'); $(this).addClass('active'); $('.info').addClass('d-none');$('.cash').removeClass('d-none')" style="cursor: pointer;">
								<img src="{{ asset('img/shop/ico-cash.svg') }}" width="24" height="24" class="me-2">
								<h3 class="fs-16 m-0">Efectivo</h3>
							</label>
						@endif

						@if ( $shop -> user -> suscriber -> plan == 2 && $shop -> bank )
							<label class="border-dashed mb-3 mb-sm-0 mx-3 text-nowrap d-flex align-items-center justify-content-center py-3 px-5 rounded-3 payment_method" onclick="$('.payment_method').removeClass('active'); $(this).addClass('active'); $('.info').addClass('d-none');$('.bank').removeClass('d-none')" style="cursor: pointer;">
								<img src="{{ asset('img/shop/ico-bank.svg') }}" width="24" height="24" class="me-2">
								<h3 class="fs-16 m-0">Deposito/Transferencia</h3>
							</label>
						@endif

						@if ( $shop -> user -> suscriber -> plan == 2 && $shop -> mpago )
							<label class="border-dashed mb-3 mb-sm-0 mx-3 text-nowrap d-flex align-items-center justify-content-center py-3 px-5 rounded-3 payment_method" onclick="$('.payment_method').removeClass('active'); $(this).addClass('active'); $('.info').addClass('d-none'); checkout.open()" style="cursor: pointer;">
								<img src="{{ asset('img/shop/ico-mpago.svg') }}" width="24" height="24" class="me-2">
								<h3 class="fs-16 m-0">Tarjetas</h3>
							</label>
						@endif
					</div>

					<div class="bg-warning bg-opacity-25 p-4 my-3 fs-14 br-10 border border-warning text-center info cash d-none">
						<p class="m-0">Para poder procesar el pedido, contactanos a través de nuestro WhatsApp o al correo electrónico para coordinar el pago en efectivo.</p>
					</div>

					<div class="bg-warning bg-opacity-25 border border-warning my-3 br-10 fs-14 p-4 bank info d-none">
						<p>Acá tienes los datos para procesar el pedido a través de pago por Depósito/Transferencia:</p>
						<p class="fw-600">
							Banco: {{ $shop -> bank_name }}<br>
							TITULAR: {{ $shop -> bank_titular }}<br>
							{{ $shop -> bank_titular_cuit ? 'CUIT: ' . $shop -> bank_titular_cuit . '<br>' : '' }}
							CBU/CVU: {{ $shop -> bank_cbu }}<br>
							ALIAS: {{ $shop -> bank_alias }}
						</p>
						<p class="m-0">Una vez realizado el pago, comunícate con nosotros al {{ $shop -> whatsapp ?? 'whatsapp' }} para verificarlo y procesar el pedido.</p>
					</div>
				@else
					<div class="bg-warning bg-opacity-25 p-4 my-3 fs-14 br-10 border border-warning text-center">
						<p class="m-0">Para poder procesar el pedido, contactanos a través de nuestro WhatsApp o al correo electrónico para coordinar el pago en efectivo.</p>
					</div>
				@endif

			@endif
		</div>

		<div class="row gx-sm-5">
			<div class="col-sm-4">
				<div class="border-dashed bg-light p-4 mb-3 br-10">
					Orden nro.: {{ str_pad($order -> id, 8, '0', STR_PAD_LEFT) }}<br>
					Estado de orden: <span class="bg-{{ $status_color[$order -> status] }} d-inline-block px-2 py-1 lh-1 rounded-3 fs-12">{{ $status_order[$order -> status] }}</span><br>
					Fecha: {{ $order -> created_at -> format('d/m/Y \a \l\a\s H:i') }}hs.<br>
					Total: $ {{ number_format($order -> total, 2, '.', ',') }}<br>
					@if ( $order -> payment_method ) Método de pago: {{ $payment_method[$order -> payment_method] }} @endif
				</div>
			</div>
			<div class="col-sm-8">
				<h3 class="fs-24 mb-3">Detalle de orden</h3>

				<div class="table-responsive">
					<table class="table align-middle">
						<thead>
							<tr class="fs-13 text-uppercase">
								<th>Producto</th>
								<th>SKU</th>
								<th>Precio</th>
								<th class="text-center">Cantidad</th>
								<th class="text-end">Subtotal</th>
							</tr>
						</thead>

						<tbody class="border-0">
							@foreach($order -> products as $item)
								<tr>
									<td class="border-light">
										<div class="d-flex align-items-center py-2">
											<img src="{{ asset($item -> product -> image ?? 'img/shop/default.png') }}" width="42" class="me-2 rounded-3">
											<div>
												<h3 class="fs-16 fw-400 mb-1">{{ $item -> product_name }}</h3>
												@if ( $item -> variation )
													@php $variation = json_decode($item -> variation, true); @endphp
													@isset ( $variation['size'] )
														<span class="fs-14 text-nowrap">Talle: {{ $variation['size'] }}</span><br>
													@endisset
													@isset ( $variation['color'] )
														<span class="fs-14 text-nowrap">Color: <span class="d-inline-block ratio ratio-1x1 border rounded-circle position-relative" style="width: 16px; top: 3px; background: {{ $variation['color'] }}"></span>
													@endisset
												@endif
											</div>
										</div>
									</td>
									<td class="border-light">{{ $item -> sku }}</td>
									<td class="border-light text-nowrap">$ {{ number_format(($item -> price_sale > 0) ? $item -> price_sale : $item -> price_regular, 2, '.', ',') }}</td>
									<td class="text-center border-light">{{ $item -> quantity }}</td>
									<td class="border-light text-end text-nowrap">
										$ {{ number_format((($item -> price_sale > 0) ? $item -> price_sale : $item -> price_regular) * $item -> quantity, 2, '.', ',') }}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				<div class="d-flex justify-content-end">
					<table class="table w-auto">
						<tr class="fw-300">
							<td class="border-0 text-end pe-5">Subtotal</td>
							<td class="border-0 text-end">$ {{ number_format($order -> subtotal, 2, '.', ',') }}</td>
						</tr>
						<tr class="fw-300">
							<td class="border-0 text-end pe-5">Envío</td>
							<td class="border-0 text-end">{{ ($order -> shipping_type == 1) ? 'A coordinar' : '$ ' . number_format( $order -> shipping_cost, 2, '.', ',') }}</td>
						</tr>
						<tr class="fw-600 fs-18">
							<td class="border-0 text-end pe-5">Total</td>
							<td class="border-0 text-end">$ {{ number_format($order -> total, 2, '.', ',') }}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>

	@push('scripts')
		@if ( $shop -> user -> suscriber -> plan == 2 && $shop -> mpago )
			<script src="https://sdk.mercadopago.com/js/v2"></script>
			<script>
				const mp = new MercadoPago('{{ $shop -> mp_public_key }}', {
					locale: 'es-AR'
				});

				const checkout = mp.checkout({
					preference: {
						id: '{{ $preference_id }}'
					},
				});
			</script>
		@endif
	@endpush

</x-shop-layout>