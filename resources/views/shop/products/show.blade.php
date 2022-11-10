<x-shop-layout shop="{{ $shop -> slug }}">

	@php
		$price_regular = (($product -> price_cost * $setting -> dolar) * $product -> price_regular/100) + ($product -> price_cost * $setting -> dolar);
	@endphp

	<x-slot name="titlePage">| {{ $product -> name }}</x-slot>
	<x-slot name="urlImageProduct">{{ asset($product -> image) }}</x-slot>

	<x-slot name="ogTags">
		@if ( $product -> brand )<meta property="product:brand" content="{{ $product -> brand -> name }}">@endif
		<meta property="product:availability" content="{{ $product -> quantity ? 'in stock' : 'out of stock' }}">
		<meta property="product:condition" content="new">
		<meta property="product:price:amount" content="{{ $product -> price_sale ? ($price_regular - ($price_regular * $product -> price_sale/100)) : $price_regular }}">
		<meta property="product:price:currency" content="ARS">
		@if ( $product -> price_sale ) <meta property="product:sale_price" content="{{ $price_regular - ($price_regular * $product -> price_sale/100) }}"> @endif
		<meta property="product:link" content="{{ route('shop.products.show', [$shop, $product]) }}">
		<meta property="product:image_link" content="{{ asset($product -> image ?? 'img/shop/default.png') }}">
		@if ($product -> images -> count()) <meta property="product:additional_image_link" content="@foreach ($product -> images as $image){{ $image -> url }},@endforeach"> @endif
		<meta property="product:product_type" content="{{ $product -> category -> name }}">
		<meta property="product:retailer_item_id" content="{{ $product -> sku }}">
	</x-slot>

	<div class="header-category bg-light py-4 text-secondary">
		<div class="container">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb m-0">
					<li class="breadcrumb-item fs-14"><a href="{{ url('/') }}/{{ $shop -> slug }}">Home</a></li>
					<li class="breadcrumb-item fs-14"><a href="{{ route('shop.products.index', [$shop, $product -> category]) }}">{{ $product -> category -> name }}</a></li>
					<li class="breadcrumb-item fs-14 active" aria-current="page">{{ $product -> name }}</li>
				</ol>
			</nav>
		</div>
	</div>

	<div class="container py-5">

		<div class="row gx-sm-5">
			<div class="col-sm-5">
				<div id="gallery" class="position-relative">
					<div class="show-big ratio ratio-1x1">
						<img src="{{ asset($product -> image ?? 'img/shop/default.png') }}" id="show-img">
					</div>

					<div class="small-img position-relative">
						<img src="{{ asset('img/shop/next-icon.png') }}" class="icon-left bottom-0 position-absolute my-auto top-0" alt="" id="prev-img">
						<div class="small-container my-0 mx-auto start-0 overflow-hidden position-absolute end-0">
							<div id="small-img-roll">
								<img src="{{ asset($product -> image ?? 'img/shop/default.png') }}" class="show-small-img" alt="">
								@foreach ($product -> images as $image)
									<img src="{{ asset($image -> url) }}" class="show-small-img" alt="">
								@endforeach
							</div>
						</div>
						<img src="{{ asset('img/shop/next-icon.png') }}" class="icon-right bottom-0 position-absolute my-auto top-0 end-0" alt="" id="next-img">
					 </div>
				 </div>
			</div>

			<div class="col-sm-7">
				<h1 class="fs-32 fw-700 mt-4">{{ $product -> name }}</h1>
				<h2 class="fs-26">
					@php
						$price_regular = (($product -> price_cost * $setting -> dolar) * $product -> price_regular/100) + ($product -> price_cost * $setting -> dolar);
					@endphp
					@if ( $product -> price_sale )
						$ {{ number_format($price_regular - ($price_regular * $product -> price_sale/100), 2, ',', '.') }}
						<del class="text-muted">$ {{ number_format($price_regular, 2, ',', '.') }}</del>
					@else
						$ {{ number_format($price_regular, 2, ',', '.') }}
					@endif
				</h2>

				<div class="mb-5">
					<h4 class="fs-18 fw-600">Detalle del producto</h4>
					{!! $product -> description !!}

					@if ( $product -> weight || $product -> size )
						<p>
							{!! $product -> weight ? 'Peso: ' . $product -> weight . ' g<br>' : '' !!}
							{{ $product -> size ? 'Medida: ' . $product -> size : '' }}
						</p>
					@endif

					<p>SKU: {{ $product -> sku }}</p>

					@if ( $product -> category -> image_reference )
						<a data-bs-toggle="modal" data-bs-target="#imageReference" class="btn btn-light btn-sm px-3">Ver tabla de medidas</a>
					@endif
				</div>

				@if ( $product -> variation == 1 )

					@livewire('shop.product.add-cart-item', ['product' => $product])

				@elseif ( $product -> variation == 2 )

					@livewire('shop.product.add-cart-item-color', ['product' => $product])

				@elseif ( $product -> variation == 3 )

					@livewire('shop.product.add-cart-item-size', ['product' => $product])

				@endif

			</div>
		</div>

		@if ( $product -> category -> image_reference )
			<div class="modal fade" id="imageReference" tabindex="-1" aria-labelledby="imageReferenceLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="imageReferenceLabel">Tabla de medidas</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<img src="{{ asset($product -> category -> image_reference) }}" class="img-fluid d-block mx-auto">
						</div>
					</div>
				</div>
			</div>
		@endif


		<div class="mt-5">
			<h4 class="fw-600 fs-18 text-uppercase text-center dash-black my-5"><span class="bg-white d-inline-block px-3">Productos relacionados</span></h4>

			<div class="row">
				@forelse ($related as $product)
					<x-shop.product-box :product="$product" :shop="$shop" :dolar="$setting -> dolar"/>
				@empty
					<p class="text-center">No hay productos relacionados</p>
				@endforelse
			</div>
		</div>

	</div>

</x-shop-layout>