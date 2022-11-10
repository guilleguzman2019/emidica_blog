<div class="p-4">
    <div class="mb-4">
        <h1 class="fs-18 fw-600 m-0">Configuración</h1>
        <span class="text-muted fs-12">Editar la configuración general del sistema</span>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="bg-dark-2 p-4 border-dashed rounded-4 mb-4 position-relative">
                <div wire:loading wire:target="update" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <span class="fs-12 text-muted fw-600">Valor del Dolar</span>
                <div class="d-flex align-items-center overflow-hidden">
                    <span class="text-muted fs-14 me-1">$</span>
                    <input class="bg-transparent flex-fill border-0 p-0 text-white fw-500 fs-56" type="number" wire:model.defer="arrayEdit.dolar">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="bg-dark-2 p-4 border-dashed rounded-4 mb-4 position-relative">
                <div wire:loading wire:target="update" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <span class="fs-16 fw-600">Envíos</span>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label class="fs-13 mb-1 opacity-75">Costo del envío<span class="text-danger fs-16">*</span></label>
                            <div class="d-flex align-items-center">
                                <span class="me-2">$</span>
                                <input class="form-control bg-transparent text-white" type="text" wire:model.defer="arrayEdit.shipping">
                            </div>

                            @error('arrayEdit.shipping')
                                <br><span class="fs-12 text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-success fs-14 px-4" wire:click="update" wire:loading.attr="disabled" wire:target="update">Actualizar configuración</button>

    {{-- TOASTs --}}
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToastUpdated" class="toast bg-primary text-white" role="alert" aria-live="assertive" aria-atomic="true">
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
            var toast = new bootstrap.Toast(document.getElementById('liveToastUpdated'))
            toast.show()
        })
    </script>
@endpush
