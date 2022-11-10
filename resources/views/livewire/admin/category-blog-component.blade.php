<div class="p-4">
	<div class="mb-4">
		<h1 class="fs-18 fw-600 m-0">Categorías de Entrada</h1>
		<span class="text-muted fs-12">Crear, editar y eliminar categorías</span>
	</div>


	<div class="row">
		<div class="col-sm-5">
			<div class="border-dashed bg-dark-2 br-10 p-4 mb-4 sticky-top">
				<div wire:loading wire:target="save, image" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
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

					<div class="col-12 mb-3">
						<span class="fs-12 text-muted d-block text-center">Sólo se acepta imagenes en formato *.png, *.jpg and *.jpeg. Peso máximo 4MB.</span>
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
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category-> name}}</td>
                            <td>{{$category-> slug}}</td>
                            <td class="text-end pe-0">
                                <a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" wire:click="edit('{{ $category -> slug }}')" data-bs-toggle="modal" data-bs-target="#editModal"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" class="f-invert"></a>
                                <a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4 ms-1" onclick="confirm('¿Seguro que deseas eliminar esta categoría?') || event.stopImmediatePropagation()" wire:click="destroy('{{ $category -> slug }}')"><img src="{{ asset('img/admin/ico-delete.svg') }}" width="16" class="f-invert"></a>
                            </td>
                        </tr>
                    @endforeach	
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
						<span class="text-muted fs-12">{{ url('/') }}/categoria/<input type="text" wire:model="editArray.slug" class="border-0 bg-transparent text-muted fs-12 p-0"></span>

						@error('editArray.name')
							<br><span class="fs-12 text-danger">{{ $message }}</span>
						@enderror
						@error('editArray.slug')
							<br><span class="fs-12 text-danger">{{ $message }}</span>
						@enderror
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

						<div class="col-12 mb-3">
							<span class="fs-12 text-muted d-block text-center">Sólo se acepta imagenes en formato *.png, *.jpg and *.jpeg. Peso máximo 4MB.</span>
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
