<div class="p-4">
	<div class="mb-4">
		<h1 class="fs-18 fw-600 m-0">Productos</h1>
		<span class="text-muted fs-12">Crear un nuevo producto</span>
	</div>

	<div class="row">
		<div class="col-xl-3">
			<div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
				<h2 class="fs-18 mb-4">Imagen destacada</h2>
				<div class="ratio ratio-1x1 bg-img w-75 mx-auto rounded-4" style="background-image: url({{ asset(($image) ? $image -> temporaryUrl() : 'img/admin/default.png') }});">
					<div>
						<a onclick="$('.imageUpload').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
					</div>
				</div>
				<input class="imageUpload float-start" type="file" accept=".jpg,.png,.jpeg" wire:model="image" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">
				<span class="fs-12 text-muted d-block text-center mt-3">Sólo se acepta imagenes en formato *.png, *.jpg and *.jpeg. Peso máximo 4MB.</span>
				@error('image')
					<br><span class="fs-12 text-danger">{{ $message }}</span>
				@enderror
			</div>

			<div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
				<h2 class="fs-18 mb-4">Estado</h2>
				<select class="form-select bg-dark-3 rounded-3 py-2 text-white fs-14" wire:model.defer="createArray.status">
					<option value="1">Borrador</option>
					<option value="2">Activo</option>
				</select>
				@error('createArray.status')
					<span class="fs-12 text-danger">{{ $message }}</span>
				@enderror
			</div>

			<div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
				<h2 class="fs-18 mb-4">Detalle</h2>

				<div class="mb-3">
					<label class="fs-14 fw-400 mb-1">Categoría</label>
					<select class="form-select bg-dark-3 py-2 rounded-3 text-muted fs-14" wire:model.defer="createArray.category_id">
						<option value="">Elige una categoría</option>
						@each('partials.admin.category', $categories, 'category')
					</select>
					@error('createArray.category_id')
						<span class="fs-12 text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="mb-3">
					<label class="fs-14 fw-400 mb-1">Marca</label>
					<select class="form-select bg-dark-3 py-2 rounded-3 text-muted fs-14" wire:model.defer="createArray.brand_id">
						<option value="">Elige una marca</option>
						@foreach ($brands as $brand)
							<option value="{{ $brand -> id }}">{{ $brand -> name }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>

		<div class="col-xl-9">

			@if ($errors->any())
				<div class="bg-danger bg-opacity-10 p-2 text-danger rounded-3 fs-12" role="alert">
					@foreach ($errors->all() as $error)
						<span>• {{ $error }}</span><br>
					@endforeach
					</ul>
				</div>
			@endif

			<ul class="nav nav-tabs border-0 mb-4" id="myTab" role="tablist">
				<li class="nav-item me-4" role="presentation" wire:ignore>
					<button class="nav-link active px-0 border-0 rounded-0" id="general-tab" data-bs-toggle="tab" data-bs-target="#general-tab-pane" type="button" role="tab" aria-controls="general-tab-pane" aria-selected="true">General</button>
				</li>
				<li class="nav-item" role="presentation" wire:ignore>
					<button class="nav-link px-0 border-0 rounded-0" id="advanced-tab" data-bs-toggle="tab" data-bs-target="#advanced-tab-pane" type="button" role="tab" aria-controls="advanced-tab-pane" aria-selected="false">Avanzado</button>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="general-tab-pane" role="tabpanel" aria-labelledby="general-tab" wire:ignore.self tabindex="0">
					<div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
						<h2 class="fs-18 mb-4">General</h2>

						<div class="mb-3">
							<label class="fs-13 opacity-75">Nombre de producto<span class="text-danger fs-16">*</span></label>
							<input class="form-control bg-transparent text-white" type="text" wire:model="createArray.name">

							<span class="text-muted d-flex fs-12">{{ url('/') }}/producto/<input type="text" wire:model.defer="createArray.slug" class="border-0 bg-transparent flex-fill text-muted fs-12 p-0"></span>

							@error('createArray.name')
								<br><span class="fs-12 text-danger">{{ $message }}</span>
							@enderror
							@error('createArray.slug')
								<br><span class="fs-12 text-danger">{{ $message }}</span>
							@enderror
						</div>

						<label class="fs-13 opacity-75">Descripción<span class="text-danger fs-16">*</span></label>
						<div wire:ignore>
							<textarea class="form-control w-100"
							wire:model='description'
							x-data
							x-init="ClassicEditor
							.create( $refs.myEditor )
							.then(function(editor){
								editor.model.document.on('change:data', () => {
									@this.set('createArray.description', editor.getData())
								})
							})
							.catch( error => {
								console.error( error );
							} );"
							x-ref="myEditor"
							></textarea>
						</div>

						@error('createArray.description')
							<span class="fs-12 text-danger">{{ $message }}</span>
						@enderror
					</div>

					<div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
						<h2 class="fs-18 mb-4">Precio</h2>

						<div class="row">
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="fs-13 opacity-75">Precio de costo<span class="text-danger fs-16">*</span></label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="createArray.price_cost">

									@error('createArray.price_cost')
										<span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="fs-13 opacity-75">Precio regular (%)<span class="text-danger fs-16">*</span></label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="createArray.price_regular">

									@error('createArray.price_regular')
										<span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="fs-13 opacity-75">Precio de oferta (%)</label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="createArray.price_sale">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="advanced-tab-pane" role="tabpanel" aria-labelledby="advanced-tab" wire:ignore.self tabindex="0">
					<div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
						<h2 class="fs-18 mb-4">Características</h2>

						<div class="row">
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="fs-13 opacity-75">Dimensiones</label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="createArray.size">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="fs-13 opacity-75">Peso</label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="createArray.weight">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="fs-13 mb-2 opacity-75">Destacado<span class="text-danger fs-16">*</span></label><br>
									<div class="form-check form-switch form-check-inline">
										<input class="form-check-input" type="radio" role="switch" name="featured" value="1" wire:model.defer="createArray.featured" id="featured1">
										<label class="form-check-label" for="featured1">SI</label>
									</div>
									<div class="form-check form-switch form-check-inline">
										<input class="form-check-input" type="radio" role="switch" name="featured" value="0" wire:model.defer="createArray.featured" id="featured2" checked>
										<label class="form-check-label" for="featured2">NO</label>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
						<h2 class="fs-18 mb-4">Inventario</h2>

						<div class="row">
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="fs-13 opacity-75">SKU<span class="text-danger fs-16">*</span></label>
									<input class="form-control bg-transparent text-white" type="text" wire:model.defer="createArray.sku">

									@error('createArray.sku')
										<span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="fs-13 opacity-75">Variación<span class="text-danger fs-16">*</span></label>
									<select class="form-select bg-transparent text-white" wire:model="createArray.variation">
										<option value="">Elegir variación</option>
										<option value="1">Sin variación</option>
										<option value="2">Color</option>
										<option value="3">Tamaño/Talla</option>
									</select>

									@error('createArray.variation')
										<span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
							@if ( $createArray['variation'] == 1 )
								<div class="col-sm-4">
									<div class="mb-3">
										<label class="fs-13 opacity-75">Cantidad<span class="text-danger fs-16">*</span></label>
										<input class="form-control bg-transparent text-white" type="text" wire:model.defer="createArray.quantity">

										@error('createArray.quantity')
											<span class="fs-12 text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>

			<div class="text-end">
				<button class="btn btn-success text-white" wire:click="save" wire:loading.attr="disabled" wire:target="image, save">Guardar producto</button>
			</div>
		</div>
	</div>
</div>
