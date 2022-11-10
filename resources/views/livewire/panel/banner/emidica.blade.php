<div class="border-dashed bg-dark-2 br-10 p-4 mb-4 position-relative">
	<div wire:loading wire:target="saveBannersAdmin" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
		<div class="position-absolute top-50 start-50 translate-middle">
			<div class="spinner-border text-light" role="status">
				<span class="visually-hidden">Loading...</span>
			</div>
		</div>
	</div>

	<h2 class="fs-18">Banners de Emidica</h2>
	<p class="fs-14 text-secondary mb-4">Seleccione los banners que desea agregar a su tienda</p>

	<div class="row">
		@php $nc = 0; @endphp
		@foreach ($bannersAdmin as $ba)
			@php $nc++; @endphp
			<div class="col-sm-3 mb-4">
				<div class="ratio ratio-21x9 bg-img mb-2" style="background-image: url({{ asset($ba -> image_desktop) }});"></div>

				<div class="d-flex justify-content-center align-content-center">
					<label class="form-check-label me-2" for="check{{ $nc }}">Inactivo</label>
					<div class="form-check form-switch">
						<input class="form-check-input" wire:model="bannerAdmin.{{ $ba -> id }}" value="{{ $ba -> id }}" type="checkbox" id="check{{ $nc }}" role="switch">
					</div>
					<label class="form-check-label" for="check{{ $nc }}">Activo</label>
				</div>
			</div>
		@endforeach
	</div>

	<button class="btn btn-success fs-14 px-4" wire:click="saveBannersAdmin" wire:loading.attr="disabled" wire:target="saveBannersAdmin">Actualizar</button>
</div>