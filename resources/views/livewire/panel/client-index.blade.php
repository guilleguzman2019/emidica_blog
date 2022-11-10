<div class="p-4">
    <div class="mb-4">
        <h1 class="fs-18 fw-600 m-0">Clientes</h1>
        <span class="text-muted fs-12">Listado de clientes</span>
    </div>

    <div class="bg-dark-2 border-dashed p-4 br-10">
        <div class="d-flex justify-content-between mb-4">
            <div class="border-0 d-flex bg-dark-3 rounded-3 p-2">
                <img src="{{ asset('img/admin/ico-search.svg') }}" width="24" class="f-invert opacity-25">
                <input class="bg-transparent border-0 text-white flex-fill" type="text" wire:model="customer" placeholder="Buscar">
            </div>
        </div>

        @if ( $clients -> count() )

            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead class="fs-12 text-muted opacity-50 text-uppercase">
                        <tr>
                            <th class="fw-600">Nombre</th>
                            <th class="fw-600">Email</th>
                            <th class="fw-600">Teléfono</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="text-white fs-14">
                        @foreach ($clients as $client)
                            <tr class="border-bottom-dashed align-middle">
                                <td class="text-nowrap">{{ $client -> customer_name }}</td>
                                <td class="opacity-50 text-nowrap">{{ $client -> customer_email }}</td>
                                <td class="opacity-50 text-nowrap">{{ $client -> customer_phone }}</td>
                                <td class="text-end pe-0 text-nowrap">
                                    <a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" href="mailto:{{ $client -> customer_email }}" target="_blank"><img class="f-invert" src="{{ asset('img/panel/ico-email.svg') }}" width="16"></a>
                                    <a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" href="https://wa.me/{{ $client -> customer_phone }}"><img class="f-invert" src="{{ asset('img/panel/ico-wa.svg') }}" width="16"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between">
                <select class="bg-dark-3 text-white border-0 rounded-3 px-2" wire:model="paginate">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>

                @if ( $clients -> hasPages() )
                    <div class="pagination">
                        {{ $clients -> withQueryString() -> onEachSide(1) -> links() }}
                    </div>
                @endif
            </div>

        @else

            <p class="text-center py-5">No tienes clientes aquí.</p>

        @endif
    </div>
</div>
