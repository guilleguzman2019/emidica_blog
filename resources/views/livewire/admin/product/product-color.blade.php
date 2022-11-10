<div class="position-relative">
	<div wire:loading wire:target="save" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
		<div class="position-absolute top-50 start-50 translate-middle">
			<div class="spinner-border text-light" role="status">
				<span class="visually-hidden">Loading...</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4">
			<div class="d-flex mb-3">
				<div class="me-3">
					<label class="fs-13 opacity-75">Color<span class="text-danger fs-16">*</span></label>
					<input class="form-control form-control-color" type="color" wire:model.defer="color">
				</div>
				<div>
					<label class="fs-13 opacity-75">Cantidad<span class="text-danger fs-16">*</span></label>
					<input class="form-control" type="number" wire:model.defer="quantity">
				</div>
			</div>

			@error('color')
				<span class="text-danger fs-12">{{ $message }}</span><br>
			@enderror

			@error('quantity')
				<span class="text-danger fs-12">{{ $message }}</span><br>
			@enderror

			<button class="bg-cian text-white fs-12 border-0 rounded-3 px-3 py-2" wire:click="save" wire:loading.attr="disabled" wire:target="save">+ Agregar variación</button>
		</div>

		<div class="col-sm-8">
			<table class="table table-borderless">
				<thead class="fs-12 text-muted opacity-50 text-uppercase">
					<th class="fw-600 ps-0">Color</th>
					<th class="fw-600 text-center">Cantidad</th>
					<th></th>
				</thead>
				<tbody class="text-white fs-14">
					@foreach ($colors as $clr)
						<tr class="border-bottom-dashed align-middle">
							<td class="ps-0">
								<label class="rounded-circle me-2 mb-2 mb-sm-0 ratio ratio-1x1" style="background-color: {{ $clr -> name }}; width: 24px;"></label>
							</td>
							<td class="text-center">
								{{ $clr -> quantity }}
							</td>
							<td class="text-end">
								<a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" wire:click="edit('{{ $clr -> id }}')" data-bs-toggle="modal" data-bs-target="#editModal"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" class="f-invert"></a>
								<a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" onclick="confirm('¿Seguro que deseas eliminar esta variación?') || event.stopImmediatePropagation()" wire:click="destroy('{{ $clr -> id }}')" wire:loading.attr="disabled" wire:target="destroy('{{ $clr -> id }}')"><img class="f-invert" src="{{ asset('img/admin/ico-delete.svg') }}" width="16"></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	
	<div class="modal fade" wire:ignore.self id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm modal-dialog-centered">
			<div class="modal-content bg-dark-2">
				<div wire:loading wire:target="edit, update" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
					<div class="position-absolute top-50 start-50 translate-middle">
						<div class="spinner-border text-light" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
				<div class="modal-header border-bottom-dashed">
					<h5 class="modal-title" id="editModalLabel">Editar variación</h5>
					<button type="button" class="btn-close f-invert" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="d-flex mb-3">
						<div class="me-3">
							<label class="fs-13 opacity-75">Color<span class="text-danger fs-16">*</span></label>
							<input class="form-control form-control-color" type="color" wire:model.defer="editArray.name">
						</div>
						<div>
							<label class="fs-13 opacity-75">Cantidad<span class="text-danger fs-16">*</span></label>
							<input class="form-control" type="number" wire:model.defer="editArray.quantity">
						</div>
					</div>

					@error('editArray.color')
						<span class="text-danger fs-12">{{ $message }}</span><br>
					@enderror

					@error('editArray.quantity')
						<span class="text-danger fs-12">{{ $message }}</span><br>
					@enderror
				</div>
				<div class="modal-footer pt-0 border-top-0">
					<button type="button" class="btn fs-14 btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="button" class="btn fs-14 btn-primary" wire:click="update" wire:loading.attr="disabled" wire:target="update">Actualizar</button>
				</div>
			</div>
		</div>
	</div>
</div>
