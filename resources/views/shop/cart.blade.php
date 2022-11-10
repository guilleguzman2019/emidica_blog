<x-shop-layout shop="{{ $shop -> slug }}">
    <x-slot name="titlePage">| Carrito de compras</x-slot>

	@livewire('shop.cart.cart', ['shop' => $shop])

</x-shop-layout>