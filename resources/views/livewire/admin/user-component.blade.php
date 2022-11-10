<div class="p-4">
    <div class="mb-4">
        <h1 class="fs-18 fw-600 m-0">Usuarios</h1>
        <span class="text-muted fs-12">Crear, editar y eliminar usuarios</span>
    </div>

    @php
        $user_type = ['', 'Administrador', 'Comercial', 'Finanzas', '', 'Gestor', 'Pedidos', 'Envíos', 'Marketing'];
        $user_color = ['', 'success', 'primary', 'warning', '', 'secondary', 'info', 'secondary', 'danger'];
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

                <h2 class="fs-18 mb-4">Crear un nuevo usuario</h2>

                <div class="mb-3">
                    <label class="fs-13 mb-1 opacity-75">Nombre<span class="text-danger fs-16">*</span></label>
                    <input class="form-control bg-transparent text-white" type="text" wire:model="name">

                    @error('name')
                        <br><span class="fs-12 text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="fs-13 mb-1 opacity-75">Email<span class="text-danger fs-16">*</span></label>
                    <input class="form-control bg-transparent text-white" type="email" wire:model="email">

                    @error('email')
                        <br><span class="fs-12 text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="fs-13 mb-1 opacity-75">Tipo de usuario</label>
                    <select class="form-select bg-dark-3 py-2 rounded-3 text-muted fs-14" wire:model="user_type">
                        <option value="">Elegir</option>
                        @foreach ($user_type as $key => $value)
                            @if ( $value ) <option value="{{ $key }}">{{ $value }}</option> @endif
                        @endforeach
                    </select>

                    @error('user_type')
                        <br><span class="fs-12 text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button class="btn btn-success fs-14 px-4" wire:click="save" wire:loading.attr="disabled" wire:target="save">Guardar usuario</button>
            </div>
        </div>

        <div class="col-sm-7">
            <div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
                <h2 class="fs-18 mb-4">Listado de usuarios</h2>

                <table class="table table-borderless">
                    <thead class="fs-12 text-muted opacity-50 text-uppercase">
                        <th class="fw-600 ps-0">Nombre</th>
                        <th class="fw-600">Email</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody class="text-white fs-14">
                        @foreach ($users as $user)
                            <tr class="border-bottom-dashed align-middle">
                                <td class="ps-0">{{ $user -> name }}</td>
                                <td class="text-white-50">{{ $user -> email }}</td>
                                <td><span class="badge fw-500 badge-light-{{ $user_color[$user -> user_type] }}">{{ $user_type[$user -> user_type] }}</span></td>
                                <td class="text-end pe-0">
                                    <a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" wire:click="edit('{{ $user -> id }}')" data-bs-toggle="modal" data-bs-target="#editModal"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" class="f-invert"></a>
                                    <a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" onclick="confirm('¿Seguro que deseas eliminar este usuario?') || event.stopImmediatePropagation()" wire:click="destroy('{{ $user -> id }}')"><img src="{{ asset('img/admin/ico-delete.svg') }}" width="16" class="f-invert"></a>
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
                <div wire:loading wire:target="edit, update" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-header border-bottom-dashed">
                    <h5 class="modal-title" id="editModalLabel">Editar usuario</h5>
                    <button type="button" class="btn-close f-invert" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="fs-13 mb-1 opacity-75">Nombre<span class="text-danger fs-16">*</span></label>
                        <input class="form-control bg-transparent text-white" type="text" wire:model="nameEdit">

                        @error('nameEdit')
                            <br><span class="fs-12 text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="fs-13 mb-1 opacity-75">Email<span class="text-danger fs-16">*</span></label>
                        <input class="form-control bg-transparent text-white" type="email" wire:model="emailEdit">

                        @error('emailEdit')
                            <br><span class="fs-12 text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="fs-13 mb-1 opacity-75">Tipo de usuario</label>
                        <select class="form-select bg-dark-3 py-2 rounded-3 text-muted fs-14" wire:model="user_typeEdit">
                            <option value="">Elegir</option>
                            @foreach ($user_type as $key => $value)
                                @if ( $value ) <option value="{{ $key }}">{{ $value }}</option> @endif
                            @endforeach
                        </select>

                        @error('user_typeEdit')
                            <br><span class="fs-12 text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer pt-0 border-top-0">
                    <button type="button" class="btn fs-14 btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn fs-14 btn-primary" wire:click="update" wire:loading.attr="disabled" wire:target="update">Actualizar</button>
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
