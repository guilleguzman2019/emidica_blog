<div class="p-4">
    <div class="mb-4">
        <h1 class="fs-18 fw-600 m-0">Pedidos</h1>
        <span class="text-muted fs-12">Listado por tienda</span>
    </div>

    @php
        $status_order = ['', 'Pendiente de pago', 'Pagado', 'Pago en proceso', 'Rechazado', 'Solicitud de envío', 'Solicitud de envío aprobada', 'En preparación', 'Listo para entregar', 'Despachado'];
    @endphp

    <div class="bg-dark-2 border-dashed p-4 br-10">
        <div class="d-flex justify-content-between mb-4">
            <div class="border-0 bg-dark-3 rounded-3 p-2">
                <img src="{{ asset('img/admin/ico-search.svg') }}" width="24" class="f-invert opacity-25">
                <input class="bg-transparent border-0 text-white" type="text" wire:model="search" placeholder="Buscar">
            </div>

            <div class="d-flex">
                <select class="form-select bg-dark-3 fs-14 text-white border-0 rounded-3" wire:model="status">
                    <option value="">Estado</option>
                    @foreach ($status_order as $key => $value)
                        @if ( $key ) <option value="{{ $key }}">{{ $value }}</option> @endif
                    @endforeach
                </select>
            </div>
        </div>

        @if ( $shops -> count() )
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead class="fs-12 text-muted opacity-50 text-uppercase">
                        <th class="fw-600 ps-0">Tienda</th>
                        <th class="fw-600 text-center">Pedidos</th>
                        <th class="fw-600">Total</th>
                        <th></th>
                    </thead>
                    <tbody class="text-white fs-14">
                        @foreach ($shops as $shop)
                            <tr class="border-bottom-dashed align-middle">
                                <td class="ps-0">
                                    <div class="d-flex align-items-center py-2">
                                        <div class="ratio ratio-1x1 bg-img-contain me-3" style="background-image: url({{ asset($shop -> logo_foot ?? ($shop -> logo ?? 'img/admin/default.png')) }}); width: 50px;"></div>
                                        {{ $shop -> shop_name }}
                                    </div>
                                </td>
                                <td class="text-center">{{ $shop -> orders -> count() }}</td>
                                <td>
                                    $ {{ number_format($shop -> orders -> sum('total'), 2, ',', '.') }}
                                </td>
                                <td class="pe-0 text-end">
                                    <a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" href="{{ route('admin.orders.shop', $shop) }}"><img class="f-invert" src="{{ asset('img/admin/ico-view.svg') }}" width="16"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center py-5">No tienes pedidos aquí</p>
        @endif

    </div>
</div>
