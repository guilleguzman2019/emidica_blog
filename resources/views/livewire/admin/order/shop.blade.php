<div class="p-4">
	<div class="mb-4">
		<h1 class="fs-18 fw-600 m-0">Pedidos</h1>
		<span class="text-muted fs-12">Detalle de pedidos de la tienda</span>
	</div>

	<div class="row">
		<div class="col-sm-3">
			<div class="border-dashed bg-dark-2 br-10 p-4 mb-4 sticky-top text-center">
				<div class="mx-auto mb-2 ratio ratio-1x1 bg-img-contain rounded-3" style="background-image: url({{ asset($shop -> logo_foot ?? ($shop -> logo ?? 'img/admin/default.png')) }}); width: 160px;"></div>

				<h1 class="fs-21 fw-400">{{ $shop -> shop_name }}</h1>
				<span class="fs-12 text-muted align-items-center">
					<img src="{{ asset('img/admin/ico-user-mini.svg') }}" width="16" class="f-invert opacity-50 me-1"> {{ $shop -> user -> name }}<br>
					<img src="{{ asset('img/admin/ico-mail-mini.svg') }}" width="16" class="f-invert opacity-50 me-1"> {{ $shop -> user -> email }}<br>
					<img src="{{ asset('img/admin/ico-phone-mini.svg') }}" width="16" class="f-invert opacity-50 me-1"> {{ $shop -> user -> suscriber -> phone }}
				</span>
			</div>
		</div>

		<div class="col-sm-9">
			@php
				$status_order = ['', 'Pendiente de pago', 'Pagado', 'Pago en proceso', 'Rechazado', 'Solicitud de envío', 'Solicitud de envío aprobada', 'En preparación', 'Listo para entregar', 'Despachado', 'Cancelado'];
				$status_color = ['', 'warning', 'success', 'warning', 'danger', 'primary', 'primary', 'secondary', 'info', 'success', 'secondary'];
				$payment_method = ['', 'Efectivo', 'Deposito/Transferencia', 'Mercado Pago'];
			@endphp

			<div class="bg-dark-2 border-dashed p-4 br-10">
				<div class="d-flex justify-content-between mb-4">
					<div class="border-0 bg-dark-3 rounded-3 p-2">
						<img src="{{ asset('img/admin/ico-search.svg') }}" width="24" class="f-invert opacity-25">
						<input class="bg-transparent border-0 text-white" type="text" wire:model="customer" placeholder="Buscar">
					</div>

					<div class="d-flex">
						<select class="form-select bg-dark-3 fs-14 text-white border-0 rounded-3" wire:model="status">
							<option value="">Estado</option>
							@foreach ($status_order as $key => $value)
								@if ( $key )
									<option value="{{ $key }}">{{ $value }}</option>
								@endif
							@endforeach
						</select>
					</div>
				</div>

				@if ( $orders -> count() )

					<div class="table-responsive">
						<table class="table table-borderless">
							<thead class="fs-12 text-muted opacity-50 text-uppercase">
								<tr>
									<th class="fw-600 ps-0">Orden</th>
									<th class="fw-600">Cliente</th>
									<th class="fw-600 text-center">Estado</th>
									<th class="fw-600">Total</th>
									<th class="fw-600">Fecha</th>
									<th></th>
								</tr>
							</thead>
							<tbody class="text-white fs-14">
								@foreach ($orders as $order)
									<tr class="border-bottom-dashed align-middle">
										<td class="ps-0 py-3">{{ str_pad($order -> id, 8, '0', STR_PAD_LEFT) }}</td>
										<td>{{ $order -> customer_name }}</td>
										<td class="text-center"><span class="badge fw-500 badge-light-{{ $status_color[$order -> status] }}">{{ $status_order[$order -> status] }}</span></td>
										<td class="opacity-50">$ {{ number_format($order -> total, 2, '.', ',' ) }}</td>
										<td class="opacity-50">{{ $order -> created_at -> format('d/m/Y') }}</td>
										<td class="text-end pe-0">
											<a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" href="{{ route('admin.orders.show', $order) }}"><img class="f-invert" src="{{ asset('img/admin/ico-view.svg') }}" width="16"></a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>

					<div class="d-flex justify-content-between">
						<select class="bg-dark-3 text-white border-0 rounded-3 px-2" wire:model="paginate">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="100">100</option>
						</select>

						@if ( $orders -> hasPages() )
							<div class="pagination">
								{{ $orders -> withQueryString() -> onEachSide(1) -> links() }}
							</div>
						@endif
					</div>

				@else

					<p class="text-center py-5">No tienes pedidos aquí.</p>

				@endif
			</div>
		</div>
	</div>
</div>
