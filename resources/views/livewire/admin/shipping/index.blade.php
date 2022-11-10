<div class="p-4">
    <div class="mb-4">
        <h1 class="fs-18 fw-600 m-0">Envíos</h1>
        <span class="text-muted fs-12">Listado de solicitudes</span>
    </div>

    @php
        $status_array = ['', 'Pendiente de pago', 'Comprobante enviado', 'Pago aprobado', 'Listo para enviar', 'Enviado'];
    @endphp

    <div class="bg-dark-2 border-dashed p-4 br-10">
        <div class="d-flex justify-content-between mb-4">
            <div class="border-0 bg-dark-3 rounded-3 p-2">
                <img src="{{ asset('img/admin/ico-search.svg') }}" width="24" class="f-invert opacity-25">
                <input class="bg-transparent border-0 text-white" type="text" wire:model="search" placeholder="Buscar">
            </div>

            @if ( Auth::user() -> user_type != 6 && Auth::user() -> user_type != 7 )
                <div class="d-flex">
                    <select class="form-select bg-dark-3 fs-14 text-white border-0 rounded-3" wire:model="status">
                        <option value="">Estado</option>
                        @foreach ($status_array as $key => $value)
                            @if ( $key ) <option value="{{ $key }}">{{ $value }}</option> @endif
                        @endforeach
                    </select>
                </div>
            @endif
        </div>

        @if ( $shops -> count() )

            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead class="fs-12 text-muted opacity-50 text-uppercase">
                        <tr>
                            <th class="fw-600 ps-0">Tienda</th>
                            <th class="fw-600 text-center">Solicitudes</th>
                            <th class="fw-600">Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="text-white fs-14">
                        @foreach ($shops as $shop)
                            <tr class="border-bottom-dashed align-middle">
                                <td>
                                    <div class="d-flex align-items-center py-2">
                                        <div class="ratio ratio-1x1 bg-img-contain me-3" style="background-image: url({{ asset($shop -> logo_foot ?? ($shop -> logo ?? 'img/admin/default.png')) }}); width: 50px;"></div>
                                        {{ $shop -> shop_name }}
                                    </div>
                                </td>
                                <td class="text-center text-white-50">
                                    @if ( $status )
                                        {{ $shop -> shippings -> where('status', $status) -> count() }}
                                    @else
                                        {{ $shop -> shippings -> count() }}
                                    @endif
                                    
                                </td>
                                <td class="text-white-50">
                                    @if ( $status )
                                        $ {{ number_format($shop -> shippings -> where('status', $status) -> sum('total'), 2, ',', '.') }}
                                    @else
                                        $ {{ number_format($shop -> shippings -> sum('total'), 2, ',', '.') }}
                                    @endif
                                </td>
                                <td class="text-end pe-0">
                                    <a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" href="{{ route('admin.shippings.shop', $shop) }}"><img class="f-invert" src="{{ asset('img/admin/ico-view.svg') }}" width="16"></a>
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

                @if ( $shops -> hasPages() )
                    <div class="pagination">
                        {{ $shops -> withQueryString() -> onEachSide(1) -> links() }}
                    </div>
                @endif
            </div>

        @else
            <p class="py-5 text-center">No tienes envios aquí</p>
        @endif
    </div>
</div>
