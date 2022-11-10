<div class="p-4">
    <div class="mb-4">
        <h1 class="fs-18 fw-600 m-0">Pedidos para enviar</h1>
        <span class="text-muted fs-12">Generar solicitudes de envío</span>
    </div>

    <div class="row">
        <div class="col-sm-8">
            <div class="bg-dark-2 border-dashed p-4 br-10 position-relative mb-4">
                <p class="text-white-50 fs-14">
                    Seleccione los pedidos que quiera recibir. Una vez hecho esto, deberás hacer el depósito/transferencia por el monto total para poder procesar el pedido.
                </p>

                @if ( $orders -> count() )
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead class="fs-12 text-muted opacity-50 text-uppercase">
                                <tr>
                                    <th class="fw-600"></th>
                                    <th class="fw-600">Nro.</th>
                                    <th class="fw-600">Fecha</th>
                                    <th class="fw-600">Cliente</th>
                                    <th class="fw-600 text-center">Cant. de prod.</th>
                                    <th class="fw-600 text-end">Total</th>
                                    <th class="fw-600 text-end pe-0">A Abonar</th>
                                </tr>
                            </thead>

                            @php
                                $meses = ['', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
                            @endphp

                            <tbody class="text-white fs-14">
                                @foreach ($orders as $order)
                                    @php
                                        $total_cost = 0;
                                        foreach ( $order -> products as $item ) {
                                            $total_cost = $total_cost + ($item -> price_cost_ars * $item -> quantity);
                                            $real_cost = $total_cost;
                                        }
                                        if ( $order -> shipping_cost ) :
                                            $total_cost = $total_cost + $order -> shipping_cost;
                                        endif;
                                    @endphp
                                    <tr class="border-bottom-dashed align-middle">
                                        <td class="ps-0 py-3"><input class="form-check-input" type="checkbox" wire:model="ordersSelected.{{ $order -> id }}" value="{{ $order -> subtotal }},{{ $total_cost }},{{ $real_cost }}"></td>
                                        <td>{{ $order -> id }}</td>
                                        <td class="text-nowrap">{{ $order -> created_at -> format('d') }} {{ $meses[$order -> created_at -> format('n')] }}, {{ $order -> created_at -> format('Y') }}</td>
                                        <td>{{ $order -> customer_name }}</td>
                                        <td class="text-center">{{ $order -> products -> count() }}</td>
                                        <td class="text-end text-nowrap">$ {{ number_format($order -> subtotal, 2, ',', '.') }}</td>
                                        <td class="text-end pe-0 text-nowrap">$ {{ number_format($total_cost, 2, ',', '.') }} {!! $order -> shipping_cost ? '<span data-bs-toggle="tooltip" title="Incluye el valor del envío"><img src="' . asset('img/panel/ico-info.svg') . '" width="12" class="f-invert opacity-50"></span>' : '' !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @error('selected')
                        <span class="text-danger fs-12">{{ $message }}</span>
                    @enderror

                @else
                    <p class="py-5 text-center">No tienes pedidos aquí</p>
                @endif

            </div>
        </div>
        <div class="col-sm-4">
            <div class="bg-dark-4 p-4 br-10 sticky-sm-top">
                <div wire:loading wire:target="shippingRequest, ordersSelected" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <h3 class="text-uppercase fs-18 fw-500">Resumen</h3>
                <table class="table table-borderless">
                    <tbody class="text-white fs-14">
                        <tr class="border-bottom text-white-50 border-light border-opacity-10 align-middle">
                            <td class="ps-0 py-3">TOTAL de tus ventas</td>
                            <td class="text-end pe-0">$ {{ number_format($sumaTotal, 2, ',', '.') }}</td>
                        </tr>
                        <tr class="border-bottom text-white-50 border-light border-opacity-10 align-middle">
                            <td class="ps-0 py-3">Ganancias</td>
                            <td class="text-end pe-0">$ {{ number_format($sumaTotal - $realCost, 2, ',', '.') }}</td>
                        </tr>
                        @if ( $shipping )
                            <tr class="border-bottom text-white-50 border-light border-opacity-10 align-middle">
                                <td class="ps-0 py-3">Envio a tienda</td>
                                <td class="text-end pe-0">$ {{ number_format($settings -> shipping, 2, ',', '.') }}</td>
                            </tr>
                        @endif
                        <tr class="border-bottom border-light border-opacity-10 align-middle fs-16 fw-600">
                            <td class="ps-0 py-3">TOTAL a abonar</td>
                            <td class="text-end pe-0">$ {{ number_format($sumaCost, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>

                <button class="btn btn-primary px-4 py-2 fs-14 text-white border-0 rounded-3" {{ $sumaCost ? '' : 'disabled' }} wire:click="shippingRequest" wire:loading.attr="disabled" wire:target="shippingRequest, ordersSelected">Solicitar envío</button>
            </div>
        </div>
    </div>
</div>
