<div class="dropdown">
	<button class="border-0 bg-transparent p-0" wire:ignore.self type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
		@if ( Cart::count() )
			<div class="position-absolute top-0 start-100 translate-middle bg-warning py-1 px-2 lh-1 text-white fs-11 rounded-circle">{{  Cart::count() }}</div>
		@endif
		<img src="{{ asset('img/shop/ico-bag.svg') }}" width="24">
	</button>
	<div class="dropdown-menu dropdown-menu-end p-0" wire:ignore.self style="width: 350px;">
		@if ( Cart::content() -> count() )
			<div class="overflow-auto" style="max-height: 250px;">
				@foreach (Cart::content() as $item)
					<div class="d-flex align-items-start p-3 border-bottom-dashed border-secondary border-opacity-25">
						<img src="{{ asset($item -> options -> image) }}" class="rounded-3" width="56">
						<div class="ms-3 lh-1">
							<h2 class="fs-16 fw-600 m-0">{{ $item -> name }}</h2>
							<span class="fs-14">SKU: {{ $item -> options -> sku }}</span><br>
							<span class="fs-14">{{ $item -> qty }} x <strong>$ {{ number_format($item -> price, 2, '.', ',') }}</strong></span>
						</div>

						<div class="flex-fill text-end lh-1">
							<button wire:click="deleteItem('{{ $item -> rowId }}')" class="border-0 bg-transparent p-0"><img src="{{ asset('img/shop/ico-delete.svg') }}" width="16"></button>
						</div>
					</div>
				@endforeach
			</div>

			<div class="d-flex p-3">
				<a href="{{ route('shop.cart', $shop) }}" class="btn btn-light text-uppercase fs-12 rounded-3 flex-fill me-3">Ver Carrito</a>
				<a href="{{ route('shop.order.create', $shop) }}" class="btn btn-success text-uppercase fs-12 rounded-3 flex-fill">Confirmar pedido</a>
			</div>
		@else
			<p class="fs-14 text-center m-0 p-3">No tienes productos aquí</p>
		@endif
	</div>
</div>
