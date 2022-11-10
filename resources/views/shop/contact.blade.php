<x-shop-layout shop="{{ $shop -> slug }}">
	<div class="container-fluid contactPage">
		<div class="row">
			<div class="col-sm-4 d-none d-sm-block bg-img" style="background-image: url({{ asset('img/shop/contact-bg.jpg') }});"></div>
			<div class="col-sm-8 position-relative">

				<div class="bg-dark p-sm-5 text-white info">
					<div class="p-sm-5 p-4">
						@if ( $shop -> whatsapp )
							<p>
								<strong>Teléfono:</strong><br>
								{{ $shop -> whatsapp }}
							</p>
						@endif
						<p class="m-0">
							<strong>Correo Electrónico</strong><br>
							{{ $shop -> shop_mail ?? $shop -> user -> email }}
						</p>
					</div>
				</div>

				<div class="row py-sm-5">
					<div class="col-sm-7 offset-sm-3 py-5">
						<h2 class="fs-42 fw-700 mb-5">Contacto.</h2>

						@livewire('shop.contact', [$shop])
					</div>
				</div>
			</div>
		</div>
	</div>
</x-shop-layout>