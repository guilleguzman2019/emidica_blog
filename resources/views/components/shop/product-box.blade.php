@props(['product', 'dolar', 'shop' => ''])

<div class="col-sm-3 col-6 mb-5">
    <div class="box-product position-relative bg-light h-100">
        <a class="position-relative overflow-hidden d-block" href="{{ route('shop.products.show', [$shop, $product]) }}">
            <div class="bg-img ratio ratio-1x1" style="background-image: url({{ asset( $product -> image ?? 'img/shop/default.png' ) }});"></div>
            @if ( $product -> price_sale )
                <span class="ribon position-absolute bg-danger text-white fs-12 py-1 fw-700 px-5">SALE</span>
            @endif
        </a>
        <div class="addCart bg-white overflow-hidden position-absolute w-100">
            @if ( $product -> variation == 1 )
                <livewire:shop.product.add-to-cart-button :shop="$shop" :product="$product" :key="$product -> id" />
            @else
                <a class="d-block text-center text-dark text-uppercase fs-14" style="line-height: 40px" href="{{ route('shop.products.show', [$shop, $product]) }}">Ver opciones</a>
            @endif
            
        </div>

        <div class="p-sm-4 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="me-2"><a href="{{ route('shop.products.show', [$shop, $product]) }}" class="text-dark fw-600 fs-16 mb-4">{{ $product -> name }}</a></h3>
                <a href="{{ route('shop.products.show', [$shop, $product]) }}"><img src="{{ asset('img/shop/eye.svg') }}" width="18"></a>
            </div>

            <div class="price fw-300">
                @php
                    $price_regular = (($product -> price_cost * $dolar) * $product -> price_regular/100) + ($product -> price_cost * $dolar);
                @endphp
                @if ( $product -> price_sale )
                    $ {{ number_format($price_regular - ($price_regular * $product -> price_sale/100), 2, ',', '.') }}
                    <del class="text-muted">$ {{ number_format($price_regular, 2, ',', '.') }}</del>
                @else
                    $ {{ number_format($price_regular, 2, ',', '.') }}
                @endif
            </div>
        </div>
    </div>
</div>