<x-shop-layout shop="{{ $shop -> slug }}">
	<x-slot name="titlePage">| Categorías</x-slot>

	<div class="container py-5">

		<h4 class="mb-5 mt-5 fs-28 fw-400 text-uppercase text-center dash-black" style="letter-spacing: 5px;"><span class="bg-white d-inline-block px-3">Categorías</span></h4>

		<div class="row justify-content-center pt-4">
			@foreach ($categories as $category)

				<div class="col-sm-3">
					<a href="{{ route('shop.products.index', [$shop -> slug, $category]) }}" class="d-block position-relative">
						<div class="bg-img p-3" style="background-image: url({{ asset($category -> image) }});">
							<img src="{{ asset('img/shop/3-4.gif') }}" class="w-100">
						</div>

						<span class="d-block border border-white py-2 ms-4 text-white text-center fs-15 text-uppercase fw-500 position-absolute bottom-0 mb-4" style="letter-spacing: 3px; width: calc(100% - 3rem)">{{ $category -> name }}</span>
					</a>
				</div>

			@endforeach
		</div>

	</div>

</x-shop-layout>