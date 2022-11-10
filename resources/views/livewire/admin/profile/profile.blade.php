<div class="bg-dark-2 border-dashed rounded-4 mb-4 position-relative">
    <div wire:loading wire:target="photo, saveProfile" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

	<h2 class="fs-18 p-4 border-bottom border-light border-opacity-10">Información de Perfil</h2>
	<div class="p-4 border-bottom-dashed">
		<div class="row justify-content-center">
			<div class="col-sm-2 col-8 mb-3 mb-sm-0">
				<div class="ratio ratio-1x1 bg-img rounded-4" style="background-image: url({{ asset($photo ? $photo -> temporaryUrl() : ( $profile_photo_path ?? 'img/admin/default.png')) }});">
					<div>
						<a onclick="$('.photo').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
					</div>
				</div>
                <input class="photo float-start" type="file" accept=".jpg,.png,.jpeg" wire:model.defer="photo" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">

                @error('photo')
                    <span class="fs-12 text-danger">{{ $message }}</span>
                @enderror
			</div>
			<div class="col-sm-10">
				<div class="mb-3">
					<label class="fs-13 mb-1 opacity-75">Nombre<span class="text-danger fs-16">*</span></label>
					<input class="form-control bg-transparent text-white" type="text" wire:model.defer="name">

					@error('name')
						<span class="fs-12 text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="mb-3">
					<label class="fs-13 mb-1 opacity-75">Email<span class="text-danger fs-16">*</span></label>
					<input class="form-control bg-transparent text-white" type="email" wire:model.defer="email">

					@error('email')
						<span class="fs-12 text-danger">{{ $message }}</span>
					@enderror
				</div>
			</div>
		</div>
	</div>
	<div class="px-4 py-3 d-flex justify-content-end">
		<button class="bg-cian px-4 py-2 fs-14 text-white border-0 rounded-3" wire:click="saveProfile" wire:loading.attr="disabled" wire:target="saveProfile">Guardar</button>
	</div>
</div>
