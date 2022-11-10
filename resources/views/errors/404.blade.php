@extends('errors::layout')

@section('message')
	<div class="container pt-5 mt-5">
		<div class="px-5">
			<img src="{{ asset('img/404-cart.svg') }}" class="d-block mx-auto img-fluid" style="max-width: 550px">
		</div>
	</div>
	<div class="text-center py-5">
		<div class="px-4">
			<p class="fs-26 fs-sm-21 mb-5">Página no encontrada</p>
		</div>
	</div>
@endsection