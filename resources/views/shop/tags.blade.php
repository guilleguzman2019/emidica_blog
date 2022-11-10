<x-shop-layout shop="{{ $shop -> slug }}">
	<x-slot name="titlePage">| Etiqueta: {{ $tag -> name }}</x-slot>

	<div class="container py-5">

		<h4 class="mb-5 mt-5 fs-28 fw-400 text-uppercase text-center dash-black" style="letter-spacing: 5px;"><span class="bg-white d-inline-block px-3">{{ $tag -> name }}</span></h4>

		<div class="row pt-4">
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