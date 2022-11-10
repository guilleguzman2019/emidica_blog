<div>
	
	<aside class="position-fixed overflow-auto h-100 bg-dark-4 welcome">
		@include('partials.panel.steps')
	</aside>

	<main class="text-white">

		<div class="row justify-content-center pt-sm-5 mx-0">
			<div class="col-sm-8 pt-5">

				@if ( $step == 1 )

					<h1 class="fs-18 fw-400">Elige el plan para tu tienda <img src="{{ asset('img/panel/ico-info.svg') }}" width="12" class="f-invert" data-bs-toggle="tooltip" data-bs-title="Para más información visita emidica.com"></h1>
					<p class="text-white-50 fs-14">Antes de poder comenzar a aprovechar todos los beneficios, debes realizar algunos pasos. Es simple y rápido, en tan solo tres pasos ya estarás vendiendo con nosotros.</p>
					<p class="text-white-50 fs-14">Para empezar a vender, debes abonar la suscripción. Una vez hecho, envía tu comprobante para que podamos darte el alta.</p>

					<div class="row gx-sm-5">
						<div class="col-sm-6 mb-3">
							<div class="selectPlan p-4 border-dashed rounded-3">
								<div class="text-start d-flex align-items-start">
									<div class="ico"><svg class="me-3" width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M18 10V20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20V10H18Z" fill="currentColor"/><path opacity="0.3" d="M11 10V17H6V10H4V20C4 20.6 4.4 21 5 21H12C12.6 21 13 20.6 13 20V10H11Z" fill="currentColor"/><path opacity="0.3" d="M10 10C10 11.1 9.1 12 8 12C6.9 12 6 11.1 6 10H10Z" fill="currentColor"/><path opacity="0.3" d="M18 10C18 11.1 17.1 12 16 12C14.9 12 14 11.1 14 10H18Z" fill="currentColor"/><path opacity="0.3" d="M14 4H10V10H14V4Z" fill="currentColor"/><path opacity="0.3" d="M17 4H20L22 10H18L17 4Z" fill="currentColor"/><path opacity="0.3" d="M7 4H4L2 10H6L7 4Z" fill="currentColor"/><path d="M6 10C6 11.1 5.1 12 4 12C2.9 12 2 11.1 2 10H6ZM10 10C10 11.1 10.9 12 12 12C13.1 12 14 11.1 14 10H10ZM18 10C18 11.1 18.9 12 20 12C21.1 12 22 11.1 22 10H18ZM19 2H5C4.4 2 4 2.4 4 3V4H20V3C20 2.4 19.6 2 19 2ZM12 17C12 16.4 11.6 16 11 16H6C5.4 16 5 16.4 5 17C5 17.6 5.4 18 6 18H11C11.6 18 12 17.6 12 17Z" fill="currentColor"/></svg></div>

									<div>
										<h2 class="fs-16 fw-400">Plan Basic</h2>
										<h1 class="d-flex align-items-center"><span class="fs-18">$</span>3900</h1>
										<ul class="fs-14 text-muted ps-0 m-0 list-unstyled">
											<li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Acceso a miles productos para ofrecer a tus clientes.</li>
		                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Podrás compartirlo con todas las personas que quieras.</li>
		                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Puede cancelar la suscripción cuando desees</li>
		                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Tienda personalizada y en línea para vender las 24hs.</li>
		                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3" width="24" height="24"> Métodos de pago en efectivo.</li>
		                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-gray" width="24" height="24"><del> Método de pago por transferencia.</del></li>
		                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-gray" width="24" height="24"><del> Método de pago con tarjetas de crédito y débito.</del></li>
		                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-gray" width="24" height="24"><del> Método de pago a través de PagoFacil, Rapipago, etc.</del></li>
		                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-gray" width="24" height="24"><del> Envío de productos directo a tus clientes.</del></li>
		                                    <li class="mb-3 d-flex"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-gray" width="24" height="24"><del> Dominio personalizado (ej.: latiendadepaula.com).</del></li>
										</ul>
									</div>
								</div>

								<button class="btn btn-dark d-block mx-auto" wire:click="$set('plan', 1)">Elegir plan</button>
							</div>
						</div>
						<div class="col-sm-6 mb-3">
							<div class="selectPlan p-4 border-dashed rounded-3" style="background:#f0d773;">
								<div class="text-start d-flex align-items-start">
									<div class="ico f-invert"><svg class="me-3" width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M4.05424 15.1982C8.34524 7.76818 13.5782 3.26318 20.9282 2.01418C21.0729 1.98837 21.2216 1.99789 21.3618 2.04193C21.502 2.08597 21.6294 2.16323 21.7333 2.26712C21.8372 2.37101 21.9144 2.49846 21.9585 2.63863C22.0025 2.7788 22.012 2.92754 21.9862 3.07218C20.7372 10.4222 16.2322 15.6552 8.80224 19.9462L4.05424 15.1982ZM3.81924 17.3372L2.63324 20.4482C2.58427 20.5765 2.5735 20.7163 2.6022 20.8507C2.63091 20.9851 2.69788 21.1082 2.79503 21.2054C2.89218 21.3025 3.01536 21.3695 3.14972 21.3982C3.28408 21.4269 3.42387 21.4161 3.55224 21.3672L6.66524 20.1802L3.81924 17.3372ZM16.5002 5.99818C16.2036 5.99818 15.9136 6.08615 15.6669 6.25097C15.4202 6.41579 15.228 6.65006 15.1144 6.92415C15.0009 7.19824 14.9712 7.49984 15.0291 7.79081C15.0869 8.08178 15.2298 8.34906 15.4396 8.55884C15.6494 8.76862 15.9166 8.91148 16.2076 8.96935C16.4986 9.02723 16.8002 8.99753 17.0743 8.884C17.3484 8.77046 17.5826 8.5782 17.7474 8.33153C17.9123 8.08486 18.0002 7.79485 18.0002 7.49818C18.0002 7.10035 17.8422 6.71882 17.5609 6.43752C17.2796 6.15621 16.8981 5.99818 16.5002 5.99818Z" fill="currentColor"/><path d="M4.05423 15.1982L2.24723 13.3912C2.15505 13.299 2.08547 13.1867 2.04395 13.0632C2.00243 12.9396 1.9901 12.8081 2.00793 12.679C2.02575 12.5498 2.07325 12.4266 2.14669 12.3189C2.22013 12.2112 2.31752 12.1219 2.43123 12.0582L9.15323 8.28918C7.17353 10.3717 5.4607 12.6926 4.05423 15.1982ZM8.80023 19.9442L10.6072 21.7512C10.6994 21.8434 10.8117 21.9129 10.9352 21.9545C11.0588 21.996 11.1903 22.0083 11.3195 21.9905C11.4486 21.9727 11.5718 21.9252 11.6795 21.8517C11.7872 21.7783 11.8765 21.6809 11.9402 21.5672L15.7092 14.8442C13.6269 16.8245 11.3061 18.5377 8.80023 19.9442ZM7.04023 18.1832L12.5832 12.6402C12.7381 12.4759 12.8228 12.2577 12.8195 12.032C12.8161 11.8063 12.725 11.5907 12.5653 11.4311C12.4057 11.2714 12.1901 11.1803 11.9644 11.1769C11.7387 11.1736 11.5205 11.2583 11.3562 11.4132L5.81323 16.9562L7.04023 18.1832Z" fill="currentColor"/></svg></div>

									<div class="text-dark">
										<h2 class="fs-16 fw-400">Plan Premium</h2>
										<h1 class="d-flex align-items-center"><span class="fs-18">$</span>6900</h1>
										<ul class="fs-14 text-white ps-0 m-0 list-unstyled">
											<li class="mb-3 d-flex f-invert"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-brightness" width="24" height="24"> Acceso a miles productos para ofrecer a tus clientes.</li>
											<li class="mb-3 d-flex f-invert"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-brightness" width="24" height="24"> Podrás compartirlo con todas las personas que quieras.</li>
											<li class="mb-3 d-flex f-invert"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-brightness" width="24" height="24"> Puede cancelar la suscripción cuando desees</li>
											<li class="mb-3 d-flex f-invert"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-brightness" width="24" height="24"> Tienda personalizada y en línea para vender las 24hs.</li>
											<li class="mb-3 d-flex f-invert"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-brightness" width="24" height="24"> Métodos de pago en efectivo.</li>
											<li class="mb-3 d-flex f-invert"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-brightness" width="24" height="24"> Método de pago por transferencia.</li>
											<li class="mb-3 d-flex f-invert"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-brightness" width="24" height="24"> Método de pago con tarjetas de crédito y débito.</li>
											<li class="mb-3 d-flex f-invert"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-brightness" width="24" height="24"> Método de pago a través de PagoFacil, Rapipago, etc.</li>
											<li class="mb-3 d-flex f-invert"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-brightness" width="24" height="24"> Envío de productos directo a tus clientes.</li>
											<li class="mb-3 d-flex f-invert"><img src="{{ asset('img/landing/check.svg') }}" class="float-start me-3 f-brightness" width="24" height="24"> Dominio personalizado (ej.: latiendadepaula.com).</li>
										</ul>
									</div>
								</div>

								<button class="btn btn-dark d-block mx-auto" wire:click="$set('plan', 2)">Elegir plan</button>
							</div>
						</div>
					</div>
{{--
					<div class="row gx-sm-5">
						<div class="col-sm-6">
							<form id="form-checkout" class="bg-light mt-4 p-4 br-10">

								<h3 class="fs-16 fw-600 text-dark">Datos personales</h3>
								<input class="form-control fs-14 border mb-3" type="email" id="form-checkout__cardholderEmail" required />
								<div class="row">
									<div class="col-sm-4 mb-3">
										<select class="form-select fs-14 border" id="form-checkout__identificationType" required></select>
									</div>
									<div class="col-sm-8 mb-3">
										<input class="form-control fs-14 border" type="text" id="form-checkout__identificationNumber" required />
									</div>
								</div>

								<hr class="border-bottom-dashed mt-0">

								<h3 class="fs-16 fw-600 text-dark">Detalles de la tarjeta</h3>
								<input class="form-control fs-14 border mb-3" type="text" id="form-checkout__cardholderName" required />
								<div class="form-control fs-14 border mb-3" style="height: 38px" id="form-checkout__cardNumber"></div>
								<div class="row">
									<div class="col-sm-6 mb-3">
										<div class="form-control fs-14 border" style="height: 38px" id="form-checkout__expirationDate"></div>
									</div>
									<div class="col-sm-6 mb-3">
										<div class="form-control fs-14 border" style="height: 38px" id="form-checkout__securityCode"></div>
									</div>
								</div>
								<select style="float: left; height: 1px; opacity: 0; width:1px;" id="form-checkout__issuer" required></select>
								<select style="float: left; height: 1px; opacity: 0; width:1px;" id="form-checkout__installments" required></select>

								<div class="d-flex justify-content-between align-items-center">
									<div>
										<button class="btn btn-success px-4 fs-14" type="submit" id="form-checkout__submit">Pagar</button>
										<progress value="0" class="progress-bar d-none">Carregando...</progress>
									</div>

									<div class="d-flex align-items-center text-black-50" style="font-size: 9px">
										Powered by
										<img src="{{ asset('img/shop/ico-mpago2.svg') }}" width="48" class="ms-2">
									</div>
								</div>
							</form>
						</div>
					</div>
								--}}

					@if ( $plan )

						<button onclick="window.open('{{ ($plan == 1) ? 'https://www.mercadopago.com.ar/subscriptions/checkout?preapproval_plan_id=2c9380848245a71b01824b5ee29a02c7' : 'https://www.mercadopago.com.ar/subscriptions/checkout?preapproval_plan_id=2c938084823ab6e701824b60320406fa' }}','_blank');" wire:loading.attr="disabled" class="btn btn-primary text-white px-5 mx-auto d-block border-0 py-2 rounded-3 mt-4">Abonar plan</button>

						@error('plan')
							<span class="text-danger">{{ $message }}</span>
						@enderror

						<div class="my-5 bg-dark-3 p-4 rounded-3">
							<h3 class="fs-16">Enviar comprobante</h3>
							<p class="fs-14 text-white-50">Una vez que realices el pago, adjunta aquí tu comprobante para continuar con el proceso de alta.</p>
							<div class="input-group input-group-sm">
								<input type="file" accept=".png,.jpg,.jpeg,.pdf" class="form-control border-white" wire:model="voucher">
								<button class="btn btn-info text-white" type="button" wire:click="saveStep1" wire:loading.attr="disabled" wire:target="voucher, saveStep1" id="button-addon2">Enviar comprobante</button>
							</div>

							@error('voucher')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
					@endif

				@elseif ( $step == 2 )

					<h1 class="fs-18 fw-400">Información de tu tienda</h1>
					<p class="text-white-50 mb-5 fs-14">Completa todos los datos para que tus clientes puedan conocer de tu tienda.</p>

					@if ( ! $firstInfo )
						<div class="row gx-sm-5">
							<div class="col-sm-5">
								<div class="row">
									<div class="col-sm-6">
										<label class="fs-14 fw-400 mb-3">Logo de cabecera</label>
										<div class="ratio ratio-1x1 mb-2 w-75 mx-auto bg-white bg-img-contain rounded-4" style="background-image: url({{ asset($logo ? $logo -> temporaryUrl() : ($logo_actual ?? 'img/admin/default.png')) }});">
											<div>
												<a onclick="$('.logoUpload').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
											</div>
										</div>
										<input class="logoUpload float-start" type="file" accept=".jpg,.png,.jpeg" wire:model.defer="logo" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">

										@error('logo')
											<span class="fs-12 text-danger">{{ $message }}</span>
										@enderror
									</div>
									<div class="col-sm-6">
										<label class="fs-14 fw-400 mb-3">Logo de pie de página</label>
										<div class="ratio ratio-1x1 mb-2 w-75 mx-auto bg-img-contain rounded-4" style="background-image: url({{ asset($logo_foot ? $logo_foot -> temporaryUrl() : ($logo_foot_actual ?? 'img/admin/default.png')) }});">
											<div>
												<a onclick="$('.logo_footUpload').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
											</div>
										</div>
										<input class="logo_footUpload float-start" type="file" accept=".jpg,.png,.jpeg" wire:model.defer="logo_foot" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">

										@error('logo_foot')
											<span class="fs-12 text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-12">
										<p class="fs-12 text-muted text-center mt-3 mb-4">Ten en cuenta que la cabera de la tienda es de fondo blanco, mientras el pie de página tiene fondo negro. Tampoco es obligatoria la carga del logo.</p>
									</div>
								</div>
							</div>

							<div class="col-sm-7">
								<label class="fs-14 fw-400 mb-3">Redes sociales</label>
								<div class="d-flex mb-3">
									<div class="bg-dark-2 rounded-3 px-3 lh-1 d-flex align-items-center me-2">
										<img src="{{ asset('img/landing/ico-fb.svg') }}" width="16" height="16" class="f-invert opacity-50">
									</div>
									<div class="input-group">
										<span class="input-group-text bg-dark-2 text-muted fs-14 border-dark">https://facebook.com/</span>
										<input class="form-control bg-transparent text-white" type="text" wire:model.defer="facebook">
									</div>
								</div>

								<div class="d-flex mb-3">
									<div class="bg-dark-2 rounded-3 px-3 lh-1 d-flex align-items-center me-2">
										<img src="{{ asset('img/landing/ico-ig.svg') }}" width="16" height="16" class="f-invert opacity-50">
									</div>
									<div class="input-group">
										<span class="input-group-text bg-dark-2 text-muted fs-14 border-dark">https://instagram.com/</span>
										<input class="form-control bg-transparent text-white" type="text" wire:model.defer="instagram">
									</div>
								</div>

								<div class="d-flex mb-3">
									<div class="bg-dark-2 rounded-3 px-3 lh-1 d-flex align-items-center me-2">
										<img src="{{ asset('img/landing/ico-wa.svg') }}" width="16" height="16" class="f-invert opacity-50">
									</div>
									<div class="input-group">
										<span class="input-group-text bg-dark-2 text-muted fs-14 border-dark">WhatsApp</span>
										<input class="form-control bg-transparent text-white" type="number" wire:model.defer="whatsapp" placeholder="54 9 011 1234 5678">
									</div>
								</div>

								<div class="mb-3">
									<div class="d-flex">
										<div class="bg-dark-2 rounded-3 px-3 lh-1 d-flex align-items-center me-2">
											<img src="{{ asset('img/panel/ico-email.svg') }}" width="16" height="16" class="f-invert opacity-50">
										</div>
										<div class="input-group">
											<span class="input-group-text bg-dark-2 text-muted fs-14 border-dark">Email</span>
											<input class="form-control bg-transparent text-white" type="mail" wire:model.defer="shop_mail">
										</div>
									</div>
									@error('shop_mail')
										<span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>


								<div class="text-end"><button class="btn btn-primary fs-14 px-4" wire:click="saveFirst" wire:loading.attr="disabled" wire:target="saveFirst">Siguiente<span class="spinner-border spinner-border-sm ms-2 position-relative" style="top:2px" wire:loading role="status" aria-hidden="true"></span></button></div>
							</div>
						</div>
					@elseif ( ! $sencondInfo )
						<h3 class="fs-18">Categorías</h3>
						<p class="text-white-50 fs-14">Elige las categorías que quieres vender.</p>

						<div class="row mb-3">
							@foreach ($categories as $category)
								<div class="col-md-2 col-4 text-center">
									<label>
										<div class="selectPlan d-block mx-auto p-4 border-dashed rounded-3 mb-2" wire:ignore.self onclick="$(this).toggleClass('active')">
											<div class="ico"><img src="{{ asset( $category -> ico ) }}" width="32" class="f-invert opacity-50"></div>
										</div>
										<span class="fs-12 text-uppercase text-white-50">{{ $category -> name }}</span>
										<input type="checkbox" wire:model.defer="categoriesShop.{{ $category -> id }}" value="{{ $category -> id }}" id="category{{ $category -> id }}" style="float: left; opacity: 0; height: 1px; width: 1px;">
									</label>
								</div>
							@endforeach
						</div>

						@error('categoriesShop')
							<p class="text-danger fs-14 m-0">{{ $message }}</p>
						@enderror

						<h3 class="fs-18 mt-5">Métodos de pago</h3>
						<p class="text-white-50 fs-14">Elige los métodos de pago que quieres utilizar para que tus clientes te abonen los productos.</p>
						<div class="row">
							<div class="col-md-2 col-4 text-center">
								<label>
									<div class="selectPlan d-block mx-auto p-4 border-dashed rounded-3 mb-2 {{ $cash ? 'active' : '' }}" wire:ignore.self onclick="$(this).toggleClass('active')">
										<div class="ico"><img src="{{ asset('img/panel/ico-cash.svg') }}" width="32" height="32" class="f-invert opacity-50"></div>
									</div>
									<span class="fs-12 text-uppercase text-white-50">Efectivo</span>
									<input type="checkbox" wire:model.defer="cash" value="1" style="float: left; opacity: 0; height: 1px; width: 1px;">
								</label>
							</div>

							@if ( Auth::user() -> suscriber -> status == 3 && Auth::user() -> suscriber -> plan == 2 )
								<div class="col-md-2 col-4 text-center">
									<label>
										<div class="selectPlan d-block mx-auto p-4 border-dashed rounded-3 mb-2 {{ $bank ? 'active' : '' }}" wire:ignore.self onclick="$(this).toggleClass('active')">
											<div class="ico"><img src="{{ asset('img/panel/ico-bank.svg') }}" width="32" height="32" class="f-invert opacity-50"></div>
										</div>
										<span class="fs-12 text-uppercase text-white-50">Transferencia</span>
										<input type="checkbox" wire:model="bank" value="1" style="float: left; opacity: 0; height: 1px; width: 1px;">
									</label>
								</div>
								<div class="col-md-2 col-4 text-center">
									<label>
										<div class="selectPlan d-block mx-auto p-4 border-dashed rounded-3 mb-2 {{ $mpago ? 'active' : '' }}" wire:ignore.self onclick="$(this).toggleClass('active')">
											<div class="ico"><img src="{{ asset('img/panel/ico-mp.svg') }}" width="32" height="32" class="f-gray opacity-50"></div>
										</div>
										<span class="fs-12 text-uppercase text-white-50">MercadoPago</span>
										<input type="checkbox" wire:model="mpago" value="1" style="float: left; opacity: 0; height: 1px; width: 1px;">
									</label>
								</div>
							@elseif ( ( Auth::user() -> suscriber -> status == 1 || Auth::user() -> suscriber -> status == 2 ) && Auth::user() -> suscriber -> plan == 2 )
								<div class="col-12">
									<p class="border-dashed border-warning p-3 rounded-3 mb-0 fs-14 mt-3 badge-light-warning">Tu pago está en proceso de verificación. Dentro de las próximas horas, te notificaremos por email el acceso a tus funcionalidades premium, entre las cuales se encuentran nuevos métodos de pago.</p>
								</div>
							@endif
						</div>

						@error('method_selected')
							<p class="text-danger fs-14 m-0 mt-3">{{ $message }}</p>
						@enderror

						<div class="row gx-sm-5">
							@if ( $bank == 1 )
								<div class="col-sm-6">
									<h4 class="fs-16 mt-5">Pago por transferencia</h4>
									<div class="row">
										<div class="col-md-6">
											<div class="mb-3">
												<label class="fs-14 mb-1 opacity-75">Nombre del banco<span class="text-danger fs-16">*</span></label>
												<input class="form-control bg-transparent text-white" type="text" wire:model.defer="bank_name">

												@error('bank_name')
													<p class="fs-14 text-danger m-0">{{ $message }}</p>
												@enderror
											</div>
										</div>
										<div class="col-md-6">
											<div class="mb-3">
												<label class="fs-14 mb-1 opacity-75">Titular de la cuenta<span class="text-danger fs-16">*</span></label>
												<input class="form-control bg-transparent text-white" type="text" wire:model.defer="bank_titular">

												@error('bank_titular')
													<p class="fs-14 text-danger m-0">{{ $message }}</p>
												@enderror
											</div>
										</div>
										<div class="col-md-6">
											<div class="mb-3">
												<label class="fs-14 mb-1 opacity-75">CUIT<span class="text-danger fs-16">*</span></label>
												<input class="form-control bg-transparent text-white" type="text" wire:model.defer="bank_cuit">

												@error('bank_cuit')
													<p class="fs-14 text-danger m-0">{{ $message }}</p>
												@enderror
											</div>
										</div>
										<div class="col-md-6">
											<div class="mb-3">
												<label class="fs-14 mb-1 opacity-75">Alias<span class="text-danger fs-16">*</span></label>
												<input class="form-control bg-transparent text-white" type="text" wire:model.defer="bank_alias">

												@error('bank_alias')
													<p class="fs-14 text-danger m-0">{{ $message }}</p>
												@enderror
											</div>
										</div>
										<div class="col-12">
											<div class="mb-3">
												<label class="fs-14 mb-1 opacity-75">CBU/CVU<span class="text-danger fs-16">*</span></label>
												<input class="form-control bg-transparent text-white" type="text" wire:model.defer="bank_cbu">

												@error('bank_cbu')
													<p class="fs-14 text-danger m-0">{{ $message }}</p>
												@enderror
											</div>
										</div>
									</div>
								</div>
							@endif

							@if ( $mpago == 1 )
								<div class="col-sm-6">
									<h4 class="fs-16 mt-5">Pago por MercadoPago</h4>

									<div class="mb-3">
										<label class="fs-14 mb-1 opacity-75">Public Key<span class="text-danger fs-16">*</span></label>
										<input class="form-control bg-transparent text-white" type="text" wire:model.defer="mp_public_key">

										@error('mp_public_key')
											<p class="fs-14 text-danger m-0">{{ $message }}</p>
										@enderror
									</div>

									<div class="mb-3">
										<label class="fs-14 mb-1 opacity-75">Access Token<span class="text-danger fs-16">*</span></label>
										<input class="form-control bg-transparent text-white" type="text" wire:model.defer="mp_access_token">

										@error('mp_access_token')
											<p class="fs-14 text-danger m-0">{{ $message }}</p>
										@enderror
									</div>
								</div>
							@endif
						</div>

						<h3 class="fs-18 mt-5">Métodos de envío</h3>
						<p class="text-white-50 fs-14 mb-4">Elige los métodos de envío que quieres que tus clientes tengan para elegir. Ten en cuenta que los pedidos con "envío a coordinar" te llegarán a tu domicilio y serás el responsable de repartir los mismos. Al mismo tiempo, con ese método, el costo del envío corre por tu cuenta.</p>
						<div class="row justify-content-center">
							@if ( Auth::user() -> suscriber -> status == 3 && Auth::user() -> suscriber -> plan == 2 )
								<div class="col-6 text-center">
									<label>
										<div class="selectPlan d-block p-4 border-dashed mx-auto rounded-3 mb-2 {{ $delivery_home ? 'active' : '' }}" wire:ignore.self onclick="$(this).toggleClass('active')">
											<div class="ico"><img src="{{ asset('img/panel/ico-truck.svg') }}" width="32" height="32" class="f-invert opacity-50"></div>
										</div>
										<span class="fs-12 text-uppercase text-white-50">Envío a domicilio</span>
										<input type="checkbox" wire:model.defer="delivery_home" value="1" style="float: left; opacity: 0; height: 1px; width: 1px;">
									</label>
								</div>
							@endif

							<div class="col-6 text-center">
								<label>
									<div class="selectPlan d-block mx-auto p-4 border-dashed rounded-3 mb-2 {{ $delivery_coordinate ? 'active' : '' }}" wire:ignore.self onclick="$(this).toggleClass('active')">
										<div class="ico"><img src="{{ asset('img/panel/ico-chat.svg') }}" width="32" height="32" class="f-invert opacity-50"></div>
									</div>
									<span class="fs-12 text-uppercase text-white-50">Envío a coordinar</span>
									<input type="checkbox" wire:model.defer="delivery_coordinate" value="1" style="float: left; opacity: 0; height: 1px; width: 1px;">
								</label>
							</div>

							@if ( ( Auth::user() -> suscriber -> status == 1 || Auth::user() -> suscriber -> status == 2 ) && Auth::user() -> suscriber -> plan == 2 )
								<div class="col-12">
									<p class="border-dashed border-warning p-3 rounded-3 mb-0 fs-14 mt-3 badge-light-warning">Tu pago está en proceso de verificación. Dentro de las próximas horas, te notificaremos por email el acceso a tus funcionalidades premium, entre las cuales se encuentra el envío a domicilio.</p>
								</div>
							@endif
						</div>

						@error('delivery_selected')
							<p class="text-danger fs-14 m-0 mt-3">{{ $message }}</p>
						@enderror

						<div class="text-end mt-4 mb-5"><button class="btn btn-primary fs-14 px-4" wire:click="saveSecond" wire:loading.attr="disabled" wire:target="saveSecond">Finalizar<span class="spinner-border spinner-border-sm ms-2 position-relative" style="top:2px" wire:loading role="status" aria-hidden="true"></span></button></div>
					@endif

				@elseif ( $step == 3 )
					<div class="text-center">
						<img src="{{ asset('img/panel/thanks.svg') }}" width="128" class="mb-3">
						<h3>¡Felicitaciones, ya tienes tu tienda lista!</h3>
						<p class="text-white-50 mt-4">¡Has completado toda la información correctamente!<br>
						Comparte la tienda en tus redes sociales con todos tus amigos para crear una comunidad increible <span class="text-white">💪🏼</span></p>

						<p class="my-5">Compartir<br><br>
							<a target="_blank" href="http://www.facebook.com/sharer.php?u={{ url('/') }}/{{ Auth::user() -> shop -> slug }}" class="mx-2 bg-dark-2 p-2 rounded-3"><img src="{{ asset('/img/panel/ico-fb-color.svg') }}" width="24" height="24"></a>
							<a target="_blank" href="http://twitter.com/share?text=¡Hola! Quiero compartir mi tienda contigo. Aquí tienes el acceso&url={{ url('/') }}/{{ Auth::user() -> shop -> slug }}" class="mx-2 bg-dark-2 p-2 rounded-3"><img src="{{ asset('/img/panel/ico-tt-color.svg') }}" width="24" height="24"></a>
							<a target="_blank" href="https://api.whatsapp.com/send?text=¡Hola! Quiero compartir mi tienda contigo. Aquí tienes el acceso {{ url('/') }}/{{ Auth::user() -> shop -> slug }}" class="mx-2 bg-dark-2 p-2 rounded-3"><img src="{{ asset('/img/panel/ico-wa-color.svg') }}" width="24" height="24"></a>
							<a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url={{ url('/') }}/{{ Auth::user() -> shop -> slug }}" class="mx-2 bg-dark-2 p-2 rounded-3"><img src="{{ asset('/img/panel/ico-li-color.svg') }}" width="24" height="24"></a>
							<a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url={{ url('/') }}/{{ Auth::user() -> shop -> slug }}" class="mx-2 bg-dark-2 p-2 rounded-3"><img src="{{ asset('/img/panel/ico-mail-color.svg') }}" width="24" height="24"></a>
						</p>

						<a href="{{ route('shop.index', Auth::user() -> shop) }}" target="_blank" class="btn btn-primary mx-2">Ir a la tienda</a>
						<a href="{{ route('panel.dashboard') }}" class="btn btn-secondary mx-2">Ir al panel de control</a>
					</div>
				@endif
			</div>
		</div>

	</main>

	{{-- TOASTs --}}
	<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
		<div id="liveToastUploaded" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex justify-content-between align-items-center pe-2">
				<div class="toast-body">Comprobante enviado correctamente.</div>
				<button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
		</div>
		<div id="liveToastUpdated" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex justify-content-between align-items-center pe-2">
				<div class="toast-body">Información actualizada correctamente.</div>
				<button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
		</div>
	</div>
