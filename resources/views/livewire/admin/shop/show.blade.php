<div class="p-4">
	<div class="mb-4">
		<h1 class="fs-18 fw-600 m-0">Tiendas</h1>
		<span class="text-muted fs-12">Detalle de la tienda {{ $shop -> name }}</span>
	</div>

	@php
		$status = ['', 'Pendiente de pago', 'Pago a confirmar', 'Tienda Activa', 'Tienda Cancelada', 'Tienda Suspendida', 'Tienda Eliminada'];
		$color = ['', 'primary', 'info', 'success', 'danger', 'warning', 'dark'];
	@endphp

	@if ( Auth::user() -> user_type == 1 || Auth::user() -> user_type == 3 )
		@if ( $shop -> user -> suscriber -> status == 2 )
			<div class="alert alert-info text-center text-white fs-14 mx-5">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect></svg><br>
				<p>El usuario a enviado su comprobante de pago. Verifica el pago para activar la tienda.</p>
				@php $extension = pathinfo($shop -> user -> suscriber -> voucher, PATHINFO_EXTENSION); @endphp
				<a class="btn btn-sm mx-2 btn-outline-primary" href="{{ asset($shop -> user -> suscriber -> voucher) }}" {!! $extension == 'pdf' ? 'target="_blank"' : 'data-lightbox="roadtrip"' !!}>Ver comprobante</a>
				<button class="btn btn-sm mx-2 btn-primary" data-bs-toggle="modal" data-bs-target="#activeModal">Validar pago</button>
				<button class="btn btn-sm mx-2 btn-danger" data-bs-toggle="modal" data-bs-target="#rejectVoucher">Rechazar</button>
			</div>
		@endif
	@endif

	@if ( $shop -> user -> suscriber -> plan == 2 && $shop -> domain && $shop -> domain_status == 2 )
		<div class="alert alert-info text-center text-white fs-14 mx-5">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect></svg><br>
			<p>El usuario a enviado una solicitud para obtener el dominio <strong class="fw-600">{{ $shop -> domain }}</strong>.</p>

			<button class="btn btn-sm mx-2 btn-primary" onclick="confirm('¿Confirma la aceotación del pago? Esta acción sólo debe realizase una vez que el dominio esté configurado en el servidor.') || event.stopImmediatePropagation()" wire:click="acceptDomain" wire:loading.attr="disabled" wire:target="acceptDomain">Aceptar dominio <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" wire:loading wire:target="acacceptDomaintive"></span></button>
			<button class="btn btn-sm mx-2 btn-danger" data-bs-toggle="modal" data-bs-target="#rejectDomain">Rechazar</button>
		</div>
	@endif

	<div class="border-dashed bg-dark-2 br-10 p-4 pb-0 mb-4">
		<div class="d-flex">
			<div class="bg-dark-4 me-4 ratio ratio-1x1 bg-img-contain rounded-3" style="background-image: url({{ asset($shop -> logo ?? 'img/admin/default.png') }}); width: 160px;"></div>

			<div>
				<div class="d-flex justify-content-between mb-4">
					<div>
						<h1 class="fs-21 fw-400 d-flex align-items-center">{{ $shop -> shop_name }} <a data-bs-toggle="modal" data-bs-target="#changeStatus"><span class="badge badge-light-{{ $color[$shop -> user -> suscriber -> status] }} fw-500 fs-12 ms-3">{{ $status[$shop -> user -> suscriber -> status] }} <img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" class="f-invert" style="margin-top: -2px;"></span></a></h1>
						<span class="fs-12 text-muted d-flex align-items-center">
							<img src="{{ asset('img/admin/ico-user-mini.svg') }}" width="16" class="f-invert opacity-50 me-1"> {{ $shop -> user -> name }} &nbsp;&nbsp;
							<img src="{{ asset('img/admin/ico-mail-mini.svg') }}" width="16" class="f-invert opacity-50 me-1"> {{ $shop -> user -> email }} &nbsp;&nbsp;
							<img src="{{ asset('img/admin/ico-phone-mini.svg') }}" width="16" class="f-invert opacity-50 me-1"> {{ $shop -> user -> suscriber -> phone }}
						</span>
					</div>
				</div>

				<div class="d-flex">
					<div class="border-dashed p-3 rounded-3 lh-1 me-3">
						<span class="fs-18 d-block mb-1">$ {{ number_format($totalSales -> sum('subtotal'), 2, ',', '.') }}</span>
						<span class="fs-12 text-muted">Total</span>
					</div>
					<div class="border-dashed p-3 rounded-3 lh-1 me-3">
						<span class="fs-18 d-block mb-1">$ {{ number_format($totalGain, 2, ',', '.') }}</span>
						<span class="fs-12 text-muted">Total Ganancias</span>
					</div>
					<div class="border-dashed p-3 rounded-3 lh-1 me-3">
						<span class="fs-18 d-block mb-1">$ {{ number_format($totalMonth -> sum('subtotal'), 2, ',', '.') }}</span>
						<span class="fs-12 text-muted">Este mes</span>
					</div>
					<div class="border-dashed p-3 rounded-3 lh-1">
						<span class="fs-18 d-block mb-1">$ {{ number_format($totalGainMonth, 2, ',', '.') }}</span>
						<span class="fs-12 text-muted">Ganancias este mes</span>
					</div>
				</div>
			</div>
		</div>

		<div>
			<ul class="nav nav-tabs border-0 mb-0 mt-3" id="myTab" wire:ignore role="tablist">
				<li class="nav-item me-4" role="presentation">
					<button class="nav-link active px-0 border-0 rounded-0" id="general-tab" data-bs-toggle="tab" data-bs-target="#general-tab-pane" type="button" role="tab" aria-controls="general-tab-pane" aria-selected="true">Información General</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link px-0 border-0 rounded-0" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders-tab-pane" type="button" role="tab" aria-controls="orders-tab-pane" aria-selected="false">Pedidos</button>
				</li>
			</ul>
		</div>
	</div>

	@php
		$plan = [NULL => 'Sin asignar', 1 => 'Basic', 2 => 'Premium'];
		$plan_color = [NULL => 'secondary', 1 => 'info', 2 => 'success'];
	@endphp

	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="general-tab-pane" role="tabpanel" aria-labelledby="general-tab" wire:ignore.self tabindex="0">
			<div class="border-dashed bg-dark-2 br-10 mb-4">
				<div class="border-bottom-dashed px-4 py-3 d-flex justify-content-between align-items-center">
					<h2 class="fs-18 m-0 fw-500">Detalles de perfil</h2>

					@if ( Auth::user() -> user_type != 8 )
						<button data-bs-toggle="modal" data-bs-target="#editModal" class="bg-cian border-0 text-white px-3 py-2 rounded-3 ms-2 fs-14 text-nowrap">Editar información</button>
					@endif
				</div>
				<div class="p-4">
					<table class="table table-borderless fs-14 text-white">
						<tbody>
							<tr>
								<td class="text-muted">Tienda</td>
								<td>{{ $shop -> name }}</td>
							</tr>
							<tr>
								<td class="text-muted">Plan</td>
								<td><span class="px-2 py-1 rounded-3 fw-500 badge-light-{{ $plan_color[$shop -> user -> suscriber -> plan] }}">{{ $plan[$shop -> user -> suscriber -> plan] }}</span></td>
							</tr>
							<tr>
								<td class="text-muted">Dirección web</td>
								<td>
									@if ( $shop -> domain && $shop -> domain_status )
										@php $url = 'https://' . $shop -> domain; @endphp
										@if ( $shop -> domain_status == 2 )
											<a class="text-warning" target="_blank">{{ $url }}</a>
										@else
											<a class="text-info" href="{{ $url }}" target="_blank">{{ $url }}</a>
										@endif
									@else
										@php $url = url('/') . '/' . $shop -> slug; @endphp
										<a class="text-info" href="{{ $url }}" target="_blank">{{ $url }}</a>
									@endif
									
								</td>
							</tr>
							@if ( $shop -> facebook )
								<tr>
									<td class="text-muted">Facebook</td>
									<td><a class="text-info" href="https://fb.com/{{ $shop -> facebook }}" target="_blank">https://fb.com/{{ $shop -> facebook }}</a></td>
								</tr>
							@endif
							@if ( $shop -> instagram )
								<tr>
									<td class="text-muted">Instagram</td>
									<td><a class="text-info" href="https://instagram.com/{{ $shop -> instagram }}" target="_blank">https://instagram.com/{{ $shop -> instagram }}</a></td>
								</tr>
							@endif
							@if ( $shop -> whatsapp )
								<tr>
									<td class="text-muted">WhatsApp</td>
									<td><a class="text-info" href="https://wa.me/{{ $shop -> whatsapp }}" target="_blank">{{ $shop -> whatsapp }}</a></td>
								</tr>
							@endif
							<tr>
								<td class="text-muted">Nombre del propietario</td>
								<td>{{ $shop -> user -> name }}</td>
							</tr>
							<tr>
								<td class="text-muted">Email</td>
								<td>{{ $shop -> user -> email }}</td>
							</tr>
							<tr>
								<td class="text-muted">Teléfono</td>
								<td>{{ $shop -> user -> suscriber -> phone }}</td>
							</tr>
							<tr>
								<td class="text-muted">Dirección</td>
								<td>{{ $shop -> user -> suscriber -> address }}, {{ $shop -> user -> suscriber -> city }}, {{ $shop -> user -> suscriber -> province }}.</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="tab-pane fade" id="orders-tab-pane" role="tabpanel" aria-labelledby="orders-tab" wire:ignore.self tabindex="0">
			@php
				$status_order = ['', 'Pendiente de pago', 'Pagado', 'Pago en proceso', 'Rechazado', 'Solicitud de envío', 'Solicitud de envío aprobada', 'En preparación', 'Listo para entregar', 'Despachado', 'Cancelado'];
				$status_color = ['', 'warning', 'success', 'warning', 'danger', 'primary', 'primary', 'secondary', 'info', 'success', 'secondary'];
				$payment_method = ['', 'Efectivo', 'Deposito/Transferencia', 'Mercado Pago'];
			@endphp

			<div class="bg-dark-2 border-dashed p-4 br-10">
				<div class="d-flex justify-content-between mb-4">
					<div class="border-0 bg-dark-3 rounded-3 p-2">
						<img src="{{ asset('img/admin/ico-search.svg') }}" width="24" class="f-invert opacity-25">
						<input class="bg-transparent border-0 text-white" type="text" wire:model="customer" placeholder="Buscar">
					</div>

					<div class="d-flex">
						<select class="form-select bg-dark-3 fs-14 text-white border-0 rounded-3" wire:model="status">
							<option value="">Estado</option>
							@foreach ($status_order as $key => $value)
								@if ( $key )
									<option value="{{ $key }}">{{ $value }}</option>
								@endif
							@endforeach
						</select>
					</div>
				</div>

				@if ( $orders -> count() )
					<div class="table-responsive">
						<table class="table table-borderless">
							<thead class="fs-12 text-muted opacity-50 text-uppercase">
								<tr>
									<th class="fw-600 ps-0">Orden</th>
									<th class="fw-600">Cliente</th>
									<th class="fw-600 text-center">Estado</th>
									<th class="fw-600">Total</th>
									<th class="fw-600">Fecha</th>
									<th></th>
								</tr>
							</thead>
							<tbody class="text-white fs-14">
								@foreach ($orders as $order)
									<tr class="border-bottom-dashed align-middle">
										<td class="ps-0 py-3">{{ str_pad($order -> id, 8, '0', STR_PAD_LEFT) }}</td>
										<td>{{ $order -> customer_name }}</td>
										<td class="text-center"><span class="badge fw-500 badge-light-{{ $status_color[$order -> status] }}">{{ $status_order[$order -> status] }}</span></td>
										<td class="opacity-50">$ {{ number_format($order -> total, 2, '.', ',' ) }}</td>
										<td class="opacity-50">{{ $order -> created_at -> format('d/m/Y') }}</td>
										<td class="text-end pe-0">
											<a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" href="#"><img class="f-invert" src="{{ asset('img/admin/ico-view.svg') }}" width="16"></a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@else
					<p class="text-center py-5">No tienes pedidos aquí.</p>
				@endif
			</div>
		</div>
	</div>


	<div class="modal fade" wire:ignore.self id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content bg-dark-2">
				<div wire:loading wire:target="edit, image_desktopEdit, image_mobileEdit, update" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
					<div class="position-absolute top-50 start-50 translate-middle">
						<div class="spinner-border text-light" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
				<div class="modal-header border-bottom-dashed">
					<h5 class="modal-title" id="editModalLabel">Editar información</h5>
					<button type="button" class="btn-close f-invert" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body border-bottom-dashed">
					<ul class="nav nav-tabs border-0 mb-4" id="myTab" wire:ignore role="tablist">
						<li class="nav-item me-4" role="presentation">
							<button class="nav-link px-0 border-0 rounded-0 active" id="shopinfo-tab" data-bs-toggle="tab" data-bs-target="#shopinfo-tab-pane" type="button" role="tab" aria-controls="shopinfo-tab-pane" aria-selected="true">Información general</button>
						</li>
						<li class="nav-item me-4" role="presentation">
							<button class="nav-link px-0 border-0 rounded-0" id="suscription-tab" data-bs-toggle="tab" data-bs-target="#suscription-tab-pane" type="button" role="tab" aria-controls="suscription-tab-pane" aria-selected="false">Suscripción</button>
						</li>
						<li class="nav-item me-4" role="presentation">
							<button class="nav-link px-0 border-0 rounded-0" id="location-tab" data-bs-toggle="tab" data-bs-target="#location-tab-pane" type="button" role="tab" aria-controls="location-tab-pane" aria-selected="false">Ubicación</button>
						</li>
						<li class="nav-item me-4" role="presentation">
							<button class="nav-link px-0 border-0 rounded-0" id="social-tab" data-bs-toggle="tab" data-bs-target="#social-tab-pane" type="button" role="tab" aria-controls="social-tab-pane" aria-selected="false">Redes Sociales</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link px-0 border-0 rounded-0" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Perfil</button>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="shopinfo-tab-pane" role="tabpanel" aria-labelledby="shopinfo-tab" tabindex="0">
							<div class="row">
								<div class="col-sm-6">
									<div class="mb-3">
										<label class="fs-13 mb-1 opacity-75">Nombre de la tienda</label>
										<input type="text" class="form-control bg-transparent text-white" wire:model="arrayShop.shop_name">
										@error('arrayShop.shop_name')
											<span class="text-danger fs-12">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-sm-6">
									<div class="mb-3">
										<label class="fs-13 mb-1 opacity-75">Slug</label>
										<input type="text" class="form-control bg-transparent text-white" readonly wire:model.defer="arrayShop.slug">
										@error('arrayShop.slug')
											<span class="text-danger fs-12">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-sm-6">
									<div class="mb-3">
										<label class="fs-13 mb-1 opacity-75">Fecha de inicio</label>
										<input type="date" class="form-control bg-transparent text-white" wire:model.defer="arraySuscriber.start_date">
										@error('arraySuscriber.start_date')
											<span class="text-danger fs-12">{{ $message }}</span>
										@enderror
									</div>
								</div>

								@if ( $shop -> user -> suscriber -> plan == 2 )
									<div class="col-sm-6">
										<div class="mb-3">
											<label class="fs-13 mb-1 opacity-75">Dominio</label>
											<input type="text" class="form-control bg-transparent text-white" wire:model.defer="arrayShop.domain">
											@error('arrayShop.domain')
												<span class="text-danger fs-12">{{ $message }}</span>
											@enderror
										</div>
									</div>
									<div class="col-sm-6">
										<div class="mb-3">
											<label class="fs-13 mb-1 opacity-75">Estado</label>
											<select type="text" class="form-select bg-transparent text-white" wire:model.defer="arrayShop.domain_status">
												<option value="">Elegir</option>
												<option value="1">Activo</option>
												<option value="2">Pendiente</option>
											</select>
											@error('arrayShop.domain_status')
												<span class="text-danger fs-12">{{ $message }}</span>
											@enderror
										</div>
									</div>
								@endif

							</div>
						</div>

						<div class="tab-pane fade" id="suscription-tab-pane" role="tabpanel" aria-labelledby="suscription-tab" tabindex="0" wire:ignore.self>
							<div class="row">
								<div class="col-sm-6">
									<div class="mb-3">
										<label class="fs-13 mb-1 opacity-75">Fecha de renovación</label>
										<input type="date" class="form-control bg-transparent text-white" wire:model.defer="arraySuscriber.renovation_date">
										@error('arraySuscriber.renovation_date')
											<span class="text-danger fs-12">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-sm-6">
									<div class="mb-3">
										<label class="fs-13 mb-1 opacity-75">Plan</label>
										<select class="form-select bg-transparent text-white" wire:model.defer="arraySuscriber.plan">
											<option value="">Elegir</option>
											<option value="1">Basic</option>
											<option value="2">Premium</option>
										</select>
										@error('arraySuscriber.plan')
											<span class="text-danger fs-12">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-sm-6">
									<div class="mb-3">
										<label class="fs-13 mb-1 opacity-75">Método de pago</label>
										<select class="form-select bg-transparent text-white" wire:model.defer="arraySuscriber.payment_method">
											<option value="">Elegir</option>
											<option value="1">Débito automático</option>
											<option value="2">Transferencia</option>
										</select>
										@error('arraySuscriber.payment_method')
											<span class="text-danger fs-12">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-sm-6">
									<div class="mb-3">
										<label class="fs-13 mb-1 opacity-75">ID MercadoPago</label>
										<input type="text" class="form-control bg-transparent text-white" wire:model.defer="arraySuscriber.preapproval_id">
										@error('arraySuscriber.preapproval_id')
											<span class="text-danger fs-12">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="location-tab-pane" role="tabpanel" aria-labelledby="location-tab" tabindex="0" wire:ignore.self>
							<div class="row">
								<div class="col-sm-12">
									<div class="mb-3">
										<label class="fs-13 mb-1 opacity-75">Dirección</label>
										<input type="text" class="form-control bg-transparent text-white" wire:model.defer="arraySuscriber.address">
										@error('arraySuscriber.address')
											<span class="text-danger fs-12">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-sm-6">
									<div class="mb-3">
										<label class="fs-13 mb-1 opacity-75">Ciudad</label>
										<input type="text" class="form-control bg-transparent text-white" wire:model.defer="arraySuscriber.city">
										@error('arraySuscriber.city')
											<span class="text-danger fs-12">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-sm-6">
									<div class="mb-3">
										<label class="fs-13 mb-1 opacity-75">Provincia</label>
										<select class="form-select bg-dark-2 text-white" wire:model.defer="arraySuscriber.province" required>
											<option value="">Provincia</option>
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
										@error('arraySuscriber.province')
											<span class="text-danger fs-12">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="social-tab-pane" role="tabpanel" aria-labelledby="social-tab" tabindex="0" wire:ignore.self>
							<div class="row">
								<div class="mb-3">
									<label class="fs-13 mb-1 opacity-75">Facebook</label>
									<input type="text" class="form-control bg-transparent text-white" wire:model.defer="arrayShop.facebook">
									@error('arrayShop.facebook')
										<span class="text-danger fs-12">{{ $message }}</span>
									@enderror
								</div>
								<div class="mb-3">
									<label class="fs-13 mb-1 opacity-75">Instagram</label>
									<input type="text" class="form-control bg-transparent text-white" wire:model.defer="arrayShop.instagram">
									@error('arrayShop.instagram')
										<span class="text-danger fs-12">{{ $message }}</span>
									@enderror
								</div>
								<div class="mb-3">
									<label class="fs-13 mb-1 opacity-75">WhatsApp</label>
									<input type="text" class="form-control bg-transparent text-white" wire:model.defer="arrayShop.whatsapp">
									@error('arrayShop.whatsapp')
										<span class="text-danger fs-12">{{ $message }}</span>
									@enderror
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0" wire:ignore.self>
							<div class="row">
								<div class="mb-3">
									<label class="fs-13 mb-1 opacity-75">Nombre del propietario</label>
									<input type="text" class="form-control bg-transparent text-white" wire:model.defer="arrayUser.name">
									@error('arrayUser.name')
										<span class="text-danger fs-12">{{ $message }}</span>
									@enderror
								</div>
								<div class="mb-3">
									<label class="fs-13 mb-1 opacity-75">Email</label>
									<input type="text" class="form-control bg-transparent text-white" wire:model.defer="arrayUser.email">
									@error('arrayUser.email')
										<span class="text-danger fs-12">{{ $message }}</span>
									@enderror
								</div>
								<div class="mb-3">
									<label class="fs-13 mb-1 opacity-75">Teléfono</label>
									<input type="text" class="form-control bg-transparent text-white" wire:model.defer="arraySuscriber.phone">
									@error('arraySuscriber.phone')
										<span class="text-danger fs-12">{{ $message }}</span>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer border-top-0">
					<button type="button" class="btn fs-14 btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="button" class="btn fs-14 btn-primary" wire:click="update" wire:loading.attr="disabled" wire:target="update">Actualizar</button>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" wire:ignore.self id="changeStatus" tabindex="-1" aria-labelledby="changeStatusLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-dark-2">
				<div wire:loading wire:target="changeStatus" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
					<div class="position-absolute top-50 start-50 translate-middle">
						<div class="spinner-border text-light" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
				<div class="modal-header border-bottom-dashed">
					<h5 class="modal-title" id="changeStatusLabel">Cambiar estado</h5>
					<button type="button" class="btn-close f-invert" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body border-bottom-dashed">
					<div class="modal-body">
	                    <label class="fs-14 text-white-50">Estás por cambiar el estado de la tienda. Si cancelas, eliminas o deshabilitas la tienda, deberás colocar el motivo a continuanción.</label>

	                    <div class="mb-3">
		                    <select class="form-select bg-transparent text-white fs-14" wire:model.defer="status_shop">
		                    	<option value="">Estado</option>
		                    	@foreach ($status as $key => $value)
									@if ( $key ) <option value="{{ $key }}">{{ $value }}</option> @endif
								@endforeach
		                    </select>

		                    @error('status_shop')
		                    	<span class="text-danger fs-12">{{ $message }}</span>
		                    @enderror
	                    </div>

	                    <textarea class="form-control fs-14 bg-dark-2 text-white" wire:model.defer="motive_status" placeholder="Motivo"></textarea>
	                    @error('motive_status')
	                    	<span class="text-danger fs-12">{{ $message }}</span>
	                    @enderror
	                </div>
				</div>
				<div class="modal-footer border-top-0">
					<button type="button" class="btn fs-14 btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="button" class="btn fs-14 btn-primary" onclick="confirm('¿Confirma el cambio de estado?') || event.stopImmediatePropagation()" wire:click="changeStatus" wire:loading.attr="disabled" wire:target="changeStatus">Actualizar</button>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" wire:ignore.self id="rejectVoucher" tabindex="-1" aria-labelledby="rejectVoucherLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-dark-2">
				<div wire:loading wire:target="rejectVoucher" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
					<div class="position-absolute top-50 start-50 translate-middle">
						<div class="spinner-border text-light" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
				<div class="modal-header border-bottom-dashed">
					<h5 class="modal-title" id="rejectVoucherLabel">Rechar pago</h5>
					<button type="button" class="btn-close f-invert" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body border-bottom-dashed">
					<div class="modal-body">
	                    <label class="fs-14 text-white-50">Estás por eliminar el comprobante de pago. Coloca aquí el motivo para hacerle saber al suscriptor y si debe realizar alguna acción.</label>
	                    <textarea class="form-control fs-14 bg-dark-2 text-white" wire:model.defer="motive" placeholder="Motivo"></textarea>
	                </div>
				</div>
				<div class="modal-footer border-top-0">
					<button type="button" class="btn fs-14 btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="button" class="btn fs-14 btn-danger" onclick="confirm('¿Confirma la eliminación del pago?') || event.stopImmediatePropagation()" wire:click="rejectVoucher" wire:loading.attr="disabled" wire:target="rejectVoucher">Rechazar pago</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" wire:ignore.self id="activeModal" tabindex="-1" aria-labelledby="activeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-dark-2">
				<div wire:loading wire:target="activeModal" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
					<div class="position-absolute top-50 start-50 translate-middle">
						<div class="spinner-border text-light" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
				<div class="modal-header border-bottom-dashed">
					<h5 class="modal-title" id="rejectVoucherLabel">Validar pago</h5>
					<button type="button" class="btn-close f-invert" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body border-bottom-dashed">
					<div class="modal-body">
	                    <label class="fs-14 text-white-50 mb-2">¿Confirma la aprobación del pago? Coloque la fecha de pago.</label>
	                    <input class="form-control fs-14 bg-dark-2 text-white" type="date" wire:model.defer="start_date" placeholder="Fecha">
	                </div>
				</div>
				<div class="modal-footer border-top-0">
					<button type="button" class="btn fs-14 btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="button" class="btn fs-14 btn-success" wire:click="active" wire:loading.attr="disabled" wire:target="active">Aprobar pago</button>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" wire:ignore.self id="rejectDomain" tabindex="-1" aria-labelledby="rejectDomainLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-dark-2">
				<div wire:loading wire:target="rejectDomain" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
					<div class="position-absolute top-50 start-50 translate-middle">
						<div class="spinner-border text-light" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
				<div class="modal-header border-bottom-dashed">
					<h5 class="modal-title" id="rejectDomainLabel">Rechar dominio</h5>
					<button type="button" class="btn-close f-invert" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body border-bottom-dashed">
					<div class="modal-body">
	                    <label class="fs-14 text-white-50">Estás por rechazar el dominio elegido por el suscriptor. Coloca aquí el motivo para hacerle saber.</label>
	                    <textarea class="form-control fs-14 bg-dark-2 text-white" wire:model.defer="motive_domain" placeholder="Motivo"></textarea>
	                </div>
				</div>
				<div class="modal-footer border-top-0">
					<button type="button" class="btn fs-14 btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="button" class="btn fs-14 btn-danger" onclick="confirm('¿Confirma el rechazo del dominio?') || event.stopImmediatePropagation()" wire:click="rejectDomain" wire:loading.attr="disabled" wire:target="rejectDomain">Rechazar dominio</button>
				</div>
			</div>
		</div>
	</div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Actualizado correctamente</div>
                <button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <div id="liveToastDeleted" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Comprobante de pago eliminado correctamente</div>
                <button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        window.livewire.on('updated', () => {
        	$('.modal').modal('hide')
            var toast = new bootstrap.Toast(document.getElementById('liveToast'))
            toast.show()
        })
        window.livewire.on('deleted', () => {
        	$('.modal').modal('hide')
            var toast = new bootstrap.Toast(document.getElementById('liveToastDeleted'))
            toast.show()
        })
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush