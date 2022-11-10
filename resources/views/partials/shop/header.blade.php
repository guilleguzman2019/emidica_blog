<header>
    <div class="container d-flex align-items-center justify-content-between py-4">
        <button class="bg-transparent border-0 p-0 m-0 d-sm-none d-block" onclick="$('header nav').toggleClass('show');">
            <span class="d-block bg-black mb-1"></span>
            <span class="d-block bg-black mb-1"></span>
            <span class="d-block bg-black mb-1"></span>
        </button>

        <a href="{{ route('shop.index', $shop) }}">
            @if ($shop -> logo)
                <img src="{{ asset($shop -> logo) }}" class="w-auto" style="max-height: 36px;">
            @else
                <h1 class="text-dark fs-18 text-uppercase m-0 fw-800 lh-1">{{ $shop -> shop_name }}</h1>
            @endif
        </a>

        <div class="d-flex align-items-center">
            <div class="d-none d-md-block">
                @livewire('shop.search', ['shop' => $shop])
            </div>
            
            @livewire('shop.cart-icon', ['shop' => $shop])
        </div>
    </div>

    <div class="d-block d-md-none mx-sm-3 mb-sm-3">
        <div class="bg-light p-2">
            @livewire('shop.search', ['shop' => $shop])
        </div>
    </div>

    <nav class="bg-light py-3 text-sm-center">
        <div class="d-flex d-sm-none justify-content-between align-items-center fw-600 px-3 pb-2 mb-3 border-bottom">
            MENÚ

            <button class="fs-24 fw-600 bg-transparent border-0 p-0 m-0 text-dark" onclick="$('header nav').toggleClass('show');">&times;</button>
        </div>
        <ul class="list-unstyled m-0 text-uppercase fs-13 fw-bold">
            <li class="d-sm-inline-block d-block">
                <a href="{{ url('/') }}/{{ $shop -> slug }}" class="d-sm-inline-block d-block p-2 mx-2 text-dark">Home</a>
            </li>
            <li class="d-sm-inline-block d-block position-relative submenu">

                {{-- CUENTO CANTIDAD DE CATEGORÍAS PADRE --}}
                @php $oneCat = false; $cattop = 0; @endphp
                @foreach ($categories as $cat)
                    @if ( ! $cat -> parent_id )
                        @php $cattop++; $catslug = $cat -> slug @endphp
                    @endif
                @endforeach

                @if ( $cattop > 1 )
                    <a href="{{ route('shop.categories.index', $shop) }}" class="d-sm-inline-block d-block p-2 mx-2 text-dark">Categorías</a>
                @else
                    <a href="{{ route('shop.products.index', [$shop -> slug, $catslug]) }}" class="d-sm-inline-block d-block p-2 mx-2 text-dark">Categorías</a>
                @endif
                

                <ul class="bg-white text-start list-unstyled shadow rounded-3 py-2">
                    @foreach ($categories as $category)
                        <li class="px-4">
                            <div class="border-bottom mb-3">
                                <a href="{{ route('shop.products.index', [$shop -> slug, $category]) }}" class="d-sm-inline-block d-block py-2 text-dark">{{ $category -> name }}</a>
                            </div>

                            <div class="row">
                                @foreach ($category -> subcategories as $subcat)
                                    <div class="col-sm-1 col-12 text-sm-center mb-sm-3 mb-2 fw-400 fs-13 text-capitalize">
                                        <a class="text-dark d-block ps-3 ps-sm-0" href="{{ route('shop.products.index', [$shop -> slug, $subcat]) }}">
                                            <div class="ratio ratio-1x1 d-none d-sm-block mb-2 mx-auto bg-white bg-img rounded-3" style="background-image: url({{ asset($subcat -> megamenu ?? $subcat -> image) }});"></div>
                                            <span class="d-inline d-sm-none fs-18 fw-600">• </span>{{ $subcat -> name }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li class="d-sm-inline-block d-block">
                <a href="{{ route('shop.contact', [$shop]) }}" class="d-inline-block p-2 mx-2 text-dark">Contacto</a>
            </li>
        </ul>
    </nav>

</header>