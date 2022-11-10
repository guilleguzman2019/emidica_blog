<div>
    <div class="mb-3">
        <div class="form-floating">
            <input class="form-control" type="text" wire:model.defer="name" placeholder="Nombre*">
            <label>Nombre*</label>
        </div>
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <div class="form-floating">
            <input class="form-control" type="email" wire:model.defer="email" placeholder="Email*">
            <label>Email*</label>
        </div>
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <div class="form-floating">
            <input class="form-control" type="text" wire:model.defer="phone" placeholder="Teléfono">
            <label>Teléfono</label>
        </div>
    </div>
    <div class="mb-3">
        <div class="form-floating">
            <input class="form-control" type="text" wire:model.defer="subject" placeholder="Asunto">
            <label>Asunto</label>
        </div>
    </div>
    <div class="mb-5">
        <div class="form-floating">
            <textarea class="form-control" wire:model.defer="message" placeholder="Mensaje*" style="height: 120px"></textarea>
            <label>Mensaje*</label>
        </div>
        @error('message')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <input class="bg-yellow rounded-pill text-white px-5 mx-auto d-block border-0 py-2" type="button" wire:click="sendContact" wire:loading.attr="disabled" wire:target="sendContact" value="Enviar">

    <div class="text-center text-white mt-2 fs-12 w-100" wire:loading>Enviando mensaje...</div>
    <div class="alert alert-success mt-3 mb-0 {{ ( ! $response ) ? 'd-none' : '' }}">El mensaje fue enviado correctamente. Responderemos a la brevedad.</div>
</div>
