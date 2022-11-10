<div class="p-4">
    <div class="mb-4">
        <h1 class="fs-18 fw-600 m-0">Envíos</h1>
        <span class="text-muted fs-12">Listado de envíos</span>
    </div>

    @php
        $status_array = ['', 'Pendiente de pago', 'Comprobante enviado', 'Pago aprobado', 'Listo para enviar', 'Enviado'];
        $color = ['', 'warning', 'primary', 'info', 'danger', 'success'];
    @endphp

    <div class="bg-dark-2 border-dashed p-4 br-10">
        <div class="row justify-content-between mb-4">
            <div class="border-0 col-sm-3 col-6 d-flex bg-dark-3 rounded-3 p-2">
                <img src="{{ asset('img/admin/ico-search.svg') }}" width="24" class="f-invert opacity-25">
                <input class="bg-transparent border-0 text-white" type="text" wire:model="customer" placeholder="Buscar">
            </div>

            <div class="col-sm-3 col-6">
                <select class="form-select bg-dark-3 h-100 fs-14 text-white border-0 rounded-3" wire:model="status">
                    <option value="">Estado</option>
                    @foreach ($status_array as $key => $value)
                        @if ( $key ) <option value="{{ $key }}">{{ $value }}</option> @endif
                    @endforeach
                </select>
            </div>
        </div>

        @if ( $shippings -> count() )

            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead class="fs-12 text-muted opacity-50 text-uppercase">
                        <tr>
                            <th class="fw-600 ps-0">Nro.</th>
                            <th class="fw-600">Fecha</th>
                            <th class="fw-600 text-center">Pedidos</th>
                            <th class="fw-600">Subtotal</th>
                            <th class="fw-600">Envío</th>
                            <th class="fw-600">Total</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="text-white fs-14">
                        @foreach ($shippings as $shipping)
                            <tr class="border-bottom-dashed align-middle">
                                <td class="ps-0 py-3">{{ $shipping -> id }}</td>
                                <td class="text-white-50">
                                    {{ $shipping -> created_at -> format('d/m/Y') }}
                                </td>
                                <td class="text-center text-white-50">
                                    {{ $shipping -> orders -> count() }}
                                </td>
                                <td class="text-white-50">
                                    $ {{ number_format($shipping -> subtotal, 2, ',', '.') }}
                                </td>
                                <td class="text-white-50">
                                    $ {{ number_format($shipping -> shipping_cost, 2, ',', '.') }}
                                </td>
                                <td>
                                    $ {{ number_format($shipping -> total, 2, ',', '.') }}
                                </td>
                                <td>
                                    <span class="badge fw-500 badge-light-{{ $color[$shipping -> status] }}">{{ $status_array[$shipping -> status] }}</span>
                                </td>
                                <td class="text-end pe-0">
                                    <a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" href="{{ route('panel.shippings.show', $shipping) }}"><img class="f-invert" src="{{ asset('img/admin/ico-view.svg') }}" width="16"></a>
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

                @if ( $shippings -> hasPages() )
                    <div class="pagination">
                        {{ $shippings -> withQueryString() -> onEachSide(1) -> links() }}
                    </div>
                @endif
            </div>

        @else
            <p class="py-5 text-center">No tienes envios aquí</p>
        @endif
    </div>
</div>