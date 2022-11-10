<div class="p-sm-4 px-4 py-3 border-bottom-dashed mb-2 text-center">
    <img src="{{ asset('img/logo.svg') }}" width="130" class="d-none d-sm-block">

    <div class="d-flex d-sm-none justify-content-between fs-14 text-uppercase align-items-center fw-600 text-white">
        Menú

        <button class="bg-transparent border-0 p-0 m-0 fs-24 text-white lh-1" onclick="$('aside').toggleClass('show')">&times;</button>
    </div>
</div>

<nav class="px-3 pt-4 position-relative overflow-auto">
    <ul class="list-unstyled m-0 fs-14">
        <li class="mb-2">
            <a class="d-block mb-1 py-2 px-3 br-10 text-white {{ (request()->is('panel/dashboard')) ? 'bg-cian' : 'opacity-50' }}" href="{{ route('panel.dashboard') }}">
                <img src="{{ asset('img/admin/arrow-menu.svg') }}" width="16" class="f-invert {{ (request()->is('panel/dashboard')) ? 'opacity-100' : 'opacity-50' }} me-2">
                Dashboard
            </a>
        </li>

        <li class="mb-2">
            <a href="{{ route('panel.orders.index') }}" class="d-block mb-1 py-2 px-3 br-10 text-white {{ request() -> is('panel/pedidos*') ? 'bg-cian' : 'opacity-50' }}">
                <img src="{{ asset('img/admin/arrow-menu.svg') }}" width="16" class="f-invert {{ request() -> is('panel/pedidos') ? 'opacity-100' : 'opacity-50' }} me-2">
                Pedidos
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('panel.clients') }}" class="d-block mb-1 py-2 px-3 br-10 text-white {{ (request()->is('panel/clientes')) ? 'bg-cian' : 'opacity-50' }}">
                <img src="{{ asset('img/admin/arrow-menu.svg') }}" width="16" class="f-invert {{ (request()->is('panel/clientes')) ? 'opacity-100' : 'opacity-50' }} me-2">
                Clientes
            </a>
        </li>
        <li class="mb-2">
            <a class="d-block mb-1 py-2 px-3 br-10 text-white {{ request()->is('panel/envios*') ? 'active' : 'opacity-50' }}" onclick="$(this).next().slideToggle(); $(this).toggleClass('active')">
                <img src="{{ asset('img/admin/arrow-menu.svg') }}" width="16" class="f-invert {{ request()->is('panel/envios*') ? 'opacity-100' : 'opacity-50' }} me-2">
                Envíos
            </a>

            <ul class="list-unstyled ps-4 text-muted" {!! request()->is('panel/envios*') ? '' : 'style="display: none;"' !!}>
                <li>
                    <a href="{{ route('panel.shippings.index') }}" class="d-block py-2 px-3 br-10 {{ (request()->is('panel/envios')) ? 'bg-cian text-white' : 'text-muted' }}">• &nbsp;Listado de solicitudes</a>
                </li>
                <li>
                    <a href="{{ route('panel.shippings.create') }}" class="d-block py-2 px-3 br-10 {{ (request()->is('panel/envios/crear')) ? 'bg-cian text-white' : 'text-muted' }}">• &nbsp;Crear solicitud</a>
                </li>
            </ul>
        </li>
        <li class="mb-2">
            <a href="{{ route('panel.banners') }}" class="d-block mb-1 py-2 px-3 br-10 text-white {{ request() -> is('panel/banners') ? 'bg-cian' : 'opacity-50' }}">
                <img src="{{ asset('img/admin/arrow-menu.svg') }}" width="16" class="f-invert {{ request() -> is('panel/banners') ? 'opacity-100' : 'opacity-50' }} me-2">
                Banners
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('panel.my-business') }}" class="d-block mb-1 py-2 px-3 br-10 text-white {{ (request()->is('panel/mi-tienda')) ? 'bg-cian' : 'opacity-50' }}">
                <img src="{{ asset('img/admin/arrow-menu.svg') }}" width="16" class="f-invert {{ (request()->is('panel/mi-tienda')) ? 'opacity-100' : 'opacity-50' }} me-2">
                Mi tienda
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('panel.profile') }}" class="d-block mb-1 py-2 px-3 br-10 text-white {{ (request()->is('panel/perfil')) ? 'bg-cian' : 'opacity-50' }}">
                <img src="{{ asset('img/admin/arrow-menu.svg') }}" width="16" class="f-invert {{ (request()->is('panel/perfil')) ? 'opacity-100' : 'opacity-50' }} me-2">
                Perfil
            </a>
        </li>
        <li class="mb-2">
            <a class="d-block mb-1 py-2 px-3 br-10 text-white opacity-50" href="{{ route('logout') }}" onclick="event.preventDefault(); $('form.logout').submit();">
                <img src="{{ asset('img/admin/arrow-menu.svg') }}" width="16" class="f-invert opacity-50 me-2">
                Cerrar sesión
            </a>
        </li>
    </ul>
</nav>

<div class="p-4 d-flex align-items-center position-absolute bottom-0 start-0 w-100 bg-dark-2">
    <div class="ratio ratio-1x1 me-3 bg-img-contain bg-white rounded-3" style="background-image: url({{ asset(Auth::user() -> shop -> logo) }}); width: 40px"></div>
    <div class="lh-1">
        <span class="fs-14 text-white">{{ Auth::user() -> shop -> shop_name }}</span><br>
        <span class="fs-12 text-muted">de {{ Auth::user() -> name }}</span>
    </div>
    <div class="text-end flex-fill">
        @if ( Auth::user() -> shop -> domain && Auth::user() -> shop -> domain_status == 1 )
            @php $url = 'https://' . Auth::user() -> shop -> domain; @endphp
        @else
            @php $url = url('/') . '/' . Auth::user() -> shop -> slug; @endphp
        @endif
        <a href="{{ $url }}" target="_blank"><img src="{{ asset('img/panel/ico-link.svg') }}" width="16" height="16" class="f-invert opacity-50"></a>
    </div>
</div>