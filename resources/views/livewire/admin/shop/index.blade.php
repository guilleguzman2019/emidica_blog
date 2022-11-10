<div class="p-4">
	<div class="mb-4">
		<h1 class="fs-18 fw-600 m-0">Tiendas</h1>
		<span class="text-muted fs-12">Listado</span>
	</div>

	@php
		$status_shop = ['', 'Pendiente de pago', 'Pago a confirmar', 'Tienda Activa', 'Tienda Cancelada', 'Tienda suspendida', 'Tienda eliminada'];
		$color = ['', 'primary', 'info', 'success', 'danger', 'warning', 'dark'];
	@endphp

	<div class="bg-dark-2 border-dashed p-4 br-10">
		<div class="d-flex justify-content-between mb-4">
			<div class="border-0 bg-dark-3 rounded-3 p-2">
				<img src="{{ asset('img/admin/ico-search.svg') }}" width="24" class="f-invert opacity-25">
				<input class="bg-transparent border-0 text-white" type="text" wire:model="search" placeholder="Buscar">
			</div>

			<div class="d-flex">
				<select class="form-select bg-dark-3 fs-14 text-white border-0 rounded-3" wire:model="status">
					<option value="">Estado</option>
					@foreach ($status_shop as $key => $value)
						@if ( $key != 0 )
							<option value="{{ $key }}">{{ $value }}</option>
						@endif
					@endforeach
				</select>

				{{-- <a href="{{ route('admin.products.create') }}" class="bg-cian text-white px-3 py-2 rounded-3 ms-2 fs-14 text-nowrap">Agregar producto</a> --}}
			</div>
		</div>

		@if ( $shops -> count() )

			@php
				$plan = [NULL => 'Sin asignar', 1 => 'Basic', 2 => 'Premium'];
				$plan_color = [NULL => 'secondary', 1 => 'info', 2 => 'success'];
			@endphp

			<div class="table-responsive">
				<table class="table table-borderless">
					<thead class="fs-12 text-muted opacity-50 text-uppercase">
						<th class="fw-600 ps-0">Tienda</th>
						<th class="fw-600">Suscriptor</th>
						<th class="fw-600 text-center">Plan</th>
						<th></th>
						<th class="fw-600">Renovación</th>
						<th></th>
					</thead>
					<tbody class="text-white fs-14">
						@foreach ($shops as $shop)
							<tr class="border-bottom-dashed align-middle">
								<td class="ps-0">
									<div class="d-flex align-items-center py-2">
										<div class="ratio ratio-1x1 bg-img-contain me-3 rounded-3" style="background-image: url({{ asset(($shop -> logo_foot ?? $shop -> logo) ?? 'img/admin/default.png') }}); width: 50px;"></div>
										{{ $shop -> name }}
									</div>
								</td>
								<td>{{ ucwords(strtolower($shop -> user -> name)) }}</td>
								<td class="text-center">
									<span class="badge fw-500 badge-light-{{ $plan_color[$shop -> user -> suscriber -> plan] }}">{{ $plan[$shop -> user -> suscriber -> plan] }}</span>
								</td>
								<td class="text-center">
									<span class="badge fw-500 badge-light-{{ $color[$shop -> user -> suscriber -> status] }}">{{ $status_shop[$shop -> user -> suscriber -> status] }}</span>
								</td>
								<td>
									{{ $shop -> user -> suscriber -> renovation_date ? $shop -> user -> suscriber -> renovation_date -> format('d/m/Y') : '' }}

									@if ( $shop -> user -> suscriber -> renovation_date )
										<button class="d-inline-block px-2 py-1 rounded-2 bg-dark-4 border-0" data-bs-toggle="tooltip" title="Actualizar fecha" onclick="confirm('¿Confirma el pago de la sucripción de la tienda?') || event.stopImmediatePropagation()" wire:click="udpateSuscription({{ $shop -> user -> suscriber -> id }})" wire:loading.attr="disabled" wire:target="udpateSuscription({{ $shop -> user -> suscriber -> id }})"><img class="f-invert" src="{{ asset('img/admin/ico-refresh.svg') }}" width="16"></button>
									@endif
								</td>
								<td class="pe-0 text-end text-nowrap">
									@if ( $shop -> user -> suscriber -> status != 1 )
										@if ( $shop -> domain && $shop -> domain_status )
											@php $url = 'https://' . $shop -> domain; @endphp
										@else
											@php $url = config('/') . '/' . $shop -> slug; @endphp
										@endif
										<a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" href="{{ $url }}" target="_blank"><img class="f-invert" src="{{ asset('img/admin/ico-link.svg') }}" width="16"></a>
									@endif
									<a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" href="{{ route('admin.shops.show', $shop) }}"><img class="f-invert" src="{{ asset('img/admin/ico-view.svg') }}" width="16"></a>
									@if ( Auth::user() -> user_type != 8 )
										<button class="d-inline-block px-2 py-1 rounded-2 border-0 bg-dark-4" onclick="confirm('¿Seguro que deseas eliminar esta tienda?') || event.stopImmediatePropagation()" wire:click="delete('{{ $shop -> user_id }}')" wire:loading.attr="disabled" wire:target="delete('{{ $shop -> user_id }}')"><img class="f-invert" src="{{ asset('img/admin/ico-delete.svg') }}" width="16"></button>
									@endif
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

				@if ( $shops -> hasPages() )
					<div class="pagination">
						{{ $shops -> withQueryString() -> onEachSide(1) -> links() }}
					</div>
				@endif
			</div>
		

		@else

			<p class="text-center py-5">No tienes tiendas aquí.</p>

		@endif

	</div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Actualizado correctamente</div>
                <button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        window.livewire.on('updated', () => {
        	$('.modal').modal('hide')
            var toast = new bootstrap.Toast(document.getElementById('liveToast'))
            toast.show()
        })
    </script>
@endpush
