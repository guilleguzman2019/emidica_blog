<div>
	@php
		$status_order = ['', 'Pendiente de pago', 'Pagado', 'Pago en proceso', 'Rechazado', 'Solicitud de envío', 'Solicitud de envío aprobada', 'En preparación', 'Listo para entregar', 'Despachado'];
		$status_color = ['', 'warning', 'success', 'warning', 'danger', 'primary', 'primary', 'secondary', 'info', 'success'];
	@endphp

	<div class="d-sm-flex justify-content-between align-items-center">
		<div class="d-flex align-items-center">
			Estado de pedido: 
			@if ( $status < 5 )
				<div class="dropdown ms-2">
					<button wire:loading.attr="disabled" class="btn btn-{{ $status_color[$status] }} btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						{{ $status_order[$status] }}
					</button>
					<ul class="dropdown-menu">
						@if ( $status != 1 ) <li><button class="dropdown-item" onclick="confirm('¿Confirmas el cambio de estado de este pedido?') || event.stopImmediatePropagation()" wire:click="updateStatus(1)" wire:loading.attr="disabled">Pendiente de pago</button></li> @endif
						@if ( $status != 2 ) <li><button class="dropdown-item" onclick="confirm('¿Confirmas el cambio de estado de este pedido?') || event.stopImmediatePropagation()" wire:click="updateStatus(2)" wire:loading.attr="disabled">Pagado</button></li> @endif
						@if ( $status != 3 ) <li><button class="dropdown-item" onclick="confirm('¿Confirmas el cambio de estado de este pedido?') || event.stopImmediatePropagation()" wire:click="updateStatus(3)" wire:loading.attr="disabled">Pago en proceso</button></li> @endif
						@if ( $status != 4 ) <li><button class="dropdown-item" onclick="confirm('¿Confirmas el cambio de estado de este pedido?') || event.stopImmediatePropagation()" wire:click="updateStatus(4)" wire:loading.attr="disabled">Rechazado</button></li> @endif
					</ul>
				</div>
			@else
				<span class="badge fw-500 fs-14 ms-2 lh-1 py-2 px-3 badge-light-{{ $status_color[$status] }}">{{ $status_order[$status] }}</span>
			@endif
		</div>

		@if ( $status < 5 )
			<button class="btn btn-danger fs-14 px-4 d-none d-sm-block" onclick="confirm('¿Seguro que deseas eliminar este pedido?') || event.stopImmediatePropagation()" wire:click="destroy" wire:loading.attr="disabled" wire:target="destroy">Eliminar pedido</button>
		@endif
	</div>

	@if ( $status == 2 )
		<div class="alert alert-primary mt-2">El pedido se encuentra listo para que hagas una solicitud de envío.</div>
	@endif
	

    {{-- TOASTs --}}
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToastUpdated" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Estado actualizado correctamente</div>
                <button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        window.livewire.on('updated', () => {
            $('.modal').modal('hide')
            var toast = new bootstrap.Toast(document.getElementById('liveToastUpdated'))
            toast.show()
        })
    </script>
@endpush