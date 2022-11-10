<div class="p-sm-4 px-4 py-3 border-bottom-dashed mb-2 text-center">
    <img src="{{ asset('img/logo.svg') }}" width="130" class="d-none d-sm-block">

    <div class="d-flex d-sm-none justify-content-between fs-14 text-uppercase align-items-center fw-600 text-white">
        Menú

        <button class="bg-transparent border-0 p-0 m-0 fs-24 text-white lh-1" onclick="$('aside').toggleClass('show')">&times;</button>
    </div>
</div>

<nav class="px-3 py-4">
    <ul class="list-unstyled m-0 fs-14">
        <li class="mb-2">
            <a class="d-block mb-1 py-2 px-3 br-10 text-white {{ (request()->is('admin/dashboard')) ? 'bg-cian' : 'opacity-50' }}" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('img/admin/arrow-menu.svg') }}" width="16" class="f-invert {{ (request()->is('admin/dashboard')) ? 'opacity-100' : 'opacity-50' }} me-2">
                Dashboard
            </a>
        </li>

        @if ( Auth::user() -> user_type == 1 || Auth::user() -> user_type == 5 )
            <li class="mb-2">
                <a class="d-block mb-1 py-2 px-3 br-10 text-white {{ (request()->is('admin/productos*') || request()->is('admin/marcas') || request()->is('admin/categorias') || request()->is('admin/etiquetas')) ? 'active' : 'opacity-50' }}" onclick="$(this).next().slideToggle(); $(this).toggleClass('active')">
                    <img src="{{ asset('img/admin/arrow-menu.svg') }}" width="16" class="f-invert {{ (request()->is('admin/productos*') || request()->is('admin/marcas') || request()->is('admin/categorias')) ? 'opacity-100' : 'opacity-50' }} me-2">
                    Entradas
                </a>

                <ul class="list-unstyled ps-4 text-muted" {!! (request()->is('admin/productos*') || request()->is('admin/marcas') || request()->is('admin/categorias') || request()->is('admin/etiquetas')) ? '' : 'style="display: none;"' !!}>
                    <li>
                        <a href="{{ route('admin.post.index') }}" class="d-block py-2 px-3 br-10 {{ (request()->is('admin/productos')) ? 'bg-cian text-white' : 'text-muted' }}">• &nbsp;Listado de Entradas</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.post.create') }}" class="d-block py-2 px-3 br-10 {{ (request()->is('admin/productos/agregar')) ? 'bg-cian text-white' : 'text-muted' }}">• &nbsp;Crear Entrada</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categoriesBlog') }}" class="d-block py-2 px-3 br-10 {{ (request()->is('admin/categorias')) ? 'bg-cian text-white' : 'text-muted' }}">• &nbsp;Categorías</a>
                    </li>

                    <li>
                        <a href="{{ route('admin.tagsBlog') }}" class="d-block py-2 px-3 br-10 {{ (request()->is('admin/categorias')) ? 'bg-cian text-white' : 'text-muted' }}">• &nbsp;Etiquetas</a>
                    </li>

                </ul>
            </li>
        @endif

        @if ( Auth::user() -> user_type == 1 || Auth::user() -> user_type == 5 )
            <li class="mb-2">
                <a class="d-block mb-1 py-2 px-3 br-10 text-white {{ (request()->is('admin/productos*') || request()->is('admin/marcas') || request()->is('admin/categorias') || request()->is('admin/etiquetas')) ? 'active' : 'opacity-50' }}" onclick="$(this).next().slideToggle(); $(this).toggleClass('active')">
                    <img src="{{ asset('img/admin/arrow-menu.svg') }}" width="16" class="f-invert {{ (request()->is('admin/productos*') || request()->is('admin/marcas') || request()->is('admin/categorias')) ? 'opacity-100' : 'opacity-50' }} me-2">
                    Productos
                </a>

                <ul class="list-unstyled ps-4 text-muted" {!! (request()->is('admin/productos*') || request()->is('admin/marcas') || request()->is('admin/categorias') || request()->is('admin/etiquetas')) ? '' : 'style="display: none;"' !!}>
                    <li>
                        <a href="{{ route('admin.products.index') }}" class="d-block py-2 px-3 br-10 {{ (request()->is('admin/productos')) ? 'bg-cian text-white' : 'text-muted' }}">• &nbsp;Listado de productos</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.create') }}" class="d-block py-2 px-3 br-10 {{ (request()->is('admin/productos/agregar')) ? 'bg-cian text-white' : 'text-muted' }}">• &nbsp;Crear producto</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories') }}" class="d-block py-2 px-3 br-10 {{ (request()->is('admin/categorias')) ? 'bg-cian text-white' : 'text-muted' }}">• &nbsp;Categorías</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.tags') }}" class="d-block py-2 px-3 br-10 {{ (request()->is('admin/etiquetas')) ? 'bg-cian text-white' : 'text-muted' }}">• &nbsp;Etiquetas</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.brands') }}" class="d-block py-2 px-3 br-10 {{ (request()->is('admin/marcas')) ? 'bg-cian text-white' : 'text-muted' }}">• &nbsp;Marcas</a>
                    </li>
                </ul>
            </li>
        @endif

        @if ( Auth::user() -> user_type == 1 || Auth::user() -> user_type == 2 || Auth::user() -> user_type == 3 || Auth::user() -> user_type == 8 )
            <li class="mb-2">
                <a class="d-block mb-1 py-2 px-3 br-10 text-white {{ (request()->is('admin/tiendas*')) ? 'active' : 'opacity-50' }}" onclick="$(this).next().slideToggle(); $(this).toggleClass('active')">
                    <img src="{{ asset('img/admin/arrow-menu.svg') }}" width="16" class="f-invert {{ (request()->is('admin/tiendas*')) ? 'opacity-100' : 'opacity-50' }} me-2">
                    Tiendas
                </a>

                <ul class="list-unstyled ps-4 text-muted" {!! request()->is('admin/tiendas*') ? '' : 'style="display: none;"' !!}>
                    <li>
                        <a href="{{ route('admin.shops.index') }}" class="d-block py-2 px-3 br-10 {{ (request()->is('admin/tiendas')) ? 'bg-cian text-white' : 'text-muted' }}">• &nbsp;Tiendas activas</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.shops.deleted') }}" class="d-block py-2 px-3 br-10 {{ (request()->is('admin/tiendas/eliminadas')) ? 'bg-cian text-white' : 'text-muted' }}">• &nbsp;Tiendas eliminadas</a>
                    </li>
                </ul>
            </li>
        @endif

        @if ( Auth::user() -> user_type == 1 || Auth::user() -> user_type == 2 || Auth::user() -> user_type == 3 || Auth::user() -> user_type == 6 || Auth::user() -> user_type == 7 )
            <li class="mb-2">
                <a class="d-block mb-1 py-2 px-3 br-10 text-white {{ (request()->is('admin/pedidos*') || request()->is('admin/envios*')) ? 'active' : 'opacity-50' }}" onclick="$(this).next().slideToggle(); $(this).toggleClass('active')">
                    <img src="{{ asset('img/admin/arrow-menu.svg') }}" width="16" class="f-invert {{ (request()->is('admin/usuarios')) ? 'opacity-100' : 'opacity-50' }} me-2">
                    Pedidos
                </a>

                <ul class="list-unstyled ps-4 text-muted" {!! (request()->is('admin/pedidos*') || request()->is('admin/envios*')) ? '' : 'style="display: none;"' !!}>
                    @if ( Auth::user() -> user_type != 6 && Auth::user() -> user_type != 7 )
                        <li><a href="{{ route('admin.orders') }}" class="d-block py-2 px-3 br-10 {{ (request()->is('admin/pedidos')) ? 'bg-cian text-white' : 'text-muted' }}">• &nbsp;Listado de pedidos</a></li>
                    @endif
                    
                    <li><a href="{{ route('admin.shippings') }}" class="d-block py-2 px-3 br-10 {{ (request()->is('admin/envios')) ? 'bg-cian text-white' : 'text-muted' }}">• &nbsp;Solicitudes de envío</a></li>
                </ul>
            </li>
        @endif

        @if ( Auth::user() -> user_type == 1 || Auth::user() -> user_type == 8 )
            <li class="mb-2">
                <a class="d-block mb-1 py-2 px-3 br-10 text-white {{ (request()->is('admin/call-to-actions') || request()->is('admin/banners')) ? 'active' : 'opacity-50' }}" onclick="$(this).next().slideToggle(); $(this).toggleClass('active')">
                    <img src="{{ asset('img/admin/arrow-menu.svg') }}" width="16" class="f-invert {{ (request()->is('admin/call-to-actions') || request()->is('admin/banners')) ? 'opacity-100' : 'opacity-50' }} me-2">
                    Marketing
                </a>

                <ul class="list-unstyled ps-4 text-muted" {!! (request()->is('admin/call-to-actions') || request()->is('admin/banners')) ? '' : 'style="display: none;"' !!}>
                    <li><a href="{{ route('admin.cta') }}" class="d-block py-2 px-3 br-10 {{ (request()->is('admin/call-to-actions')) ? 'bg-cian text-white' : 'text-muted' }}">• &nbsp;CTAs</a></li>
                    <li><a href="{{ route('admin.banners') }}" class="d-block py-2 px-3 br-10 {{ (request()->is('admin/banners')) ? 'bg-cian text-white' : 'text-muted' }}">• &nbsp;Banners</a></li>
                </ul>
            </li>
        @endif

        @if ( Auth::user() -> user_type == 1 )
            <li class="mb-2">
                <a class="d-block mb-1 py-2 px-3 br-10 text-white {{ (request()->is('admin/usuarios')) ? 'bg-cian' : 'opacity-50' }}" href="{{ route('admin.users') }}">
                    <img src="{{ asset('img/admin/arrow-menu.svg') }}" width="16" class="f-invert {{ (request()->is('admin/usuarios')) ? 'opacity-100' : 'opacity-50' }} me-2">
                    Usuarios
                </a>
            </li>
        @endif

        @if ( Auth::user() -> user_type == 1 )
            <li class="mb-2">
                <a class="d-block mb-1 py-2 px-3 br-10 text-white {{ (request()->is('admin/configuracion')) ? 'bg-cian' : 'opacity-50' }}" href="{{ route('admin.settings') }}">
                    <img src="{{ asset('img/admin/arrow-menu.svg') }}" width="16" class="f-invert {{ (request()->is('admin/configuracion')) ? 'opacity-100' : 'opacity-50' }} me-2">
                    Configuración
                </a>
            </li>
        @endif

        <li class="mb-2">
            <a class="d-block mb-1 py-2 px-3 br-10 text-white {{ (request()->is('admin/perfil')) ? 'bg-cian' : 'opacity-50' }}" href="{{ route('admin.profile') }}">
                <img src="{{ asset('img/admin/arrow-menu.svg') }}" width="16" class="f-invert {{ (request()->is('admin/perfil')) ? 'opacity-100' : 'opacity-50' }} me-2">
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