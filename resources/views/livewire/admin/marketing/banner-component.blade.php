<div class="p-4">
    <div class="mb-4">
        <h1 class="fs-18 fw-600 m-0">Banners</h1>
        <span class="text-muted fs-12">Crear, Editar y eliminar banners.</span>
    </div>

    <div class="row gx-sm-5">
        <div class="col-sm-5">
            <div class="border-dashed bg-dark-2 br-10 p-4 mb-4 position-relative">
                <div wire:loading wire:target="image_desktop, image_mobile, save" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <h2 class="fs-18 mb-4">Agregar Banner</h2>

                <div class="row">
                    <div class="col-sm-8 mb-3 mb-sm-0">
                        <label class="fs-13 mb-3 opacity-75">Imagen para PC<span class="text-danger fs-16">*</span></label>
                        <div class="ratio ratio-21x9 mb-2 bg-img rounded-4" style="background-image: url({{ asset($image_desktop ? $image_desktop -> temporaryUrl() : 'img/admin/default.png') }});">
                            <div>
                                <a onclick="$('.image_desktopUpload').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
                            </div>
                        </div>
                        <input class="image_desktopUpload float-start" type="file" accept=".jpg,.png,.jpeg" wire:model.defer="image_desktop" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">

                        @error('image_desktop')
                            <span class="fs-12 text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label class="fs-13 mb-3 opacity-75">Imagen para Móvil<span class="text-danger fs-16">*</span></label>
                        <div class="ratio ratio-1x1 mb-2 bg-img rounded-4" style="background-image: url({{ asset($image_mobile ? $image_mobile -> temporaryUrl() : 'img/admin/default.png') }});">
                            <div>
                                <a onclick="$('.image_mobileUpload').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
                            </div>
                        </div>
                        <input class="image_mobileUpload float-start" type="file" accept=".jpg,.png,.jpeg" wire:model.defer="image_mobile" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">

                        @error('image_mobile')
                            <span class="fs-12 text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <span class="fs-12 text-muted d-block text-center">Sólo se acepta imagenes en formato *.png, *.jpg and *.jpeg. Peso máximo 4MB.</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <label class="fs-13 mb-1 opacity-75">Ubicación<span class="text-danger fs-16">*</span></label>
                        <select class="form-select bg-transparent text-white" wire:model.defer="createArray.location">
                            <option value="">Ubicación</option>
                            <option value="1">Principal</option>
                            <option value="2">Secundario</option>
                        </select>

                        @error('createArray.location')
                            <span class="fs-12 text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="fs-13 mb-1 opacity-75">Orden</label>
                        <input class="form-control bg-transparent text-white" placeholder="0" type="number" wire:model.defer="createArray.order">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="fs-13 mb-1 opacity-75">URL</label>
                    <input class="form-control bg-transparent text-white" type="text" wire:model.defer="createArray.url" placeholder="https://">
                </div>

                <div class="row">
                    <div class="col-sm-6 mb-4">
                        <label class="fs-13 mb-1 opacity-75">Categoría<span class="text-danger fs-16">*</span></label>
                        <select class="form-select bg-dark-3 py-2 rounded-3 text-white fs-14" wire:model.defer="createArray.category_id">
                            <option value="">Elegir categoría</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category -> id }}">{{ $category -> name }}</option>
                            @endforeach
                        </select>

                        @error('createArray.category_id')
                            <span class="fs-12 text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="fs-13 mb-2 opacity-75">Estado</label><br>
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="radio" role="switch" name="status" value="1" wire:model.defer="createArray.status" id="status1">
                            <label class="form-check-label" for="status1">Activo</label>
                        </div>
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="radio" role="switch" name="status" value="0" wire:model.defer="createArray.status" id="status0">
                            <label class="form-check-label" for="status0">Borrador</label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success fs-14 px-4" wire:click="save" wire:loading.attr="disabled" wire:target="image_desktop, image_mobile, save">Guardar banner</button>
            </div>
        </div>

        <div class="col-sm-7">

            @php
                $status_banner = ['Borrador', 'Activo'];
                $status_color = ['danger', 'success'];
                $location = ['', 'Principal', 'Secundario'];
            @endphp

            <div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
                <h2 class="fs-18 mb-4">Listado de banners</h2>

                <table class="table table-borderless">
                    <thead class="fs-12 text-muted opacity-50 text-uppercase">
                        <th class="fw-600 ps-0">Imagen</th>
                        <th class="fw-600 ps-0">Ubicación</th>
                        <th class="fw-600 ps-0">Orden</th>
                        <th class="fw-600 ps-0">URL</th>
                        <th class="fw-600 ps-0">Categoría</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody class="text-white fs-14">
                        @foreach ($banners as $bnnr)
                            <tr class="border-bottom-dashed align-middle">
                                <td class="ps-0">
                                    <div class="ratio ratio-1x1 rounded-3 bg-img" style="background-image: url({{ asset($bnnr -> image_mobile ?? $bnnr -> image_desktop ) }}); width: 50px"></div>
                                </td>
                                <td>{{ $location[$bnnr -> location] }}</td>
                                <td>{{ $bnnr -> order }}</td>
                                <td>{{ $bnnr -> url }}</td>
                                <td>{{ $bnnr -> category -> name }}</td>
                                <td>
                                    <span class="badge fw-500 badge-light-{{ $status_color[$bnnr -> status] }}">{{ $status_banner[$bnnr -> status] }}</span>
                                </td>
                                <td class="pe-0 text-end">
                                    <a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" wire:click="edit('{{ $bnnr -> id }}')" data-bs-toggle="modal" data-bs-target="#editModal"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" class="f-invert"></a>
                                    <a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" onclick="confirm('¿Seguro que deseas eliminar este banner?') || event.stopImmediatePropagation()" wire:click="destroy('{{ $bnnr -> id }}')"><img src="{{ asset('img/admin/ico-delete.svg') }}" width="16" class="f-invert"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark-2">
                <div wire:loading wire:target="edit, image_desktopEdit, image_mobileEdit, update" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-header border-bottom-dashed">
                    <h5 class="modal-title" id="editModalLabel">Editar banner</h5>
                    <button type="button" class="btn-close f-invert" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-8 mb-3 mb-sm-0">
                            <label class="fs-13 mb-3 opacity-75">Imagen para PC<span class="text-danger fs-16">*</span></label>
                            <div class="ratio ratio-21x9 mb-2 bg-img rounded-4" style="background-image: url({{ asset($image_desktopEdit ? $image_desktopEdit -> temporaryUrl() : $editArray['image_desktop']) }});">
                                <div>
                                    <a onclick="$('.image_desktopEditUpload').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
                                </div>
                            </div>
                            <input class="image_desktopEditUpload float-start" type="file" accept=".jpg,.png,.jpeg" wire:model.defer="image_desktopEdit" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">

                            @error('image_desktopEdit')
                                <span class="fs-12 text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label class="fs-13 mb-3 opacity-75">Imagen para Móvil<span class="text-danger fs-16">*</span></label>
                            <div class="ratio ratio-1x1 mb-2 bg-img rounded-4" style="background-image: url({{ asset($image_mobileEdit ? $image_mobileEdit -> temporaryUrl() : ($editArray['image_mobile'] ?? 'img/admin/default.png')) }});">
                                <div>
                                    <a onclick="$('.image_mobileEditUpload').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
                                </div>
                            </div>
                            <input class="image_mobileEditUpload float-start" type="file" accept=".jpg,.png,.jpeg" wire:model.defer="image_mobileEdit" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">

                            @error('image_mobileEdit')
                                <span class="fs-12 text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <span class="fs-12 text-muted d-block text-center">Sólo se acepta imagenes en formato *.png, *.jpg and *.jpeg. Peso máximo 4MB.</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label class="fs-13 mb-1 opacity-75">Ubicación<span class="text-danger fs-16">*</span></label>
                            <select class="form-select bg-transparent text-white" wire:model.defer="editArray.location">
                                <option value="">Ubicación</option>
                                <option value="1">Principal</option>
                                <option value="2">Secundario</option>
                            </select>

                            @error('editArray.location')
                                <span class="fs-12 text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="fs-13 mb-1 opacity-75">Orden</label>
                            <input class="form-control bg-transparent text-white" placeholder="0" type="number" wire:model.defer="editArray.order">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fs-13 mb-1 opacity-75">URL</label>
                        <input class="form-control bg-transparent text-white" type="text" wire:model.defer="editArray.url" placeholder="https://">
                    </div>

                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <label class="fs-13 mb-1 opacity-75">Categoría<span class="text-danger fs-16">*</span></label>
                            <select class="form-select bg-dark-3 py-2 rounded-3 text-white fs-14" wire:model.defer="editArray.category_id">
                                <option value="">Elegir categoría</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category -> id }}">{{ $category -> name }}</option>
                                @endforeach
                            </select>

                            @error('editArray.category_id')
                                <span class="fs-12 text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="fs-13 mb-2 opacity-75">Estado</label><br>
                            <div class="form-check form-switch form-check-inline">
                                <input class="form-check-input" type="radio" role="switch" name="status" value="1" wire:model.defer="editArray.status" id="statusEdit1">
                                <label class="form-check-label" for="statusEdit1">Activo</label>
                            </div>
                            <div class="form-check form-switch form-check-inline">
                                <input class="form-check-input" type="radio" role="switch" name="status" value="0" wire:model.defer="editArray.status" id="statusEdit0">
                                <label class="form-check-label" for="statusEdit0">Borrador</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pt-0 border-top-0">
                    <button type="button" class="btn fs-14 btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn fs-14 btn-primary" wire:click="update" wire:loading.attr="disabled" wire:target="image_desktopEdit, image_mobileEdit, update">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- TOASTs --}}
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToastSave" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Guardado correctamente</div>
                <button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>

        <div id="liveToastUpdated" class="toast bg-primary text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Actualizado correctamente</div>
                <button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>

        <div id="liveToastDeleted" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Eliminado correctamente</div>
                <button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script type="text/javascript">
        window.livewire.on('saved', () => {
            var toast = new bootstrap.Toast(document.getElementById('liveToastSave'))
            toast.show()
        })
        window.livewire.on('deleted', () => {
            var toast = new bootstrap.Toast(document.getElementById('liveToastDeleted'))
            toast.show()
        })
        window.livewire.on('updated', () => {
            $('.modal').modal('hide')
            var toast = new bootstrap.Toast(document.getElementById('liveToastUpdated'))
            toast.show()
        })
    </script>
@endpush