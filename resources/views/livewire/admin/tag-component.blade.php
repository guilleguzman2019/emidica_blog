<div class="p-4">
    <div class="mb-4">
        <h1 class="fs-18 fw-600 m-0">Etiquetas</h1>
        <span class="text-muted fs-12">Crear, editar y eliminar etiquetas</span>
    </div>

    @php
        $status_value = ['Oculto', 'Visible'];
        $status_color = ['danger', 'success'];
    @endphp

    <div class="row">
        <div class="col-sm-5">
            <div class="border-dashed bg-dark-2 br-10 p-4 mb-4 sticky-top">
                <div wire:loading wire:target="save" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <h2 class="fs-18 mb-4">Crear una nueva etiqueta</h2>

                <div class="mb-3">
                    <label class="fs-13 mb-1 opacity-75">Nombre<span class="text-danger fs-16">*</span></label>
                    <input class="form-control bg-transparent text-white" type="text" wire:model="createArray.name">
                    <span class="text-muted fs-12">{{ url('/') }}/tag/<input type="text" wire:model.defer="createArray.slug" class="border-0 bg-transparent text-muted fs-12 p-0"></span>

                    @error('createArray.name')
                        <br><span class="fs-12 text-danger">{{ $message }}</span>
                    @enderror
                    @error('createArray.slug')
                        <br><span class="fs-12 text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="fs-13 mb-2 opacity-75">Visible<span class="text-danger fs-16">*</span></label><br>
                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input" type="radio" role="switch" name="status" value="1" wire:model.defer="createArray.status" id="status1">
                        <label class="form-check-label" for="status1">SI</label>
                    </div>
                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input" type="radio" role="switch" name="status" value="0" wire:model.defer="createArray.status" id="status2" checked>
                        <label class="form-check-label" for="status2">NO</label>
                    </div>
                </div>

                <button class="btn btn-success fs-14 px-4" wire:click="save" wire:loading.attr="disabled" wire:target="save">Guardar etiqueta</button>
            </div>
        </div>

        <div class="col-sm-7">
            <div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
                <h2 class="fs-18 mb-4">Listado de Etiquetas</h2>

                <table class="table table-borderless">
                    <thead class="fs-12 text-muted opacity-50 text-uppercase">
                        <th class="fw-600 ps-0">Etiqueta</th>
                        <th class="fw-600">Slug</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody class="text-white fs-14">
                        @foreach ( $tags as $tg )
                            <tr>
                                <td class="ps-0">{{ $tg -> name }}</td>
                                <td>{{ $tg -> slug }}</td>
                                <td>
                                    <span class="badge badge-light-{{ $status_color[$tg -> status] }}">{{ $status_value[$tg -> status] }}</span>
                                </td>
                                <td class="pe-0 text-end">
                                    <a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" wire:click="edit('{{ $tg -> slug }}')" data-bs-toggle="modal" data-bs-target="#editModal"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" class="f-invert"></a>
                                    <a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" onclick="confirm('¿Seguro que deseas eliminar esta etiqueta?') || event.stopImmediatePropagation()" wire:click="destroy('{{ $tg -> slug }}')"><img src="{{ asset('img/admin/ico-delete.svg') }}" width="16" class="f-invert"></a>
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
                <div wire:loading wire:target="edit, imageEdit, imageTableEdit, icoEdit, megamenuEdit, update" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-header border-bottom-dashed">
                    <h5 class="modal-title" id="editModalLabel">Editar etiqueta</h5>
                    <button type="button" class="btn-close f-invert" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="fs-13 mb-1 opacity-75">Nombre<span class="text-danger fs-16">*</span></label>
                        <input class="form-control bg-transparent text-white" type="text" wire:model="editArray.name">
                        <span class="text-muted fs-12">{{ url('/') }}/tag/<input type="text" wire:model.defer="editArray.slug" class="border-0 bg-transparent text-muted fs-12 p-0"></span>

                        @error('editArray.name')
                            <br><span class="fs-12 text-danger">{{ $message }}</span>
                        @enderror
                        @error('editArray.slug')
                            <br><span class="fs-12 text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="fs-13 mb-2 opacity-75">Visible<span class="text-danger fs-16">*</span></label><br>
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="radio" role="switch" name="statusEdit" value="1" wire:model.defer="editArray.status" id="status1Edit">
                            <label class="form-check-label" for="status1Edit">SI</label>
                        </div>
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="radio" role="switch" name="statusEdit" value="0" wire:model.defer="editArray.status" id="status2Edit" checked>
                            <label class="form-check-label" for="status2Edit">NO</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pt-0 border-top-0">
                    <button type="button" class="btn fs-14 btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn fs-14 btn-primary" wire:click="update" wire:loading.attr="disabled" wire:target="imageEdit, imageTableEdit, icoEdit, megamenuEdit, update">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast bg-primary text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Actualizado correctamente</div>
                <button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <div id="liveToastSaved" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Guardado correctamente</div>
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
        window.livewire.on('updated', () => {
            $('.modal').modal('hide')
            var toast = new bootstrap.Toast(document.getElementById('liveToast'))
            toast.show()
        })
        window.livewire.on('saved', () => {
            $('.modal').modal('hide')
            var toast = new bootstrap.Toast(document.getElementById('liveToastSaved'))
            toast.show()
        })
        window.livewire.on('deleted', () => {
            $('.modal').modal('hide')
            var toast = new bootstrap.Toast(document.getElementById('liveToastDeleted'))
            toast.show()
        })
    </script>
@endpush