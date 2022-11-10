<div class="p-4">
    <div class="mb-4">
        <h1 class="fs-18 fw-600 m-0">Call To Action</h1>
        <span class="text-muted fs-12">Editar CTAs</span>
    </div>

    <div class="row gx-sm-5">
        <div class="col-sm-7">

            <div class="border-dashed bg-dark-2 br-10 p-4 mb-4 position-relative">
                <div wire:loading wire:target="bannerBg, saveBanner" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <h2 class="fs-18 mb-4">Banner</h2>

                <div class="mb-4">
                    <div class="bg-img mb-1 py-5 position-relative" style="background-image: url({{ asset( $bannerBg ? $bannerBg -> temporaryUrl() : ($settings -> cta_background ?? 'img/admin/default.png') ) }});">
                        <a onclick="$('.imageUpload').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
                        <div class="w-75 mx-auto">
                            <h1 class="fs-21 mb-3 fw-700" style="color:#000;">{{ $cta_title ?? $settings -> cta_title }}</h1>
                            <p class="fs-12" style="color:#000;">{{ $cta_description ?? $settings -> cta_description }}</p>
                            <a class="bg-dark text-white rounded-pill fs-11 px-4 py-2" href="{{ $cta_button_link ?? $settings -> cta_button_link }}">{{ $cta_button_text ?? $settings -> cta_button_text }}</a>
                        </div>
                    </div>

                    <input class="imageUpload float-start" type="file" accept=".jpg,.png,.jpeg" wire:model.defer="bannerBg" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">
                    <span class="fs-12 text-muted d-block text-center">Sólo se acepta imagenes en formato *.png, *.jpg and *.jpeg. Peso máximo 4MB.</span>

                    @error('bannerBg')
                        <span class="fs-12 text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="fs-13 mb-1 opacity-75">Título<span class="text-danger fs-16">*</span></label>
                    <input class="form-control bg-transparent text-white" type="text" wire:model="cta_title">

                    @error('cta_title')
                        <span class="fs-12 text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="fs-13 mb-1 opacity-75">Descripción<span class="text-danger fs-16">*</span></label>
                    <input class="form-control bg-transparent text-white" type="text" wire:model="cta_description">

                    @error('cta_description')
                        <span class="fs-12 text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <label class="fs-13 mb-1 opacity-75">Botón<span class="text-danger fs-16">*</span></label>
                        <input class="form-control bg-transparent text-white" type="text" wire:model="cta_button_text">

                        @error('cta_button_text')
                            <span class="fs-12 text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="fs-13 mb-1 opacity-75">Enlace<span class="text-danger fs-16">*</span></label>
                        <input class="form-control bg-transparent text-white" type="text" wire:model="cta_button_link">

                        @error('cta_button_link')
                            <span class="fs-12 text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input" type="checkbox" role="switch" value="1" wire:model.defer="cta_status" id="featured1">
                        <label class="form-check-label" for="featured1">Activo</label>
                    </div>
                </div>

                <button class="btn btn-success fs-14 px-4" wire:click="saveBanner" wire:loading.attr="disabled" wire:target="bannerBg, saveBanner">Actualizar banner</button>
            </div>
        </div>

        <div class="col-sm-5">
            <div class="border-dashed bg-dark-2 br-10 p-4 mb-4 position-relative">
                <div wire:loading wire:target="saveMessage" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <h2 class="fs-18 mb-4">Mensaje superior</h2>

                <div class="mb-3">
                    <label class="fs-13 mb-1 opacity-75">Mensaje<span class="text-danger fs-16">*</span></label>
                    <input class="form-control bg-transparent text-white" type="text" wire:model.defer="message_top">

                    @error('message_top')
                        <span class="fs-12 text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input" type="checkbox" role="switch" value="1" wire:model.defer="message_status" id="featured1">
                        <label class="form-check-label" for="featured1">Activo</label>
                    </div>
                </div>

                <button class="btn btn-success fs-14 px-4" wire:click="saveMessage" wire:loading.attr="disabled" wire:target="saveMessage">Actualizar mensaje</button>
            </div>
        </div>
    </div>

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
            var toast = new bootstrap.Toast(document.getElementById('liveToastUpdated'))
            toast.show()
        })
    </script>
@endpush