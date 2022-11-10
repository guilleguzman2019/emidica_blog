<x-shop-layout shop="{{ $shop -> slug }}">

	{{-- SLIDER --}}
	<div id="sliderShop" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-indicators">
			@php $ci = 0; @endphp
			@foreach ($bannersSlider as $banner)
				<button type="button" data-bs-target="#sliderShop" data-bs-slide-to="{{ $ci }}" @if ( ! $ci ) class="active" aria-current="true" @endif></button>
				@php $ci++; @endphp
			@endforeach

			@foreach ($shop -> user -> bannersShop -> where('status', 1) as $bs)
				<button type="button" data-bs-target="#sliderShop" data-bs-slide-to="{{ $ci }}" @if ( ! $ci ) class="active" aria-current="true" @endif></button>
				@php $ci++; @endphp
			@endforeach
		</div>
		<div class="carousel-inner">
			@php $b = 0; @endphp
			@foreach ($bannersSlider as $banner)
				@php $b++; @endphp
				<div class="carousel-item @if ( $b == 1 ) active @endif">
					@if ( $banner -> url )
						@php $urlparts = parse_url($banner -> url); @endphp
						<a href="{{ ( count($urlparts) > 1 ) ? $banner -> url : $shop_url . $banner -> url }}">
					@endif
						<img src="{{ asset($banner -> image_desktop) }}" class="d-md-block d-none w-100">
						<img src="{{ asset($banner -> image_mobile) }}" class="d-block d-md-none w-100">
					@if ( $banner -> url )
						</a>
					@endif
				</div>
			@endforeach

			@foreach ($shop -> user -> bannersShop -> where('status', 1) as $bs)
				@php $b++; @endphp
				<div class="carousel-item @if ( $b == 1 ) active @endif">
					@if ( $bs -> url )
						<a href="{{ $bs -> url }}">
					@endif
						<img src="{{ asset($bs -> image_desktop) }}" class="d-none d-md-block w-100">
						<img src="{{ asset($bs -> image_mobile) }}" class="d-block d-md-none w-100">
					@if ( $bs -> url )
						</a>
					@endif
				</div>
			@endforeach
		</div>
		<button class="carousel-control-prev top-50 translate-middle-y w-auto" type="button" data-bs-target="#sliderShop" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next top-50 translate-middle-y w-auto" type="button" data-bs-target="#sliderShop" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
	</div>
	{{-- end SLIDER --}}

	{{-- PROMO BANNERs --}}
	<div class="container-fluid py-5 overflow-hidden">
		<div class="row">
			<div class="col-10 col-sm-12">
				<div class="my-slider">
					@foreach ($bannersSecondary as $bs)
						<div>
							@php $urlparts = parse_url($bs -> url); @endphp
							<a href="{{ ( count($urlparts) > 1 ) ? $bs -> url : $shop_url . $bs -> url }}">
								<div class="ratio ratio-16x9 bg-img" style="background-image: url({{ asset($bs -> image_desktop) }});"></div>
							</a>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	{{-- end PROMO BANNERs --}}

	{{-- FEATURED --}}
	@if ( $featured -> count() )
		<div class="container pt-5 pb-sm-5">
			<h4 class="mb-5 fs-28 fw-700 text-center dash-black"><span class="bg-white d-inline-block px-3">Productos destacados</span></h4>
			<div class="row ">
				@foreach ($featured as $product)
					<x-shop.product-box :product="$product" :shop="$shop" :dolar="$settings -> dolar"/>
				@endforeach
			</div>

			<p class="text-center">
				<a href="{{ route('shop.products.featured', $shop) }}" class="d-inline-block bg-dark text-white px-4 py-2 text-uppercase">ver todos</a>
			</p>
		</div>
	@endif
	{{-- end FEATURED --}}


	{{-- MOST SOLD --}}
	<div class="container pt-5 pb-sm-5">
		<h4 class="mb-5 fs-28 fw-700 text-center dash-black"><span class="bg-white d-inline-block px-3">Productos más vendidos</span></h4>
		<div class="row ">
			@foreach ($mostSold as $product)
				<x-shop.product-box :product="$product" :shop="$shop" :dolar="$settings -> dolar"/>
			@endforeach
		</div>

		<p class="text-center">
			<a href="{{ route('shop.products.mostSold', $shop) }}" class="d-inline-block bg-dark text-white px-4 py-2 text-uppercase">ver todos</a>
		</p>
	</div>
	{{-- end MOST SOLD --}}

	{{-- CTA --}}
	@if ( $settings -> cta_status )
		<div class="mb-5" id="cta">
			<div class="bg-img py-md-5" style="background-image: url({{ asset($settings -> cta_background) }});">
				<div class="container py-5">
					<div class="row">
						<div class="col-sm-6">
							<h2 class="fw-700 mb-sm-4">{{ $settings -> cta_title }}</h2>
							<p class="mb-4">{{ $settings -> cta_description }}</p>
							@php $urlparts = parse_url($settings -> cta_button_link); @endphp
							<a href="{{ ( count($urlparts) > 1 ) ? $settings -> cta_button_link : $shop_url . $settings -> cta_button_link }}" class="bg-dark text-white rounded-pill px-4 py-2">{{ $settings -> cta_button_text }}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
	{{-- end CTA --}}

	{{-- LAST PRODUCTS --}}
	<div class="container py-5 overflow-hidden">
		<h4 class="mb-5 fs-28 fw-700 text-center dash-black"><span class="bg-white d-inline-block px-3">Últimos Productos</span></h4>
		<div class="my-slider2">
			@foreach ($lastProducts as $product)
				<x-shop.product-box :product="$product" :shop="$shop" :dolar="$settings -> dolar"/>
			@endforeach
		</div>

		<p class="text-center">
			<a href="{{ route('shop.products.latest', $shop) }}" class="d-inline-block bg-dark text-white px-4 py-2 text-uppercase">ver todos</a>
		</p>
	</div>
	{{-- end LAST PRODUCTS --}}

	{{-- DISCOUNTS --}}
	@if ( $sales -> count() )
		<div class="container pb-5 overflow-hidden">
			<h4 class="mb-5 fs-28 fw-700 text-center dash-black"><span class="bg-white d-inline-block px-3">Ofertas</span></h4>
			<div class="my-slider3">
				@foreach ($sales as $product)
					<x-shop.product-box :product="$product" :shop="$shop" :dolar="$settings -> dolar"/>
				@endforeach
			</div>

			<p class="text-center">
				<a href="{{ route('shop.products.sales', $shop) }}" class="d-inline-block bg-dark text-white px-4 py-2 text-uppercase">ver todos</a>
			</p>
		</div>
	@endif
	{{-- end DISCOUNTS --}}

	@push('scripts')
		<script type="text/javascript">
			var slider = tns({
				container: '.my-slider',
				controls: false,
				nav: false,
				gutter: 30,
				items: 1,
				loop: true,
				responsive: {
					900: {
						items: 3
					}
				},
				autoplay: false
			});
			var slider2 = tns({
				container: '.my-slider2',
				controls: false,
				nav: false,
				gutter: 30,
				items: 2,
				loop: false,
				responsive: {
					900: {
						items: 4
					}
				},
				autoplay: false
			});
			var slider3 = tns({
				container: '.my-slider3',
				controls: false,
				nav: false,
				gutter: 30,
				items: 2,
				loop: false,
				responsive: {
					900: {
						items: 4
					}
				},
				autoplay: false
			});
		</script>
	@endpush

</x-shop-layout>