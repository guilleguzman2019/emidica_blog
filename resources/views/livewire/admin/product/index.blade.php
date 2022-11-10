<div class="p-4">
	<div class="mb-4">
		<h1 class="fs-18 fw-600 m-0">Productos</h1>
		<span class="text-muted fs-12">Listado</span>
	</div>

	<div class="bg-dark-2 border-dashed p-4 br-10">
		<div class="d-flex justify-content-between mb-4">
			<div class="border-0 bg-dark-3 rounded-3 p-2">
				<img src="{{ asset('img/admin/ico-search.svg') }}" width="24" class="f-invert opacity-25">
				<input class="bg-transparent border-0 text-white" type="text" wire:model="search" placeholder="Buscar">
			</div>

			<div class="d-flex align-items-center">
				<select class="form-select bg-dark-3 fs-14 text-white border-0 rounded-3" wire:model="status">
					<option value="">Estado</option>
					<option value="1">Borrador</option>
					<option value="2">Activo</option>
				</select>

				<select class="form-select bg-dark-3 fs-14 text-white border-0 rounded-3 ms-2" wire:model="category_id">
					<option value="">Categoria</option>
					@each('partials.admin.category', $categories, 'category')
				</select>

				<div class="dropdown">
					<button class="btn btn-primary fs-14 ms-2 btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Opciones</button>
					<ul class="dropdown-menu fs-14">
						<li><a class="dropdown-item" href="{{ route('admin.products.create') }}">Agregar producto</a></li>
						<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editPrice">Modificar precios</a></li>
						<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#importProducts">Importar desde Excel</a></li>
						<li><a class="dropdown-item" href="{{ route('admin.products.trash') }}">Papelera</a></li>
					</ul>
				</div>
			</div>
		</div>

		@php
			$status_prod = ['', 'Borrador', 'Activo'];
			$status_color = ['', 'danger', 'success']
		@endphp

		@if ( $products -> count() )

			<div class="table-responsive">
				<table class="table table-borderless">
					<thead class="fs-12 text-muted opacity-50 text-uppercase">
						<th class="fw-600 ps-0">Producto</th>
						<th class="fw-600">SKU</th>
						<th class="fw-600 text-center">Cantidad</th>
						<th class="fw-600 text-end">Costo</th>
						<th class="fw-600 text-end">Precio</th>
						<th class="fw-600 text-center">Ventas</th>
						<th></th>
						<th></th>
						<th></th>
					</thead>
					<tbody class="text-white fs-14">
						@foreach ($products as $product)
							<tr class="border-bottom-dashed align-middle">
								<td class="ps-0">
									<div class="d-flex align-items-center py-2">
										<div class="ratio ratio-1x1 bg-img me-3 rounded-3" style="background-image: url({{ asset($product -> image ?? 'img/admin/default.png') }}); width: 50px;"></div>
										<div class="lh-sm">
											{{ $product -> name }}<br>
											<span class="fs-12 text-muted">{{ $product -> slug }}</span>
										</div>
									</div>
								</td>
								<td class="opacity-50">{{ $product -> sku }}</td>
								<td class="opacity-50 text-center">{{ $product -> getStockAttribute() }}</td>
								<td class="text-end">u$d {{ number_format($product -> price_cost, 2, '.', ',') }}</td>
								<td class="text-end">
									@php $price_regular = (($product -> price_cost * $settings -> dolar) * $product -> price_regular/100) + ($product -> price_cost * $settings -> dolar); @endphp
									AR$ {{ number_format($price_regular, 2, '.', ',') }}</td>
								<td class="text-center">{{ $product -> sales }}</td>
								<td class="text-center">
									<span class="badge fw-500 badge-light-{{ $status_color[$product -> status] }}">{{ $status_prod[$product -> status] }}</span>
								</td>
								<td class="text-center">
									<img src="{{ asset($product -> featured ? 'img/admin/ico-star-filled.svg' : 'img/admin/ico-star-empty.svg') }}" width="16">
								</td>
								<td class="pe-0 text-end text-nowrap">
									<a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" href="{{ route('admin.products.edit', $product) }}"><img class="f-invert" src="{{ asset('img/admin/ico-edit.svg') }}" width="16"></a>
									<a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" onclick="confirm('¿Seguro que deseas eliminar este producto?') || event.stopImmediatePropagation()" wire:click="delete('{{ $product -> slug }}')" wire:loading.attr="disabled" wire:target="delete('{{ $product -> slug }}')"><img class="f-invert" src="{{ asset('img/admin/ico-delete.svg') }}" width="16"></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<div class="d-flex justify-content-between">
				<select class="bg-dark-3 text-white border-0 rounded-3 px-2" wire:model="paginate">
					<option value="10">10</option>
					<option value="20">20</option>
					<option value="50">50</option>
					<option value="100">100</option>
				</select>

				@if ( $products -> hasPages() )
					<div class="pagination">
						{{ $products -> withQueryString() -> onEachSide(1) -> links() }}
					</div>
				@endif
			</div>

		@else

			<p class="text-center py-5">No tienes productos aquí.</p>

		@endif

		<div class="modal fade" wire:ignore.self id="importProducts" tabindex="-1" aria-labelledby="importProductsLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content bg-dark-2">
					<div wire:loading wire:target="updatePrice" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
						<div class="position-absolute top-50 start-50 translate-middle">
							<div class="spinner-border text-light" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
						</div>
					</div>
					<div class="modal-header border-bottom-dashed">
						<h5 class="modal-title" id="importProductsLabel">Importar</h5>
						<button type="button" class="btn-close f-invert" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="fs-13 mb-1 opacity-75">Cargar archivo<span class="text-danger fs-16">*</span></label>
							<input class="form-control" type="file" wire:model.defer="excel">

							@error('excel')
								<span class="fs-12 text-danger">{{ $message }}</span>
							@enderror
						</div>
					</div>
					<div class="modal-footer pt-0 border-top-0">
						<button type="button" class="btn fs-14 btn-secondary" data-bs-dismiss="modal">Cancelar</button>
						<button type="button" class="btn fs-14 btn-primary" wire:click="importExcel" wire:loading.attr="disabled" wire:target="importExcel">Importar</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" wire:ignore.self id="editPrice" tabindex="-1" aria-labelledby="editPriceLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content bg-dark-2">
					<div wire:loading wire:target="updatePrice" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
						<div class="position-absolute top-50 start-50 translate-middle">
							<div class="spinner-border text-light" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
						</div>
					</div>
					<div class="modal-header border-bottom-dashed">
						<h5 class="modal-title" id="editPriceLabel">Editar precios</h5>
						<button type="button" class="btn-close f-invert" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="fs-13 mb-1 opacity-75">Categoría<span class="text-danger fs-16">*</span></label>
							<select class="form-select bg-transparent text-white" wire:model.defer="editPrice.category_id">
								<option value="">Elegir categoría</option>
								@each('partials.admin.category', $categories, 'category')
							</select>

							@error('editPrice.category_id')
								<span class="fs-12 text-danger">{{ $message }}</span>
							@enderror
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="mb-3">
									<label class="fs-13 mb-2 opacity-75">Tipo<span class="text-danger fs-16">*</span></label><br>
									<select class="form-select bg-transparent text-white" wire:model.defer="editPrice.type">
										<option value="1">Aumento</option>
										<option value="2">Descuento</option>
									</select>

									@error('editPrice.type')
										<span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="col-sm-6">
								<div class="mb-3">
									<label class="fs-13 mb-2 opacity-75">Porcentaje<span class="text-danger fs-16">*</span></label><br>
									<input type="number" class="form-control bg-transparent text-white" wire:model.defer="editPrice.percent">

									@error('editPrice.percent')
										<span class="fs-12 text-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer pt-0 border-top-0">
						<button type="button" class="btn fs-14 btn-secondary" data-bs-dismiss="modal">Cancelar</button>
						<button type="button" class="btn fs-14 btn-primary" wire:click="updatePrice" wire:loading.attr="disabled" wire:target="updatePrice">Actualizar</button>
					</div>
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