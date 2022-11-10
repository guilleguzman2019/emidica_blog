<x-shop-layout shop="{{ $shop -> slug }}">
	<x-slot name="titlePage">| Confirmar pedido</x-slot>

	@livewire('shop.order.create', ['shop' => $shop])
</x-shop-layout>