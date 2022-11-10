<div class="p-4">
	<div class="mb-4">
		<h1 class="fs-18 fw-600 m-0">Entradas</h1>
		<span class="text-muted fs-12">Listado de entradas</span>
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
					
				</select>

				<div class="dropdown">
					<button class="btn btn-primary fs-14 ms-2 btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Opciones</button>
					<ul class="dropdown-menu fs-14">
						<li><a class="dropdown-item" href="{{ route('admin.products.create') }}">Agregar entrada</a></li>
						<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editPrice">Modificar entrada</a></li>
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

		@if ( $posts -> count() )

			<div class="table-responsive">
				<table class="table table-borderless">
					<thead class="fs-12 text-muted opacity-50 text-uppercase">
						<th class="fw-600 ps-0">Imagen</th>
						<th class="fw-600">Titulo</th>
						<th class="fw-600 text-center">Contenido</th>
						<th class="fw-600 text-end">status</th>
						<th></th>
						<th></th>
						<th></th>
					</thead>
					<tbody class="text-white fs-14">
						@foreach ($posts as $item)
							<tr class="border-bottom-dashed align-middle">
								<td class="ps-0">
									<div class="d-flex align-items-center py-2">
										<div class="ratio ratio-1x1 bg-img me-3 rounded-3" style="background-image: url({{ asset($item -> image ?? 'img/admin/default.png') }}); width: 50px;"></div>
										<div class="lh-sm">
										<br>
											<span class="fs-12 text-muted"></span>
										</div>
									</div>
								</td>
								<td class="opacity-50">{{ $item -> title }}</td>
								<td class="opacity-50 text-center">{!! $item -> body !!}</td>

								@if($item -> status == 1)         
      								<td class="text-end">Borrado</td>         
								@else
									<td class="text-end">Activo</td>        
								@endif

								<td class="text-end"></td>
								<td class="text-center"></td>
								<td class="text-center">
									<span class="badge fw-500 badge-light-"></span>
								</td>
								<td class="text-center">
									<img src="" width="16">
								</td>
								<td class="pe-0 text-end text-nowrap">
									<a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" href="{{ route('admin.post.edit', $item )}}"><img class="f-invert" src="{{ asset('img/admin/ico-edit.svg') }}" width="16"></a>
									<a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" onclick="confirm('¿Seguro que deseas eliminar esta entrada?') || event.stopImmediatePropagation()" wire:click="delete('{{ $item -> slug }}')" wire:loading.attr="disabled" wire:target="delete('{{ $item -> slug }}')"><img class="f-invert" src="{{ asset('img/admin/ico-delete.svg') }}" width="16"></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			

		@else

			<p class="text-center py-5">No tienes productos aquí.</p>

		@endif

		
		
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
