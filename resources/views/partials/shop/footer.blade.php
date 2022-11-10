<footer class="bg-dark py-5">
    <div class="container text-white">
        <div class="row border-bottom pb-5">
            <div class="col-sm-3">
                @if ($shop -> logo_foot)
                    <img src="{{ asset($shop -> logo_foot) }}" style="max-height: 36px;" class="w-auto">
                @else
                    <h1 class="text-white fs-18 text-uppercase m-0 fw-800 lh-1">{{ $shop -> business_name }}</h1>
                @endif

                <p class="fs-13 text-white-50 mt-3">{{ $shop -> description }}</p>

                <div class="d-none d-md-block">
                    @if ( $shop -> facebook )
                        <a href="https://fb.com/{{ $shop -> facebook }}" target="_blank" class="me-3"><img src="{{ asset('img/shop/ico-fb.svg') }}" class="f-invert" height="16" width="16"></a>
                    @endif

                    @if ( $shop -> instagram )
                        <a href="https://instagram.com/{{ $shop -> instagram }}" target="_blank" class="me-3"><img src="{{ asset('img/shop/ico-ig.svg') }}" class="f-invert" height="16" width="16"></a>
                    @endif

                    @if ( $shop -> whatsapp )
                        <a href="https://wa.me/{{ $shop -> whatsapp }}" target="_blank" class="me-3"><img src="{{ asset('img/shop/ico-wa.svg') }}" class="f-invert" height="16" width="16"></a>
                    @endif
                </div>
            </div>
            <div class="col-sm-9 mt-4 mt-sm-0">
                <h5 class="fw-600 mb-4">Nuestra tienda</h5>

                <ul class="list-unstyled m-0">
                    @foreach ($categories as $category)
                        <li class="mb-3"><a href="#" class="text-white-50">{{ $category -> name }}</a></li>
                    @endforeach
                </ul>

                <div class="d-block d-md-none text-center mt-4">
                    @if ( $shop -> facebook )
                        <a href="https://fb.com/{{ $shop -> facebook }}" target="_blank" class="mx-3"><img src="{{ asset('img/shop/ico-fb.svg') }}" class="f-invert" height="24" width="24"></a>
                    @endif

                    @if ( $shop -> instagram )
                        <a href="https://instagram.com/{{ $shop -> instagram }}" target="_blank" class="mx-3"><img src="{{ asset('img/shop/ico-ig.svg') }}" class="f-invert" height="24" width="24"></a>
                    @endif

                    @if ( $shop -> whatsapp )
                        <a href="https://wa.me/{{ $shop -> whatsapp }}" target="_blank" class="mx-3"><img src="{{ asset('img/shop/ico-wa.svg') }}" class="f-invert" height="24" width="24"></a>
                    @endif
                </div>
            </div>
        </div>

        <div class="pt-5 text-center fs-11 text-white-50">
            {{ $shop -> shop_name }} &copy; {{ date('Y') }}. Todos los derechos reservados.
        </div>
    </div>
</footer>