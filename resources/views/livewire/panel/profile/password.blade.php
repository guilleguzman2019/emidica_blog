<div class="bg-dark-2 border-dashed rounded-4 mb-4 position-relative">
    <div wire:loading wire:target="savePassword" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <h2 class="fs-18 p-4 border-bottom border-light border-opacity-10">Actualizar contraseña</h2>

    <div class="p-4 border-bottom-dashed">
        <div class="mb-3">
            <label class="fs-13 mb-1 opacity-75">{{ __('Current Password') }}</label>
            <input class="form-control bg-transparent text-white" type="password" wire:model.defer="current_password" />

            @error('current_password')
                <span class="fs-12 text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="fs-13 mb-1 opacity-75">{{ __('New Password') }}</label>
            <input class="form-control bg-transparent text-white" type="password" wire:model.defer="password" />

            @error('password')
                <span class="fs-12 text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="fs-13 mb-1 opacity-75">{{ __('Confirm Password') }}</label>
            <input class="form-control bg-transparent text-white" type="password" wire:model.defer="password_confirmation" />

            @error('password_confirmation')
                <span class="fs-12 text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="px-4 py-3 d-flex justify-content-end">
        <button class="bg-cian px-4 py-2 fs-14 text-white border-0 rounded-3" wire:click="savePassword" wire:loading.attr="disabled" wire:target="savePassword">Guardar</button>
    </div>
</div>
