<div class="p-4">
	<div class="mb-4">
		<h1 class="fs-18 fw-600 m-0">Categorías</h1>
		<span class="text-muted fs-12">Crear, editar y eliminar categorías</span>
	</div>


	<div class="row">
		<div class="col-sm-5">
			<div class="border-dashed bg-dark-2 br-10 p-4 mb-4 sticky-top">
				<div wire:loading wire:target="save, image, imageTable, ico" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
					<div class="position-absolute top-50 start-50 translate-middle">
						<div class="spinner-border text-light" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>

				<h2 class="fs-18 mb-4">Crear una nueva categoría</h2>

				<div class="mb-3">
					<label class="fs-13 mb-1 opacity-75">Nombre<span class="text-danger fs-16">*</span></label>
					<input class="form-control bg-transparent text-white" type="text" wire:model="createArray.name">
					<span class="text-muted fs-12">{{ url('/') }}/categoria/<input type="text" wire:model.defer="createArray.slug" class="border-0 bg-transparent text-muted fs-12 p-0"></span>

					@error('createArray.name')
						<br><span class="fs-12 text-danger">{{ $message }}</span>
					@enderror
					@error('createArray.slug')
						<br><span class="fs-12 text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="mb-3">
					<label class="fs-13 mb-1 opacity-75">Categoría superior</label>
					<select class="form-select bg-dark-3 py-2 rounded-3 text-muted fs-14" wire:model="createArray.parent_id">
						<option value="">Sin categoría superior</option>
						@each('partials.admin.category', $categories, 'category')
					</select>
				</div>

				<div class="row">
					<div class="col-sm-3 mb-3 mb-sm-0">
						<label class="fs-13 mb-2 opacity-75 mb-3">Imagen</label>
						<div class="ratio ratio-1x1 mb-2 w-75 mx-auto bg-img rounded-4" style="background-image: url({{ asset($image ? $image -> temporaryUrl() : 'img/admin/default.png') }});">
							<div>
								<a onclick="$('.imageUpload').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
							</div>
						</div>
						<input class="imageUpload float-start" type="file" accept=".jpg,.png,.jpeg" wire:model.defer="image" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">

						@error('image')
							<span class="fs-12 text-danger">{{ $message }}</span>
						@enderror
					</div>

					<div class="col-sm-3 mb-3 mb-sm-0">
						<label class="fs-13 mb-2 opacity-75 mb-3">Tabla de medidas</label>
						<div class="ratio ratio-1x1 mb-2 w-75 mx-auto bg-img rounded-4" style="background-image: url({{ asset($imageTable ? $imageTable -> temporaryUrl() : 'img/admin/default.png') }});">
							<div>
								<a onclick="$('.imageTableUpload').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
							</div>
						</div>
						<input class="imageTableUpload float-start" type="file" accept=".jpg,.png,.jpeg" wire:model.defer="imageTable" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">

						@error('imageTable')
							<span class="fs-12 text-danger">{{ $message }}</span>
						@enderror
					</div>

					<div class="col-sm-3 mb-3 mb-sm-0">
						<div class="mb-3">
							<label class="fs-13 mb-2 opacity-75 mb-3">Icono</label><br>
							<div class="ratio ratio-1x1 mb-2 w-75 mx-auto bg-img rounded-4" style="background-image: url({{ asset($ico ? $ico -> temporaryUrl() : 'img/admin/default.png') }});">
								<div>
									<a onclick="$('.icoUpload').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
								</div>
							</div>
							<input class="icoUpload float-start" type="file" accept=".png,.svg" wire:model.defer="ico" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">

							@error('ico')
								<span class="fs-12 text-danger">{{ $message }}</span>
							@enderror
						</div>
					</div>

					<div class="col-sm-3 mb-3 mb-sm-0">
						<div class="mb-3">
							<label class="fs-13 mb-2 opacity-75 mb-3">Megamenu</label><br>
							<div class="ratio ratio-1x1 mb-2 w-75 mx-auto bg-img rounded-4" style="background-image: url({{ asset($megamenu ? $megamenu -> temporaryUrl() : 'img/admin/default.png') }});">
								<div>
									<a onclick="$('.megamenuUpload').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
								</div>
							</div>
							<input class="megamenuUpload float-start" type="file" accept=".png,.svg" wire:model.defer="megamenu" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">

							@error('megamenu')
								<span class="fs-12 text-danger">{{ $message }}</span>
							@enderror
						</div>
					</div>

					<div class="col-12 mb-3">
						<span class="fs-12 text-muted d-block text-center">Sólo se acepta imagenes en formato *.png, *.jpg and *.jpeg. Peso máximo 4MB.</span>
					</div>
				</div>

				<div class="mb-4">
					<label class="fs-13 mb-2 opacity-75">Destacada<span class="text-danger fs-16">*</span></label><br>
					<div class="form-check form-switch form-check-inline">
						<input class="form-check-input" type="radio" role="switch" name="featured" value="1" wire:model.defer="createArray.featured" id="featured1">
						<label class="form-check-label" for="featured1">SI</label>
					</div>
					<div class="form-check form-switch form-check-inline">
						<input class="form-check-input" type="radio" role="switch" name="featured" value="0" wire:model.defer="createArray.featured" id="featured2" checked>
						<label class="form-check-label" for="featured2">NO</label>
					</div>
				</div>

				<button class="btn btn-success fs-14 px-4" wire:click="save" wire:loading.attr="disabled" wire:target="image, imageTable, save">Guardar categoría</button>
			</div>
		</div>

		<div class="col-sm-7">
			<div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
				<h2 class="fs-18 mb-4">Listado de categorías</h2>

				<table class="table table-borderless">
					<thead class="fs-12 text-muted opacity-50 text-uppercase">
						<th class="fw-600 ps-0">Categoría</th>
						<th class="fw-600">Slug</th>
						<th></th>
						<th></th>
					</thead>
					<tbody class="text-white fs-14">
						@each('partials.admin.category-table', $categories, 'category')
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="modal fade" wire:ignore.self id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-dark-2">
				<div wire:loading wire:target="edit, imageEdit, imageTableEdit, icoEdit, megamenuEdit, update" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
					<div class="position-absolute top-50 start-50 translate-middle">
						<div class="spinner-border text-light" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
				<div class="modal-header border-bottom-dashed">
					<h5 class="modal-title" id="editModalLabel">Editar categoría</h5>
					<button type="button" class="btn-close f-invert" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label class="fs-13 mb-1 opacity-75">Nombre<span class="text-danger fs-16">*</span></label>
						<input class="form-control bg-transparent text-white" type="text" wire:model="editArray.name">
						<span class="text-muted fs-12">{{ url('/') }}/categoria/<input type="text" wire:model.defer="editArray.slug" class="border-0 bg-transparent text-muted fs-12 p-0"></span>

						@error('editArray.name')
							<br><span class="fs-12 text-danger">{{ $message }}</span>
						@enderror
						@error('editArray.slug')
							<br><span class="fs-12 text-danger">{{ $message }}</span>
						@enderror
					</div>

					<div class="mb-3">
						<label class="fs-13 mb-1 opacity-75">Categoría superior</label>
						<select class="form-select bg-dark-3 py-2 rounded-3 text-muted fs-14" wire:model="editArray.parent_id">
							<option value="">Sin categoría superior</option>
							@each('partials.admin.category', $categories, 'category')
						</select>
					</div>

					<div class="row">
						<div class="col-sm-3 mb-3 mb-sm-0">
							<label class="fs-14 fw-400 mb-3">Imagen</label>
							<div class="ratio ratio-1x1 mb-2 w-75 mx-auto bg-img rounded-4" style="background-image: url({{ asset($imageEdit ? $imageEdit -> temporaryUrl() : ( $editArray['image'] ?? 'img/admin/default.png')) }});">
								<div>
									<a onclick="$('.imageEditUpload').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
								</div>
							</div>
							<input class="imageEditUpload float-start" type="file" accept=".jpg,.png,.jpeg" wire:model.defer="imageEdit" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">

							@error('imageEdit')
								<span class="fs-12 text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="col-sm-3 mb-3 mb-sm-0">
							<label class="fs-14 fw-400 mb-3">Medidas</label>
							<div class="ratio ratio-1x1 mb-2 w-75 mx-auto bg-img rounded-4" style="background-image: url({{ asset($imageTableEdit ? $imageTableEdit -> temporaryUrl() : ( $editArray['image_reference'] ?? 'img/admin/default.png')) }});">
								<div>
									<a onclick="$('.imageTableEditUpload').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
								</div>
							</div>
							<input class="imageTableEditUpload float-start" type="file" accept=".jpg,.png,.jpeg" wire:model.defer="imageTableEdit" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">

							@error('imageTableEdit')
								<span class="fs-12 text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="col-sm-3 mb-3 mb-sm-0">
							<label class="fs-14 fw-400 mb-3">Icono</label>
							<div class="ratio ratio-1x1 mb-2 w-75 mx-auto bg-img rounded-4" style="background-image: url({{ asset($icoEdit ? $icoEdit -> temporaryUrl() : ( $editArray['ico'] ?? 'img/admin/default.png')) }});">
								<div>
									<a onclick="$('.icoEditUpload').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
								</div>
							</div>
							<input class="icoEditUpload float-start" type="file" accept=".png,.svg" wire:model.defer="icoEdit" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">

							@error('icoEdit')
								<span class="fs-12 text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="col-sm-3 mb-3 mb-sm-0">
							<label class="fs-14 fw-400 mb-3">Megamenu</label>
							<div class="ratio ratio-1x1 mb-2 w-75 mx-auto bg-img rounded-4" style="background-image: url({{ asset($megamenuEdit ? $megamenuEdit -> temporaryUrl() : ( $editArray['megamenu'] ?? 'img/admin/default.png')) }});">
								<div>
									<a onclick="$('.megamenuEditUpload').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
								</div>
							</div>
							<input class="megamenuEditUpload float-start" type="file" accept=".jpg,.jpeg,.png" wire:model.defer="megamenuEdit" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">

							@error('megamenuEdit')
								<span class="fs-12 text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="col-12 mb-3">
							<span class="fs-12 text-muted d-block text-center">Sólo se acepta imagenes en formato *.png, *.jpg and *.jpeg. Peso máximo 4MB.</span>
						</div>
					</div>

					<div class="mb-4">
						<label class="fs-13 mb-2 opacity-75">Destacada<span class="text-danger fs-16">*</span></label><br>
						<div class="form-check form-switch form-check-inline">
							<input class="form-check-input" type="radio" role="switch" name="featured" value="1" wire:model.defer="editArray.featured" id="featured1">
							<label class="form-check-label" for="featured1">SI</label>
						</div>
						<div class="form-check form-switch form-check-inline">
							<input class="form-check-input" type="radio" role="switch" name="featured" value="0" wire:model.defer="editArray.featured" id="featured2" checked>
							<label class="form-check-label" for="featured2">NO</label>
						</div>
					</div>
				</div>
				<div class="modal-footer pt-0 border-top-0">
					<button type="button" class="btn fs-14 btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="button" class="btn fs-14 btn-primary" wire:click="update" wire:loading.attr="disabled" wire:target="imageEdit, imageTableEdit, icoEdit, megamenuEdit, update">Actualizar</button>
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
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        window.livewire.on('updated', () => {
        	$('.modal').modal('hide')
            var toast = new bootstrap.Toast(document.getElementById('liveToast'))
            toast.show()
        })
    </script>
@endpush