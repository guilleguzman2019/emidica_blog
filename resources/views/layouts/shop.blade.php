<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ $shop -> shop_name }} {{ $titlePage ?? '' }}</title>

		<meta property="og:title" content="{{ $shop -> meta_title ? $shop -> meta_title : $shop -> shop_name }} {{ $titlePage ?? '' }}">
		<meta property="og:type" content="website">
		<meta property="og:url" content="{{ url('/') }}{{ $_SERVER["REQUEST_URI"] }}">
		<meta property="og:image" content="{{ (request()->is('*/producto/*')) ? ($urlImageProduct ?? '') : '' }}">

		{{ $ogTags ?? '' }}

		<meta name="title" content="{{ $shop -> meta_title ? $shop -> meta_title : $shop -> shop_name }}">
		<meta name="description" content="{{ $shop -> meta_description ?? '' }}">
		<meta name="keywords" content="{{ $shop -> meta_keywords ?? '' }}">
		<meta name="author" content="Emidica" />

		<!-- Styles -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/shop.css') }}?v={{ rand() }}">

		<link rel="shortcut icon" href="{{ asset($shop -> logo) }}">

		@livewireStyles

		@if ( $shop -> facebook_pixel )
			{!! $shop -> facebook_pixel !!}
		@endif

		@if ( $shop -> google_analytics )
			{!! $shop -> google_analytics !!}
		@endif
	</head>
	<body>

		@if ( $settings -> message_status )
			<div class="bg-black text-white fs-13 text-center py-2">
				<div class="container">{{ $settings -> message_top }}</div>
			</div>
		@endif

		@include('partials.shop.header')

		{{ $slot }}

		@include('partials.shop.footer')

		@stack('modals')

		@if ( $shop -> whatsapp )
			<a href="https://wa.me/{{ $shop -> whatsapp }}" target="_blank" class="d-block position-fixed bottom-0 end-0 mb-3 me-3"><img src="{{ asset('img/panel/ico-wa-color.svg') }}" width="48" height="48"></a>
		@endif

		<!-- Scripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="{{ asset('js/zoom-image.js') }}" defer></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
		<script src="{{ asset('js/main.js') }}?v={{ rand() }}" defer></script>

		@livewireScripts

		@stack('scripts')
	</body>
</html>