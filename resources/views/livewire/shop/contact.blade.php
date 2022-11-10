<div>
    <div class="mb-4">
        <input class="w-100 border-0 rounded-0 border-bottom border-dark px-0 py-2" placeholder="Nombre y Apellido" type="text" wire:model.defer="name">
        @error('name')
            <p class="text-sm text-danger m-0">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <input class="w-100 border-0 rounded-0 border-bottom border-dark px-0 py-2" placeholder="Correo Electrónico" type="email" wire:model.defer="email">
        @error('email')
            <p class="text-sm text-danger m-0">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <input class="w-100 border-0 rounded-0 border-bottom border-dark px-0 py-2" placeholder="Teléfono" type="text" wire:model.defer="phone">
        @error('phone')
            <p class="text-sm text-danger m-0">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <textarea class="w-100 border-0 rounded-0 border-bottom border-dark px-0 py-2" placeholder="Mensaje" rows="3" type="text" wire:model.defer="message"></textarea>
        @error('message')
            <p class="text-sm text-danger m-0">{{ $message }}</p>
        @enderror
    </div>

    <div class="d-flex justify-content-end">
        <button class="btn btn-dark rounded-0 text-white px-5 border-0 py-2" type="button" wire:click="sendForm" wire:loading.attr="disabled">Enviar <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" wire:loading></span></button>
    </div>

    <div class="alert alert-success mt-3 d-none">¡Muchas gracias por tu contacto! Recibimos tu mensaje correctamente. Responderemos a la brevedad.</div>

</div>

@push('scripts')
    <script type="text/javascript">
        window.livewire.on('sent', () => {
            $('.alert').toggleClass('d-none');
        })
    </script>
@endpush