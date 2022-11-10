<div class="position-relative">
    <form class="d-sm-flex search" method="GET" action="{{ route('shop.search', $shop) }}">
        <img src="{{ asset('img/shop/ico-search.svg') }}" width="24">
        <input class="mx-2 border-0 border-bottom" type="text" name="q" wire:model="search" autocomplete="off" placeholder="Buscar">
    </form>

    @if ( $search )
        <div class="position-absolute results bg-white border rounded-3 overflow-auto end-0">
            @forelse ($products as $product)
                <div class="border-bottom p-3 d-flex align-items-center">
                    <a href="{{ route('shop.products.show', [$shop, $product]) }}"><div class="ratio ratio-1x1 me-2 bg-img rounded-3" style="background-image: url({{ asset($product -> image ?? 'img/shop/default.png') }}); width: 48px;"></div></a>
                    <div class="flex-fill">
                        <h2 class="fs-16 fw-600 m-0 lh-1"><a href="{{ route('shop.products.show', [$shop, $product]) }}" class="text-dark">{{ $product -> name }}</a></h2>
                        <div class="d-flex justify-content-between">
                            <span class="fs-13">SKU: {{ $product -> sku }}</span>
                            <span class="fs-13">@php
                                    $price_regular = (($product -> price_cost * $settings -> dolar) * $product -> price_regular/100) + ($product -> price_cost * $settings -> dolar);
                                @endphp
                                @if ( $product -> price_sale )
                                    $ {{ number_format($price_regular - ($price_regular * $product -> price_sale/100), 2, ',', '.') }}
                                    <del class="text-muted">$ {{ number_format($price_regular, 2, ',', '.') }}</del>
                                @else
                                    $ {{ number_format($price_regular, 2, ',', '.') }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="fs-12 text-center">No encontramos resultados</p>
            @endforelse
        </div>
    @endif
    
</div>
