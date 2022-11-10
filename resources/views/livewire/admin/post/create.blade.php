<div class="p-4">
	<div class="mb-4">
		<h1 class="fs-18 fw-600 m-0">Entrada</h1>
		<span class="text-muted fs-12">Crear una nueva entrada</span>
	</div>

	<div class="row">
		<div class="col-xl-3">
			<div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
				<h2 class="fs-18 mb-4">Imagen </h2>
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
                        @foreach ($categories as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
					</select>
					@error('createArray.category_id')
						<span class="fs-12 text-danger">{{ $message }}</span>
					@enderror
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
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="general-tab-pane" role="tabpanel" aria-labelledby="general-tab" wire:ignore.self tabindex="0">
					<div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
						<h2 class="fs-18 mb-4">General</h2>

						<div class="mb-3">
							<label class="fs-13 opacity-75">Nombre de la entrada<span class="text-danger fs-16">*</span></label>
							<input class="form-control bg-transparent text-white" type="text" wire:model="createArray.title">

							<span class="text-muted d-flex fs-12">{{ url('/') }}/blog/post/<input type="text"  wire:model="createArray.slug" class="border-0 bg-transparent flex-fill text-muted fs-12 p-0"></span>

							@error('createArray.title')
								<br><span class="fs-12 text-danger">{{ $message }}</span>
							@enderror
							@error('createArray.slug')
								<br><span class="fs-12 text-danger">{{ $message }}</span>
							@enderror
						</div>

						<label class="fs-13 opacity-75">Descripción<span class="text-danger fs-16">*</span></label>

						<div wire:ignore>
							<textarea class="form-control w-100"
							wire:model='body'
							x-data
							x-init="ClassicEditor
							.create( $refs.myEditor )
							.then(function(editor){
								editor.model.document.on('change:data', () => {
									@this.set('createArray.body', editor.getData())
								})
							})
							.catch( error => {
								console.error( error );
							} );"
							x-ref="myEditor"
							></textarea>
						</div>

						@error('createArray.body')
							<span class="fs-12 text-danger">{{ $message }}</span>
						@enderror
					</div>
				</div>
			</div>

			<div class="text-end">
				<button class="btn btn-success text-white" wire:click="save" wire:loading.attr="disabled" wire:target="image, save">Guardar entrada</button>
			</div>
		</div>
	</div>
</div>