</div>


@push('scripts')
	{{-- MPAGO -}}
	<script src="https://sdk.mercadopago.com/js/v2"></script>
	<script type="text/javascript">
		const mp = new MercadoPago("{{ config('services.mercadopago.key') }}");

		const cardForm = mp.cardForm({
			amount: "3900",
			iframe: true,
			form: {
				id: "form-checkout",
				cardNumber: {
					id: "form-checkout__cardNumber",
					placeholder: "Numero de tarjeta",
				},
				expirationDate: {
					id: "form-checkout__expirationDate",
					placeholder: "MM/YY",
				},
				securityCode: {
					id: "form-checkout__securityCode",
					placeholder: "Código de seguridad",
				},
				cardholderName: {
					id: "form-checkout__cardholderName",
					placeholder: "Titular de la tarjeta",
				},
				issuer: {
					id: "form-checkout__issuer",
					placeholder: "Banco emisor",
				},
				installments: {
					id: "form-checkout__installments",
					placeholder: "Cuotas",
				},        
				identificationType: {
					id: "form-checkout__identificationType",
					placeholder: "Tipo de documento",
				},
				identificationNumber: {
					id: "form-checkout__identificationNumber",
					placeholder: "Número del documento",
				},
				cardholderEmail: {
					id: "form-checkout__cardholderEmail",
					placeholder: "E-mail",
				},
			},
			callbacks: {
				onFormMounted: error => {
					if (error) return console.warn("Form Mounted handling error: ", error);
					console.log("Form mounted");
				},
				onSubmit: event => {
					event.preventDefault();
					const {
						paymentMethodId: payment_method_id,
						issuerId: issuer_id,
						cardholderEmail: email,
						amount,
						token,
						installments,
						identificationNumber,
						identificationType,
					} = cardForm.getCardFormData();

					fetch("{{ route('panel.suscribe') }}", {
						method: "POST",
						headers: {
							"Content-Type": "application/json",
							"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
						},
						body: JSON.stringify({
							token,
							issuer_id,
							payment_method_id,
							transaction_amount: Number(amount),
							installments: Number(installments),
							description: "Descripción del producto",
							payer: {
								email,
								identification: {
									type: identificationType,
									number: identificationNumber,
								},
							},
							user_id: {{ Auth::user() -> id }}
						}),
					});
				},
				onFetching: (resource) => {
					console.log("Fetching resource: ", resource);

					// Animate progress bar
					const progressBar = document.querySelector(".progress-bar");
					progressBar.removeAttribute("value");

					return () => {
						progressBar.setAttribute("value", "0");
					};
				}
			},
		});
	</script>
	{{-- end MPAGO --}}
	
	<script type="text/javascript">
		window.livewire.on('uploaded', () => {
			var toast = new bootstrap.Toast(document.getElementById('liveToastUploaded'))
			toast.show()
		})
		window.livewire.on('updated', () => {
			var toast = new bootstrap.Toast(document.getElementById('liveToastUpdated'))
			toast.show()
		})
	</script>
@endpush