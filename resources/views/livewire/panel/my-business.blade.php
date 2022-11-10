<div class="p-4">
	<div class="mb-4">
		<h1 class="fs-18 fw-600 m-0">Mi tienda</h1>
		<span class="text-muted fs-12">Configuración de tu negocio</span>
	</div>

	<div class="bg-dark-2 border-dashed p-4 br-10 position-relative d-none d-sm-block">
        <div wire:loading wire:target="logo, logo_foot, update" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
            <div class="position-absolute top-50 start-50 translate-middle">
                <div class="spinner-border text-light" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
		<ul class="nav nav-tabs border-0" id="myTab" role="tablist">
			<li class="nav-item me-4" role="presentation" wire:ignore>
				<button class="nav-link px-0 border-0 rounded-0 active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general-tab-pane" type="button" role="tab" aria-controls="general-tab-pane" aria-selected="true">
					<div class="d-flex align-items-center">
						<svg class="me-2" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 2.375L2 9.575V20.575C2 21.175 2.4 21.575 3 21.575H9C9.6 21.575 10 21.175 10 20.575V14.575C10 13.975 10.4 13.575 11 13.575H13C13.6 13.575 14 13.975 14 14.575V20.575C14 21.175 14.4 21.575 15 21.575H21C21.6 21.575 22 21.175 22 20.575V9.575L13 2.375C12.4 1.875 11.6 1.875 11 2.375Z" fill="currentColor"/></svg>
						General
					</div>
				</button>
			</li>
			<li class="nav-item me-4" role="presentation" wire:ignore>
				<button class="nav-link px-0 border-0 rounded-0" id="products-tab" data-bs-toggle="tab" data-bs-target="#products-tab-pane" type="button" role="tab" aria-controls="products-tab-pane" aria-selected="false">
					<svg class="me-2" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M20 22H4C3.4 22 3 21.6 3 21V2H21V21C21 21.6 20.6 22 20 22Z" fill="currentColor"></path><path d="M12 14C9.2 14 7 11.8 7 9V5C7 4.4 7.4 4 8 4C8.6 4 9 4.4 9 5V9C9 10.7 10.3 12 12 12C13.7 12 15 10.7 15 9V5C15 4.4 15.4 4 16 4C16.6 4 17 4.4 17 5V9C17 11.8 14.8 14 12 14Z" fill="currentColor"></path></svg>
					Productos
				</button>
			</li>
			<li class="nav-item me-4" role="presentation" wire:ignore>
				<button class="nav-link px-0 border-0 rounded-0" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment-tab-pane" type="button" role="tab" aria-controls="payment-tab-pane" aria-selected="false">
					<svg class="me-2" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="currentColor"></path><path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="currentColor"></path><path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="currentColor"></path></svg>
					Métodos de Pago
				</button>
			</li>
			<li class="nav-item me-4" role="presentation" wire:ignore>
				<button class="nav-link px-0 border-0 rounded-0" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping-tab-pane" type="button" role="tab" aria-controls="shipping-tab-pane" aria-selected="false">
					<svg class="me-2" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="currentColor"></path><path opacity="0.3" d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z" fill="currentColor"></path></svg>
					Envíos
				</button>
			</li>
			<li class="nav-item me-4" role="presentation" wire:ignore>
				<button class="nav-link px-0 border-0 rounded-0" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
					<svg class="me-2" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor"></path><path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor"></path></svg>
					Contacto
				</button>
			</li>
			<li class="nav-item me-4" role="presentation" wire:ignore>
				<button class="nav-link px-0 border-0 rounded-0" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo-tab-pane" type="button" role="tab" aria-controls="seo-tab-pane" aria-selected="false">
					<svg class="me-2" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M18.4 5.59998C21.9 9.09998 21.9 14.8 18.4 18.3C14.9 21.8 9.2 21.8 5.7 18.3L18.4 5.59998Z" fill="currentColor"></path><path d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM19.9 11H13V8.8999C14.9 8.6999 16.7 8.00005 18.1 6.80005C19.1 8.00005 19.7 9.4 19.9 11ZM11 19.8999C9.7 19.6999 8.39999 19.2 7.39999 18.5C8.49999 17.7 9.7 17.2001 11 17.1001V19.8999ZM5.89999 6.90002C7.39999 8.10002 9.2 8.8 11 9V11.1001H4.10001C4.30001 9.4001 4.89999 8.00002 5.89999 6.90002ZM7.39999 5.5C8.49999 4.7 9.7 4.19998 11 4.09998V7C9.7 6.8 8.39999 6.3 7.39999 5.5ZM13 17.1001C14.3 17.3001 15.6 17.8 16.6 18.5C15.5 19.3 14.3 19.7999 13 19.8999V17.1001ZM13 4.09998C14.3 4.29998 15.6 4.8 16.6 5.5C15.5 6.3 14.3 6.80002 13 6.90002V4.09998ZM4.10001 13H11V15.1001C9.1 15.3001 7.29999 16 5.89999 17.2C4.89999 16 4.30001 14.6 4.10001 13ZM18.1 17.1001C16.6 15.9001 14.8 15.2 13 15V12.8999H19.9C19.7 14.5999 19.1 16.0001 18.1 17.1001Z" fill="currentColor"></path></svg>
					SEO
				</button>
			</li>
		</ul>
		<form wire:submit.prevent="update">
			<div class="tab-content" id="myTabContent">
				<div wire:ignore.self class="tab-pane fade show active" id="general-tab-pane" role="tabpanel" aria-labelledby="general-tab" tabindex="0">
					<div class="pt-5 pb-4">

						<div class="row justify-content-center">
							<div class="col-sm-10">
								<h2 class="fs-18 m-0 fw-500 mb-4">Información general</h2>
							</div>
							
							<div class="col-sm-4">
								<div class="row">
									<div class="col-sm-6">
										<label class="fs-14 fw-400 text-white-50 mb-3">Logo cabecera</label>
										<div class="ratio ratio-1x1 mb-2 w-75 mx-auto bg-white bg-img-contain rounded-4" style="background-image: url({{ asset($logo ? $logo -> temporaryUrl() : ( $shop['logo'] ?? 'img/admin/default.png')) }});">
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
										<label class="fs-14 fw-400 text-white-50 mb-3">Logo pie de página</label>
										<div class="ratio ratio-1x1 mb-2 w-75 mx-auto bg-dark bg-img-contain rounded-4" style="background-image: url({{ asset($logo_foot ? $logo_foot -> temporaryUrl() : ($shop['logo_foot'] ?? 'img/admin/default.png')) }});">
											<div>
												<a onclick="$('.logoFootUpload').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
											</div>
										</div>
										<input class="logoFootUpload float-start" type="file" accept=".jpg,.png,.jpeg" wire:model.defer="logo_foot" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">

										@error('logo_foot')
											<span class="fs-12 text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>

								<p class="fs-12 text-muted text-center mt-3 mb-4">Ten en cuenta que la cabera de la tienda es de fondo blanco, mientras el pie de página tiene fondo negro. Tampoco es obligatoria la carga del logo.</p>
							</div>

							<div class="col-sm-6">
								<div class="mb-3">
									<label class="fs-13 mb-1 text-white-50">Nombre de la tienda<span class="text-danger fs-16">*</span></label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.shop_name">

									@error('shop.shop_name')
										<br><span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>

								<div class="mb-3">
									<label class="fs-13 mb-1 text-white-50">Descripción<span class="text-danger fs-16">*</span></label>
									<textarea class="form-control bg-transparent text-white" wire:model.defer="shop.description"></textarea>

									@error('shop.description')
										<br><span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>

				<div wire:ignore.self class="tab-pane fade" id="products-tab-pane" role="tabpanel" aria-labelledby="products-tab" tabindex="0">
					<div class="pt-5 pb-4">
						<div class="row justify-content-center">
							<div class="col-sm-10">
								<h2 class="fs-18 m-0 fw-500">Productos</h2>
								<p class="text-white-50 fs-14 mb-4">Elige las categorías de los productos que quieres vender.</p>

								<div class="row mb-3">
									@foreach ($categories as $category)
										<div class="col-md-2 col-4 text-center">
											<label>
												<div class="selectPlan p-4 mx-auto border-dashed rounded-3 mb-2 {{ ($categoriesShop[$category -> id]) ? 'active' : '' }}" onclick="$(this).toggleClass('active')" style="width: 82px">
													<div class="ico"><img src="{{ asset( $category -> ico ) }}" width="32" class="f-invert opacity-50"></div>
												</div>
												<span class="fs-12 text-uppercase text-white-50">{{ $category -> name }}</span>
												<input type="checkbox" wire:model.defer="categoriesShop.{{ $category -> id }}" value="{{ $category -> id }}" id="category{{ $category -> id }}" style="float: left; opacity: 0; height: 1px; width: 1px;">
											</label>
										</div>
									@endforeach
								</div>

								@error('categoriesShopSelected')
									<p class="text-danger fs-14 m-0">{{ $message }}</p>
								@enderror

							</div>
						</div>
					</div>
				</div>

				<div wire:ignore.self class="tab-pane fade" id="payment-tab-pane" role="tabpanel" aria-labelledby="payment-tab" tabindex="0">
					<div class="pt-5 pb-4">
						<div class="row justify-content-center">
							<div class="col-sm-10">
								<h2 class="fs-18 m-0 fw-500">Métodos de pago</h2>
								<p class="text-white-50 fs-14 mb-4">Elige los métodos de pago que quieres utilizar para que tus clientes te abonen los productos.</p>

								<div class="row">
									<div class="col-4 text-center">
										<label>
											<div class="selectPlan d-block p-4 border-dashed mx-auto rounded-3 mb-2 {{ $shop['cash'] ? 'active' : '' }}" style="width: 80px" onclick="$(this).toggleClass('active')">
												<div class="ico"><img src="{{ asset('img/panel/ico-cash.svg') }}" width="32" height="32" class="f-invert opacity-50"></div>
											</div>
											<span class="fs-12 text-uppercase text-white-50">Efectivo</span>
											<input type="checkbox" wire:model.defer="shop.cash" value="1" style="float: left; opacity: 0; height: 1px; width: 1px;">
										</label>
									</div>

									@if ( Auth::user() -> suscriber -> status == 3 && Auth::user() -> suscriber -> plan == 2 )
										<div class="col-4 text-center">
											<label>
												<div class="selectPlan d-block p-4 border-dashed rounded-3 mb-2 {{ $shop['bank'] ? 'active' : '' }}" wire:ignore.self onclick="$(this).toggleClass('active')">
													<div class="ico"><img src="{{ asset('img/panel/ico-bank.svg') }}" width="32" height="32" class="f-invert opacity-50"></div>
												</div>
												<span class="fs-12 text-uppercase text-white-50">Transferencia</span>
												<input type="checkbox" wire:model="shop.bank" value="1" style="float: left; opacity: 0; height: 1px; width: 1px;">
											</label>
										</div>
										<div class="col-4 text-center">
											<label>
												<div class="selectPlan d-block p-4 border-dashed rounded-3 mb-2 {{ $shop['mpago'] ? 'active' : '' }}" wire:ignore.self onclick="$(this).toggleClass('active')">
													<div class="ico"><img src="{{ asset('img/panel/ico-mp.svg') }}" width="32" height="32" class="f-gray opacity-50"></div>
												</div>
												<span class="fs-12 text-uppercase text-white-50">MercadoPago</span>
												<input type="checkbox" wire:model="shop.mpago" value="1" style="float: left; opacity: 0; height: 1px; width: 1px;">
											</label>
										</div>
									@endif
								</div>

								<div class="row gx-sm-5">
									@if ( $shop['bank'] == 1 )
										<div class="col-sm-6">
											<h4 class="fs-16 mt-5">Pago por transferencia</h4>
											<div class="row">
												<div class="col-md-6">
													<div class="mb-3">
														<label class="fs-13 mb-1 opacity-75">Nombre del banco<span class="text-danger fs-16">*</span></label>
														<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.bank_name">

														@error('shop.bank_name')
															<p class="fs-14 text-danger m-0">{{ $message }}</p>
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="mb-3">
														<label class="fs-13 mb-1 opacity-75">Titular de la cuenta<span class="text-danger fs-16">*</span></label>
														<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.bank_titular">

														@error('shop.bank_titular')
															<p class="fs-14 text-danger m-0">{{ $message }}</p>
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="mb-3">
														<label class="fs-13 mb-1 opacity-75">CUIT<span class="text-danger fs-16">*</span></label>
														<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.bank_cuit">

														@error('shop.bank_cuit')
															<p class="fs-14 text-danger m-0">{{ $message }}</p>
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="mb-3">
														<label class="fs-13 mb-1 opacity-75">Alias<span class="text-danger fs-16">*</span></label>
														<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.bank_alias">

														@error('shop.bank_alias')
															<p class="fs-14 text-danger m-0">{{ $message }}</p>
														@enderror
													</div>
												</div>
												<div class="col-12">
													<div class="mb-3">
														<label class="fs-13 mb-1 opacity-75">CBU/CVU<span class="text-danger fs-16">*</span></label>
														<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.bank_cbu">

														@error('shop.bank_cbu')
															<p class="fs-14 text-danger m-0">{{ $message }}</p>
														@enderror
													</div>
												</div>
											</div>
										</div>
									@endif

									@if ( $shop['mpago'] == 1 )
										<div class="col-sm-6">
											<h4 class="fs-16 mt-5">Pago por MercadoPago</h4>

											<p>Para activar el pago mediante MercadoPago, debes obtener tus credenciales. Dirígete a <a href="https://www.mercadopago.com.ar/settings/account/credentials" target="_blank">mercadopago.com.ar/settings/account/credentials</a> y accede a tus credenciales de producción. Luego cópialas y pégalas aquí.</p>
											<p class="mb-0">Luego, para finalizar tu configuración, accede a la siguiente dirección: <a href="https://www.mercadopago.com.ar/developers/panel/notifications/ipn" target="_blank">mercadopago.com.ar/developers/panel/notifications/ipn</a> y coloca en el campo "URL del sitio web en producción": <strong>{{ url( Auth::user() -> shop -> slug ) }}/ipn/mercadopago</strong> y selecciona <strong>Pagos</strong> del menú "Eventos".</p>

											<div class="mb-3">
												<label class="fs-13 mb-1 opacity-75">Public Key<span class="text-danger fs-16">*</span></label>
												<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.mp_public_key">

												@error('shop.mp_public_key')
													<p class="fs-14 text-danger m-0">{{ $message }}</p>
												@enderror
											</div>

											<div class="mb-3">
												<label class="fs-13 mb-1 opacity-75">Access Token<span class="text-danger fs-16">*</span></label>
												<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.mp_access_token">

												@error('shop.mp_access_token')
													<p class="fs-14 text-danger m-0">{{ $message }}</p>
												@enderror
											</div>
										</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>

				<div wire:ignore.self class="tab-pane fade" id="shipping-tab-pane" role="tabpanel" aria-labelledby="shipping-tab" tabindex="0">
					<div class="pt-5 pb-4">
						<div class="row justify-content-center">
							<div class="col-sm-10">
								<h2 class="fs-18 m-0 fw-500">Métodos de envío</h2>
								<p class="text-white-50 fs-14 mb-4">Elige los métodos de envío que quieres que tus clientes tengan para elegir. Ten en cuenta que los pedidos con "envío a coordinar" te llegarán a tu domicilio y serás el responsable de repartir los mismos. Al mismo tiempo, con ese método, el costo del envío corre por tu cuenta.</p>
								<div class="row">
									<div class="col-6 text-center">
										<label>
											<div class="selectPlan d-block p-4 border-dashed mx-auto rounded-3 mb-2 {{ $shop['delivery_home'] ? 'active' : '' }}" style="width: 80px" onclick="$(this).toggleClass('active')">
												<div class="ico"><img src="{{ asset('img/panel/ico-truck.svg') }}" width="32" height="32" class="f-invert opacity-50"></div>
											</div>
											<span class="fs-12 text-uppercase text-white-50">Envío a domicilio</span>
											<input type="checkbox" wire:model.defer="shop.delivery_home" value="1" style="float: left; opacity: 0; height: 1px; width: 1px;">
										</label>
									</div>

									<div class="col-6 text-center">
										<label>
											<div class="selectPlan d-block p-4 border-dashed mx-auto rounded-3 mb-2 {{ $shop['delivery_coordinate'] ? 'active' : '' }}" style="width: 80px" onclick="$(this).toggleClass('active')">
												<div class="ico"><img src="{{ asset('img/panel/ico-chat.svg') }}" width="32" height="32" class="f-invert opacity-50"></div>
											</div>
											<span class="fs-12 text-uppercase text-white-50">Envío a coordinar</span>
											<input type="checkbox" wire:model.defer="shop.delivery_coordinate" value="1" style="float: left; opacity: 0; height: 1px; width: 1px;">
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div wire:ignore.self class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
					<div class="pt-5 pb-4">
						<div class="row justify-content-center">
							<div class="col-sm-10">
								<h2 class="fs-18 m-0 fw-500">Contacto</h2>
								<p class="text-white-50 fs-14 mb-4">Recuerda mantener actualizada esta información, ya que será a donde te llegarán los pedidos de los clientes que elijan como método de envío "A coordinar".</p>
							</div>
							<div class="col-sm-5">
								<h2 class="fs-16 mt-0 mb-2 fw-500">Ubicación</h2>

								<div class="mb-3">
									<label class="fs-13 mb-1 text-white-50">Dirección<span class="text-danger fs-16">*</span></label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="suscriber.address">

									@error('suscriber.address')
										<br><span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>

								<div class="row">
									<div class="col-sm-6 mb-3">
										<label class="fs-13 mb-1 text-white-50">Ciudad<span class="text-danger fs-16">*</span></label>
										<input class="form-control bg-transparent text-white" type="text" wire:model.defer="suscriber.city">

										@error('suscriber.city')
											<br><span class="fs-12 text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-sm-6 mb-3">
										<label class="fs-13 mb-1 text-white-50">Provincia<span class="text-danger fs-16">*</span></label>
										<select class="form-select bg-dark-2 text-white" wire:model="suscriber.province">
											<option value="Buenos Aires">Buenos Aires</option>
											<option value="CABA">CABA</option>
											<option value="Catamarca">Catamarca</option>
											<option value="Chaco">Chaco</option>
											<option value="Chubut">Chubut</option>
											<option value="Córdoba">Córdoba</option>
											<option value="Corrientes">Corrientes</option>
											<option value="Entre Ríos">Entre Ríos</option>
											<option value="Formosa">Formosa</option>
											<option value="Jujuy">Jujuy</option>
											<option value="La Pampa">La Pampa</option>
											<option value="La Rioja">La Rioja</option>
											<option value="Mendoza">Mendoza</option>
											<option value="Misiones">Misiones</option>
											<option value="Neuquén">Neuquén</option>
											<option value="Río Negro">Río Negro</option>
											<option value="Salta">Salta</option>
											<option value="San Juan">San Juan</option>
											<option value="San Luis">San Luis</option>
											<option value="Santa Cruz">Santa Cruz</option>
											<option value="Santa Fe">Santa Fe</option>
											<option value="Santiago del Estero">Santiago del Estero</option>
											<option value="Tierra del Fuego">Tierra del Fuego</option>
											<option value="Tucumán">Tucumán</option>
										</select>

										@error('suscriber.province')
											<span class="fs-12 text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-sm-6 mb-3">
										<label class="fs-13 mb-1 text-white-50">Teléfono<span class="text-danger fs-16">*</span></label>
										<input class="form-control bg-transparent text-white" type="text" wire:model.defer="suscriber.phone">

										@error('suscriber.phone')
											<br><span class="fs-12 text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-sm-6 mb-3">
										<label class="fs-13 mb-1 text-white-50">Email<span class="text-danger fs-16">*</span></label>
										<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.shop_mail">

										@error('shop.shop_mail')
											<span class="fs-12 text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="col-sm-5">
								<h2 class="fs-16 mt-0 mb-2 fw-500">Redes Sociales</h2>

								<div class="mb-3">
									<label class="fs-13 mb-1 text-white-50">Facebook</label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.facebook">

									@error('shop.facebook')
										<br><span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>

								<div class="mb-3">
									<label class="fs-13 mb-1 text-white-50">Instagram</label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.instagram">

									@error('shop.instagram')
										<br><span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>

								<div class="mb-3">
									<label class="fs-13 mb-1 text-white-50">Whatsapp</label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.whatsapp">

									@error('shop.whatsapp')
										<br><span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>

				<div wire:ignore.self class="tab-pane fade" id="seo-tab-pane" role="tabpanel" aria-labelledby="seo-tab" tabindex="0">
					<div class="pt-5 pb-4">
						<div class="row justify-content-center">
							<div class="col-sm-10">
								<h2 class="fs-18 m-0 fw-500">SEO (Optimización de Motores de Búsqueda)</h2>
								<p class="text-white-50 fs-14 mb-4">Completa los campos en caso de querer mejorar el posicionamiento de tu tienda.</p>

								<div class="mb-3">
									<label class="fs-13 mb-1 text-white-50">Meta Title</label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.meta_title">

									@error('meta_title')
										<br><span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>

								<div class="mb-3">
									<label class="fs-13 mb-1 text-white-50">Meta Description</label>
									<textarea class="form-control bg-transparent text-white" wire:model.defer="shop.meta_description"></textarea>

									@error('meta_description')
										<br><span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>

								<div class="mb-3">
									<label class="fs-13 mb-1 text-white-50">Meta Keywords</label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.meta_keywords">

									@error('meta_keywords')
										<br><span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>

								<div class="mb-3">
									<label class="fs-13 mb-1 text-white-50">Google Analytics</label>
									<textarea class="form-control bg-transparent text-white" wire:model.defer="shop.google_analytics"></textarea>

									@error('google_analytics')
										<br><span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>

								<div class="mb-3">
									<label class="fs-13 mb-1 text-white-50">Facebook Pixel</label>
									<textarea class="form-control bg-transparent text-white" wire:model.defer="shop.facebook_pixel"></textarea>

									@error('facebook_pixel')
										<br><span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row justify-content-center mb-4">
					<div class="col-sm-10 text-end">
						<button class="btn btn-success px-4" type="submit" wire:loading.attr="disabled" wire:target="update">Actualizar infomación</button>
					</div>
				</div>
			</div>
		</form>
	</div>


	{{--<form wire:submit.prevent="update">
		<div class="accordion d-block d-sm-none border-0" id="accordionMyBusiness">
			<div class="accordion-item text-white br-10 mb-4 border-0 bg-dark-2 border-dashed">
				<h2 class="accordion-header" id="headingGeneral">
					<button wire:ignore.self class="accordion-button shadow-none bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGeneral" aria-expanded="true" aria-controls="collapseGeneral">
						<div class="d-flex align-items-center">
							<svg class="me-2" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 2.375L2 9.575V20.575C2 21.175 2.4 21.575 3 21.575H9C9.6 21.575 10 21.175 10 20.575V14.575C10 13.975 10.4 13.575 11 13.575H13C13.6 13.575 14 13.975 14 14.575V20.575C14 21.175 14.4 21.575 15 21.575H21C21.6 21.575 22 21.175 22 20.575V9.575L13 2.375C12.4 1.875 11.6 1.875 11 2.375Z" fill="currentColor"/></svg>
							General
						</div>
					</button>
				</h2>
				<div id="collapseGeneral" class="accordion-collapse collapse show" wire:ignore.self aria-labelledby="headingGeneral" data-bs-parent="#accordionMyBusiness">
					<div class="accordion-body">
						<div class="row justify-content-center">
							<div class="col-sm-10">
								<h2 class="fs-18 m-0 fw-500 mb-4">Información general</h2>
							</div>
							
							<div class="col-sm-4">
								<div class="row">
									<div class="col-6">
										<label class="fs-14 fw-400 text-white-50 mb-3">Logo cabecera</label>
										<div class="ratio ratio-1x1 mb-2 w-75 mx-auto bg-white bg-img-contain rounded-4" style="background-image: url({{ asset($logo ? $logo -> temporaryUrl() : ( $shop['logo'] ?? 'img/admin/default.png')) }});">
											<div>
												<a onclick="$('.logoUploadMobile').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
											</div>
										</div>
										<input class="logoUploadMobile float-start" type="file" accept=".jpg,.png,.jpeg" wire:model.defer="logo" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">

										@error('logo')
											<span class="fs-12 text-danger">{{ $message }}</span>
										@enderror
									</div>
									<div class="col-6">
										<label class="fs-14 fw-400 text-white-50 mb-3">Logo pie de página</label>
										<div class="ratio ratio-1x1 mb-2 w-75 mx-auto bg-dark bg-img-contain rounded-4" style="background-image: url({{ asset($logo_foot ? $logo_foot -> temporaryUrl() : ($shop['logo_foot'] ?? 'img/admin/default.png')) }});">
											<div>
												<a onclick="$('.logoFootUploadMobile').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
											</div>
										</div>
										<input class="logoFootUploadMobile float-start" type="file" accept=".jpg,.png,.jpeg" wire:model.defer="logo_foot" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">

										@error('logo_foot')
											<span class="fs-12 text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>

								<p class="fs-12 text-muted text-center mt-3 mb-4">Ten en cuenta que la cabera de la tienda es de fondo blanco, mientras el pie de página tiene fondo negro. Tampoco es obligatoria la carga del logo.</p>
							</div>

							<div class="col-sm-6">
								<div class="mb-3">
									<label class="fs-13 mb-1 text-white-50">Nombre de la tienda<span class="text-danger fs-16">*</span></label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.shop_name">

									@error('shop.shop_name')
										<br><span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>

								<div class="mb-3">
									<label class="fs-13 mb-1 text-white-50">Descripción<span class="text-danger fs-16">*</span></label>
									<textarea class="form-control bg-transparent text-white" wire:model.defer="shop.description"></textarea>

									@error('shop.description')
										<br><span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="accordion-item text-white br-10 mb-4 border-0 bg-dark-2 border-dashed">
				<h2 class="accordion-header" id="headingProducts">
					<button class="accordion-button shadow-none bg-transparent collapsed" wire:ignore.self type="button" data-bs-toggle="collapse" data-bs-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
						<svg class="me-2" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M20 22H4C3.4 22 3 21.6 3 21V2H21V21C21 21.6 20.6 22 20 22Z" fill="currentColor"></path><path d="M12 14C9.2 14 7 11.8 7 9V5C7 4.4 7.4 4 8 4C8.6 4 9 4.4 9 5V9C9 10.7 10.3 12 12 12C13.7 12 15 10.7 15 9V5C15 4.4 15.4 4 16 4C16.6 4 17 4.4 17 5V9C17 11.8 14.8 14 12 14Z" fill="currentColor"></path></svg>
						Productos
					</button>
				</h2>
				<div id="collapseProducts" class="accordion-collapse collapse" wire:ignore.self aria-labelledby="headingProducts" data-bs-parent="#accordionMyBusiness">
					<div class="accordion-body">
						<h2 class="fs-18 m-0 fw-500">Productos</h2>
						<p class="text-white-50 fs-14 mb-4">Elige las categorías de los productos que quieres vender.</p>

						<div class="row mb-3">
							@foreach ($categories as $category)
								<div class="col-md-2 col-4 text-center">
									<label>
										<div class="selectPlan p-4 mx-auto border-dashed rounded-3 mb-2 {{ ($categoriesShop[$category -> id]) ? 'active' : '' }}" onclick="$(this).toggleClass('active')" style="width: 82px">
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
					</div>
				</div>
			</div>
			<div class="accordion-item text-white br-10 mb-4 border-0 bg-dark-2 border-dashed">
				<h2 class="accordion-header" id="headingPayments">
					<button class="accordion-button shadow-none bg-transparent collapsed" wire:ignore.self type="button" data-bs-toggle="collapse" data-bs-target="#collapsePayments" aria-expanded="false" aria-controls="collapsePayments">
						<svg class="me-2" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="currentColor"></path><path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="currentColor"></path><path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="currentColor"></path></svg>
						Métodos de Pago
					</button>
				</h2>
				<div id="collapsePayments" wire:ignore.self class="accordion-collapse collapse" aria-labelledby="headingPayments" data-bs-parent="#accordionMyBusiness">
					<div class="accordion-body">
						<h2 class="fs-18 m-0 fw-500">Métodos de pago</h2>
						<p class="text-white-50 fs-14 mb-4">Elige los métodos de pago que quieres utilizar para que tus clientes te abonen los productos.</p>

						<div class="row">
							<div class="col-4 text-center">
								<label>
									<div class="selectPlan d-block p-4 border-dashed mx-auto rounded-3 mb-2 {{ $shop['cash'] ? 'active' : '' }}" style="width: 80px" onclick="$(this).toggleClass('active')">
										<div class="ico"><img src="{{ asset('img/panel/ico-cash.svg') }}" width="32" height="32" class="f-invert opacity-50"></div>
									</div>
									<span class="fs-12 text-uppercase text-white-50">Efectivo</span>
									<input type="checkbox" wire:model.defer="shop.cash" value="1" style="float: left; opacity: 0; height: 1px; width: 1px;">
								</label>
							</div>

							@if ( Auth::user() -> suscriber -> status == 3 && Auth::user() -> suscriber -> plan == 2 )
								<div class="col-4 text-center">
									<label>
										<div class="selectPlan d-block p-4 border-dashed rounded-3 mb-2 {{ $shop['bank'] ? 'active' : '' }}" wire:ignore.self onclick="$(this).toggleClass('active')">
											<div class="ico"><img src="{{ asset('img/panel/ico-bank.svg') }}" width="32" height="32" class="f-invert opacity-50"></div>
										</div>
										<span class="fs-12 text-uppercase text-white-50">Transferencia</span>
										<input type="checkbox" wire:model="shop.bank" value="1" style="float: left; opacity: 0; height: 1px; width: 1px;">
									</label>
								</div>
								<div class="col-4 text-center">
									<label>
										<div class="selectPlan d-block p-4 border-dashed rounded-3 mb-2 {{ $shop['mpago'] ? 'active' : '' }}" wire:ignore.self onclick="$(this).toggleClass('active')">
											<div class="ico"><img src="{{ asset('img/panel/ico-mp.svg') }}" width="32" height="32" class="f-gray opacity-50"></div>
										</div>
										<span class="fs-12 text-uppercase text-white-50">MercadoPago</span>
										<input type="checkbox" wire:model="shop.mpago" value="1" style="float: left; opacity: 0; height: 1px; width: 1px;">
									</label>
								</div>
							@endif
						</div>

						<div class="row gx-sm-5">
							@if ( $shop['bank'] == 1 )
								<div class="col-sm-6">
									<h4 class="fs-16 mt-5">Pago por transferencia</h4>
									<div class="row">
										<div class="col-md-6">
											<div class="mb-3">
												<label class="fs-13 mb-1 opacity-75">Nombre del banco<span class="text-danger fs-16">*</span></label>
												<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.bank_name">

												@error('shop.bank_name')
													<p class="fs-14 text-danger m-0">{{ $message }}</p>
												@enderror
											</div>
										</div>
										<div class="col-md-6">
											<div class="mb-3">
												<label class="fs-13 mb-1 opacity-75">Titular de la cuenta<span class="text-danger fs-16">*</span></label>
												<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.bank_titular">

												@error('shop.bank_titular')
													<p class="fs-14 text-danger m-0">{{ $message }}</p>
												@enderror
											</div>
										</div>
										<div class="col-md-6">
											<div class="mb-3">
												<label class="fs-13 mb-1 opacity-75">CUIT<span class="text-danger fs-16">*</span></label>
												<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.bank_cuit">

												@error('shop.bank_cuit')
													<p class="fs-14 text-danger m-0">{{ $message }}</p>
												@enderror
											</div>
										</div>
										<div class="col-md-6">
											<div class="mb-3">
												<label class="fs-13 mb-1 opacity-75">Alias<span class="text-danger fs-16">*</span></label>
												<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.bank_alias">

												@error('shop.bank_alias')
													<p class="fs-14 text-danger m-0">{{ $message }}</p>
												@enderror
											</div>
										</div>
										<div class="col-12">
											<div class="mb-3">
												<label class="fs-13 mb-1 opacity-75">CBU/CVU<span class="text-danger fs-16">*</span></label>
												<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.bank_cbu">

												@error('shop.bank_cbu')
													<p class="fs-14 text-danger m-0">{{ $message }}</p>
												@enderror
											</div>
										</div>
									</div>
								</div>
							@endif

							@if ( $shop['mpago'] == 1 )
								<div class="col-sm-6">
									<h4 class="fs-16 mt-5">Pago por MercadoPago</h4>

									<div class="mb-3">
										<label class="fs-13 mb-1 opacity-75">Public Key<span class="text-danger fs-16">*</span></label>
										<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.mp_public_key">

										@error('shop.mp_public_key')
											<p class="fs-14 text-danger m-0">{{ $message }}</p>
										@enderror
									</div>

									<div class="mb-3">
										<label class="fs-13 mb-1 opacity-75">Access Token<span class="text-danger fs-16">*</span></label>
										<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.mp_access_token">

										@error('shop.mp_access_token')
											<p class="fs-14 text-danger m-0">{{ $message }}</p>
										@enderror
									</div>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
			<div class="accordion-item text-white br-10 mb-4 border-0 bg-dark-2 border-dashed">
				<h2 class="accordion-header" id="headingShippings">
					<button class="accordion-button shadow-none bg-transparent collapsed" wire:ignore.self type="button" data-bs-toggle="collapse" data-bs-target="#collapseShippings" aria-expanded="false" aria-controls="collapseShippings">
						<svg class="me-2" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="currentColor"></path><path opacity="0.3" d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z" fill="currentColor"></path></svg>
						Envíos
					</button>
				</h2>
				<div id="collapseShippings" wire:ignore.self class="accordion-collapse collapse" aria-labelledby="headingShippings" data-bs-parent="#accordionMyBusiness">
					<div class="accordion-body">
						<h2 class="fs-18 m-0 fw-500">Métodos de envío</h2>
						<p class="text-white-50 fs-14 mb-4">Elige los métodos de envío que quieres que tus clientes tengan para elegir. Ten en cuenta que los pedidos con "envío a coordinar" te llegarán a tu domicilio y serás el responsable de repartir los mismos. Al mismo tiempo, con ese método, el costo del envío corre por tu cuenta.</p>
						<div class="row">
							<div class="col-6 text-center">
								<label>
									<div class="selectPlan d-block p-4 border-dashed mx-auto rounded-3 mb-2 {{ $shop['delivery_home'] ? 'active' : '' }}" style="width: 80px" onclick="$(this).toggleClass('active')">
										<div class="ico"><img src="{{ asset('img/panel/ico-truck.svg') }}" width="32" height="32" class="f-invert opacity-50"></div>
									</div>
									<span class="fs-12 text-uppercase text-white-50">Envío a domicilio</span>
									<input type="checkbox" wire:model.defer="shop.delivery_home" value="1" style="float: left; opacity: 0; height: 1px; width: 1px;">
								</label>
							</div>

							<div class="col-6 text-center">
								<label>
									<div class="selectPlan d-block p-4 border-dashed mx-auto rounded-3 mb-2 {{ $shop['delivery_coordinate'] ? 'active' : '' }}" style="width: 80px" onclick="$(this).toggleClass('active')">
										<div class="ico"><img src="{{ asset('img/panel/ico-chat.svg') }}" width="32" height="32" class="f-invert opacity-50"></div>
									</div>
									<span class="fs-12 text-uppercase text-white-50">Envío a coordinar</span>
									<input type="checkbox" wire:model.defer="shop.delivery_coordinate" value="1" style="float: left; opacity: 0; height: 1px; width: 1px;">
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="accordion-item text-white br-10 mb-4 border-0 bg-dark-2 border-dashed">
				<h2 class="accordion-header" id="headingContact">
					<button class="accordion-button shadow-none bg-transparent collapsed" wire:ignore.self type="button" data-bs-toggle="collapse" data-bs-target="#collapseContact" aria-expanded="false" aria-controls="collapseContact">
						<svg class="me-2" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor"></path><path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor"></path></svg>
						Contacto
					</button>
				</h2>
				<div id="collapseContact" wire:ignore.self class="accordion-collapse collapse" aria-labelledby="headingContact" data-bs-parent="#accordionMyBusiness">
					<div class="accordion-body">
						<h2 class="fs-18 m-0 fw-500">Contacto</h2>
						<p class="text-white-50 fs-14 mb-4">Recuerda mantener actualizada esta información, ya que será a donde te llegarán los pedidos de los clientes que elijan como método de envío "A coordinar".</p>

						<div class="row">
							<div class="col-sm-5">
								<h2 class="fs-16 mt-0 mb-2 fw-500">Ubicación</h2>

								<div class="mb-3">
									<label class="fs-13 mb-1 text-white-50">Dirección<span class="text-danger fs-16">*</span></label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="suscriber.address">

									@error('suscriber.address')
										<br><span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>

								<div class="row">
									<div class="col-sm-6 mb-3">
										<label class="fs-13 mb-1 text-white-50">Ciudad<span class="text-danger fs-16">*</span></label>
										<input class="form-control bg-transparent text-white" type="text" wire:model.defer="suscriber.city">

										@error('suscriber.city')
											<br><span class="fs-12 text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-sm-6 mb-3">
										<label class="fs-13 mb-1 text-white-50">Provincia<span class="text-danger fs-16">*</span></label>
										<select class="form-select bg-dark-2 text-white" wire:model="suscriber.province">
											<option value="Buenos Aires">Buenos Aires</option>
											<option value="CABA">CABA</option>
											<option value="Catamarca">Catamarca</option>
											<option value="Chaco">Chaco</option>
											<option value="Chubut">Chubut</option>
											<option value="Córdoba">Córdoba</option>
											<option value="Corrientes">Corrientes</option>
											<option value="Entre Ríos">Entre Ríos</option>
											<option value="Formosa">Formosa</option>
											<option value="Jujuy">Jujuy</option>
											<option value="La Pampa">La Pampa</option>
											<option value="La Rioja">La Rioja</option>
											<option value="Mendoza">Mendoza</option>
											<option value="Misiones">Misiones</option>
											<option value="Neuquén">Neuquén</option>
											<option value="Río Negro">Río Negro</option>
											<option value="Salta">Salta</option>
											<option value="San Juan">San Juan</option>
											<option value="San Luis">San Luis</option>
											<option value="Santa Cruz">Santa Cruz</option>
											<option value="Santa Fe">Santa Fe</option>
											<option value="Santiago del Estero">Santiago del Estero</option>
											<option value="Tierra del Fuego">Tierra del Fuego</option>
											<option value="Tucumán">Tucumán</option>
										</select>

										@error('suscriber.province')
											<span class="fs-12 text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>

								<div class="mb-3">
									<label class="fs-13 mb-1 text-white-50">Teléfono<span class="text-danger fs-16">*</span></label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="suscriber.phone">

									@error('suscriber.phone')
										<br><span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="col-sm-5">
								<h2 class="fs-16 mt-0 mb-2 fw-500">Redes Sociales</h2>

								<div class="mb-3">
									<label class="fs-13 mb-1 text-white-50">Facebook</label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.facebook">

									@error('shop.facebook')
										<br><span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>

								<div class="mb-3">
									<label class="fs-13 mb-1 text-white-50">Instagram</label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.instagram">

									@error('shop.instagram')
										<br><span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>

								<div class="mb-3">
									<label class="fs-13 mb-1 text-white-50">Whatsapp</label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.whatsapp">

									@error('shop.whatsapp')
										<br><span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="accordion-item text-white br-10 mb-4 border-0 bg-dark-2 border-dashed">
				<h2 class="accordion-header" id="headingSeo">
					<button wire:ignore.self class="accordion-button shadow-none bg-transparent collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeo" aria-expanded="false" aria-controls="collapseSeo">
						<svg class="me-2" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M18.4 5.59998C21.9 9.09998 21.9 14.8 18.4 18.3C14.9 21.8 9.2 21.8 5.7 18.3L18.4 5.59998Z" fill="currentColor"></path><path d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM19.9 11H13V8.8999C14.9 8.6999 16.7 8.00005 18.1 6.80005C19.1 8.00005 19.7 9.4 19.9 11ZM11 19.8999C9.7 19.6999 8.39999 19.2 7.39999 18.5C8.49999 17.7 9.7 17.2001 11 17.1001V19.8999ZM5.89999 6.90002C7.39999 8.10002 9.2 8.8 11 9V11.1001H4.10001C4.30001 9.4001 4.89999 8.00002 5.89999 6.90002ZM7.39999 5.5C8.49999 4.7 9.7 4.19998 11 4.09998V7C9.7 6.8 8.39999 6.3 7.39999 5.5ZM13 17.1001C14.3 17.3001 15.6 17.8 16.6 18.5C15.5 19.3 14.3 19.7999 13 19.8999V17.1001ZM13 4.09998C14.3 4.29998 15.6 4.8 16.6 5.5C15.5 6.3 14.3 6.80002 13 6.90002V4.09998ZM4.10001 13H11V15.1001C9.1 15.3001 7.29999 16 5.89999 17.2C4.89999 16 4.30001 14.6 4.10001 13ZM18.1 17.1001C16.6 15.9001 14.8 15.2 13 15V12.8999H19.9C19.7 14.5999 19.1 16.0001 18.1 17.1001Z" fill="currentColor"></path></svg>
						SEO
					</button>
				</h2>
				<div id="collapseSeo" wire:ignore.self class="accordion-collapse collapse" aria-labelledby="headingSeo" data-bs-parent="#accordionMyBusiness">
					<div class="accordion-body">
						<h2 class="fs-18 m-0 fw-500">SEO (Optimización de Motores de Búsqueda)</h2>
						<p class="text-white-50 fs-14 mb-4">Completa los campos en caso de querer mejorar el posicionamiento de tu tienda.</p>

						<div class="mb-3">
							<label class="fs-13 mb-1 text-white-50">Meta Title</label>
							<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.meta_title">

							@error('meta_title')
								<br><span class="fs-12 text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="mb-3">
							<label class="fs-13 mb-1 text-white-50">Meta Description</label>
							<textarea class="form-control bg-transparent text-white" wire:model.defer="shop.meta_description"></textarea>

							@error('meta_description')
								<br><span class="fs-12 text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="mb-3">
							<label class="fs-13 mb-1 text-white-50">Meta Keywords</label>
							<input class="form-control bg-transparent text-white" type="text" wire:model.defer="shop.meta_keywords">

							@error('meta_keywords')
								<br><span class="fs-12 text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="mb-3">
							<label class="fs-13 mb-1 text-white-50">Google Analytics</label>
							<textarea class="form-control bg-transparent text-white" wire:model.defer="shop.google_analytics"></textarea>

							@error('google_analytics')
								<br><span class="fs-12 text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="mb-3">
							<label class="fs-13 mb-1 text-white-50">Facebook Pixel</label>
							<textarea class="form-control bg-transparent text-white" wire:model.defer="shop.facebook_pixel"></textarea>

							@error('facebook_pixel')
								<br><span class="fs-12 text-danger">{{ $message }}</span>
							@enderror
						</div>
					</div>
				</div>
			</div>

			<div class="d-flex justify-content-end mt-3">
				<button class="btn btn-success px-4" type="submit" wire:loading.attr="disabled" wire:target="update">Actualizar infomación</button>
			</div>
		</div>
	</form>--}}

	{{-- TOASTs --}}
	<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
		<div id="liveToastUpdated" class="toast bg-primary text-white" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex justify-content-between align-items-center pe-2">
				<div class="toast-body">Actualizado correctamente</div>
				<button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
		</div>
	</div>
</div>


@push('scripts')
	<script type="text/javascript">
		window.livewire.on('updated', () => {
			$('.modal').modal('hide')
			var toast = new bootstrap.Toast(document.getElementById('liveToastUpdated'))
			toast.show()
		})
	</script>
@endpush
