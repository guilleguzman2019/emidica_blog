<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.css" integrity="sha512-Woz+DqWYJ51bpVk5Fv0yES/edIMXjj3Ynda+KWTIkGoynAMHrqTcDUQltbipuiaD5ymEo9520lyoVOo9jCQOCA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ rand() }}">

        @livewireStyles
    </head>
    <body>

        @if ( Auth::user() -> user_type == 4 )
            @if ( ! Auth::user() -> suscriber -> voucher || ! Auth::user() -> suscriber -> status || ! Auth::user() -> shop -> categories || ( ! Auth::user() -> shop -> cash && ! Auth::user() -> shop -> bank && ! Auth::user() -> shop -> mpago ) )

                @livewire('panel.complete-info-shop')

            @else
                <header class="d-flex d-sm-none p-3 justify-content-between align-items-center">
                    <button class="bg-transparent border-0 p-0 m-0" style="width: 25px;" onclick="$('aside').toggleClass('show')">
                        <span class="d-block mb-1 bg-white bg-opacity-50 rounded-pill" style="height: 3px;"></span>
                        <span class="d-block mb-1 bg-white bg-opacity-10 rounded-pill" style="height: 3px;"></span>
                        <span class="d-block bg-white bg-opacity-10 rounded-pill" style="height: 3px;"></span>
                    </button>

                    <img src="{{ asset('img/logo.svg') }}" height="25">
                </header>

                <aside class="position-fixed h-100 bg-dark-2 top-0">
                    @include('partials.panel.menu')
                </aside>

                <main class="text-white">
                    {{ $slot }}
                </main>
            @endif

        @else

            <header class="d-flex d-sm-none p-3 justify-content-between align-items-center">
                <button class="bg-transparent border-0 p-0 m-0" style="width: 25px;" onclick="$('aside').toggleClass('show')">
                    <span class="d-block mb-1 bg-white bg-opacity-50 rounded-pill" style="height: 3px;"></span>
                    <span class="d-block mb-1 bg-white bg-opacity-10 rounded-pill" style="height: 3px;"></span>
                    <span class="d-block bg-white bg-opacity-10 rounded-pill" style="height: 3px;"></span>
                </button>

                <img src="{{ asset('img/logo.svg') }}" height="25">
            </header>

            <aside class="position-fixed h-100 bg-dark-2 top-0">
                @include('partials.admin.menu')
            </aside>

            <main class="text-white">
                {{ $slot }}
            </main>

        @endif

        <form class="logout" method="POST" action="{{ route('logout') }}">
            @csrf
        </form>

        @stack('modals')

        @livewireScripts

        @if ( Auth::user() -> user_type == 4 )
            <a href="https://wa.me/5493515738378" target="_blank" class="d-block position-fixed bottom-0 end-0 mb-3 me-3"><img src="{{ asset('img/panel/ico-wa-color.svg') }}" width="48" height="48"></a>
        @endif

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="{{ asset('js/app.js') }}?v={{ rand() }}" defer></script>

        @stack('scripts')
    </body>
</html>
