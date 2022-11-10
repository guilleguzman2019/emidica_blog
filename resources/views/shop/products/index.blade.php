<x-shop-layout shop="{{ $shop -> slug }}">
	<x-slot name="titlePage">| Productos -> Categoría: {{ $category -> name }}</x-slot>

	<div class="header-category bg-img" style="background-image: url({{ asset($category -> image) }});">
		<div class="bg-dark bg-opacity-25 py-5 text-center text-white">
			<h1 class="fs-21 fw-700">{{ $category -> name }}</h1>
		</div>
	</div>

	<div class="container py-sm-5 py-3" data-bs-spy="scroll"  data-bs-target="#navbar-example">

		<div class="row gx-sm-5">
			<div class="col-lg-3 col-md-4 position-relative">

				<div class="filters">
					<button class="bg-transparent text-dark border-0 px-0 pb-3 w-100 d-flex align-items-center d-sm-none fw-600 text-uppercase fs-14 justify-content-between border-bottom top mb-3" onclick="$(this).toggleClass('active'); $('.filterList').slideToggle()">
						Filtros
						<img src="{{ asset('img/shop/arrow-down.svg') }}" width="12">
					</button>

					<div class="filterList mb-4">
						<h5 class="mb-3 fs-18 fw-600">Categorías</h5>

						<ul class="list-unstyled m-0 category-list">
							@foreach ($categories as $category)
								@include('partials.shop.category-list', $category)
							@endforeach
						</ul>
					</div>
				</div>

				{{--<h5 class="mt-5 mb-3 fs-18 fw-600">Marcas</h5>
				<ul class="list-unstyled m-0">
					@foreach ($category -> brands as $brand)
						<li class="mb-2">
							<a wire:click="$set('marca', '{{ $brand -> name }}')" class="{{ $marca == $brand -> name ? 'text-warning' : 'text-secondary' }}">{{ $brand -> name }}</a>
						</li>
					@endforeach
				</ul>

				@if ( $marca )
					<button class="btn btn-dark btn-sm mt-4 rounded-pill w-100" wire:click="clearFilter">Limpiar filtros</button>
				@endif--}}
			</div>

			<div class="col-lg-9 col-md-8">
				<livewire:shop.product.index :shop="$shop" :settings="$settings" :descendantsIds="$descendantsIds" />
			</div>
		</div>
	</div>

</x-shop-layout>