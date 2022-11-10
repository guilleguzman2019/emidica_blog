<x-shop-layout shop="{{ $shop -> slug }}">
    <x-slot name="titlePage">| {{ $title }}</x-slot>

	<div class="header-category bg-dark">
		<div class="bg-dark bg-opacity-25 py-5 text-center text-white">
			<h1 class="fs-21 fw-700">{{ $title }}</h1>
		</div>
	</div>

	<div class="container py-5">

        <div class="row">
            @forelse ($products as $product)
                <x-shop.product-box :product="$product" :shop="$shop" :dolar="$settings -> dolar"/>
            @empty
                <div class="col-sm-12">
                    <div class="alert alert-info text-center">No se encontraron productos</div>
                </div>
            @endforelse
        </div>

        <div class="pagination">
            {{ $products -> withQueryString() -> onEachSide(1) -> links() }}
        </div>

	</div>
</x-shop-layout>