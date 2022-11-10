<div class="p-4">
    <div class="mb-4">
        <h1 class="fs-18 fw-600 m-0">Envíos</h1>
        <span class="text-muted fs-12">Detalle del envío</span>
    </div>

    @php
        $status_array = ['', 'Pendiente de pago', 'Comprobantes enviado', 'Pago aprobado', 'Listo para enviar', 'Enviado'];
        $color = ['', 'warning', 'primary', 'info', 'danger', 'success'];
    @endphp

    @if ( $shipping -> status == 1 )
        <div class="alert alert-danger text-center fs-16">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect></svg><br>
            Se estará comunicando con vos uno de nuestros ejecutivos de cuentas para enviarte la información del pago.<br>Si ya has hecho un pago anteriormente por otro envío, <span class="fw-600">ES MUY IMPORANTE QUE NO ENVÍES EL PAGO A NINGUNA CUENTA</span> hasta que el ejecutivo te indique los datos de la misma.
        </div>
    @endif


    <div class="row">
        <div class="col-sm-3">
            <div class="sticky-sm-top">
                <div class="bg-dark-2 border-dashed p-4 br-10 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="text-uppercase fs-18 fw-500">Envío #{{ $shipping -> id }}</h3>
                        <span class="badge fw-500 badge-light-{{ $color[$shipping -> status] }}">{{ $status_array[$shipping -> status] }}</span>
                    </div>

                    <table class="table table-borderless">
                        <tbody class="text-white fs-14">
                            <tr class="border-bottom text-white-50 border-light border-opacity-10 align-middle">
                                <td class="ps-0 py-3">Subtotal</td>
                                <td class="text-end pe-0">$ {{ number_format($shipping -> subtotal, 2, ',', '.') }}</td>
                            </tr>
                            @if ( $shipping -> shipping_cost )
                                <tr class="border-bottom text-white-50 border-light border-opacity-10 align-middle">
                                    <td class="ps-0 py-3">Envio a tienda</td>
                                    <td class="text-end pe-0">$ {{ number_format($shipping -> shipping_cost, 2, ',', '.') }}</td>
                                </tr>
                            @endif
                            <tr class="align-middle fs-16 fw-600">
                                <td class="ps-0 py-3">TOTAL a abonar</td>
                                <td class="text-end pe-0">$ {{ number_format($shipping -> total, 2, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    @if ( $shipping -> status == 1 || $shipping -> status == 2 )
                        <button onclick="confirm('¿Seguro que deseas cancelar este envío?') || event.stopImmediatePropagation()" wire:click="destroy" wire:loading.attr="disabled" wire:target="destroy" class="btn btn-danger fs-14">Cancelar envío</button>
                    @endif
                </div>

                @if ( $shipping -> status == 1 )
                    <div class="bg-dark-2 border-dashed p-4 br-10 sticky-sm-top mb-4">
                        <h3 class="fs-18 fw-500">Adjuntar comprobante</h3>
                        <p class="text-white-50 fs-14">Puedes adjuntar 1 o mas comprobantes si así fuese necesario.</p>
                        <input class="form-control fs-14 bg-dark-2 text-white-50" type="file" multiple accept=".jpg,.jpeg,.png,.pdf" wire:model.defer="voucher">

                        @error('voucher')
                            <span class="text-danger fs-12">{{ $message }}</span>
                        @enderror

                        <button class="btn btn-primary w-100 fs-14 mt-2" wire:click="uploadVoucher" wire:loading.attr="disabled" wire:target="uploadVoucher, voucher">Enviar comprobantes <span class="spinner-border spinner-border-sm" role="status" wire:loading aria-hidden="true"></span></button>
                    </div>
                @endif

                @if ( $shipping -> status > 1 )
                    <div class="bg-dark-2 border-dashed p-4 br-10 sticky-sm-top mb-4">
                        <h3 class="fs-18 fw-500 mb-4">Comprobantes enviados</h3>

                        <div class="row">
                            @foreach ($shipping -> tickets as $ticket)
                                @php $extension = pathinfo($ticket -> ticket, PATHINFO_EXTENSION); @endphp
                                <div class="col-sm-4 col-6">
                                    <div class="ratio ratio-1x1 mb-2 bg-img rounded-3" style="background-image: url({{ asset( ($extension == 'pdf') ? 'img/panel/default-pdf.png' : $ticket -> ticket) }});">
                                        <div>
                                            @if ( $extension == 'pdf' )
                                                <a href="{{ asset($ticket -> ticket) }}" target="_blank" class="position-absolute w-100 h-100 top-0 start-0" style="z-index: 1"></a>
                                            @else
                                                <a href="{{ asset($ticket -> ticket) }}" data-lightbox="roadtrip" class="position-absolute w-100 h-100 top-0 start-0" style="z-index: 1"></a>
                                            @endif
                                            
                                            @if ( $shipping -> status == 2 )
                                                <div onclick="confirm('¿Seguro que deseas eliminar este comprobante?') || event.stopImmediatePropagation()" wire:click="deleteTicket({{ $ticket -> id }})" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle" style="cursor: pointer; z-index: 2"><img src="{{ asset('img/admin/ico-delete.svg') }}" width="16" height="16" class="float-start f-invert"></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-sm-9">
            @foreach ($orders as $order)
                <div class="bg-dark-2 p-4 border-dashed rounded-4 mb-4">
                    <h3 class="fs-18 fw-400">Pedido #{{ str_pad($order -> id, 8, '0', STR_PAD_LEFT) }}</h3>

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead class="fs-12 text-muted opacity-50 text-uppercase">
                                <tr>
                                    <th class="fw-600 ps-0">Producto</th>
                                    <th class="fw-600">SKU</th>
                                    <th class="fw-600 text-center">Cantidad</th>
                                    <th class="fw-600">Precio</th>
                                    <th class="fw-600 text-end pe-0">Subtotal</th>
                                </tr>
                            </thead>

                            <tbody class="text-white-50 fs-14">
                                @foreach($order -> products as $item)
                                    <tr class="border-bottom-dashed align-middle">
                                        <td class="ps-0">
                                            <div class="d-flex align-items-center py-2">
                                                <img src="{{ asset($item -> product -> image ?? 'img/shop/default.png') }}" width="42" class="me-3 rounded-3">
                                                <div>
                                                    {{ $item -> product_name }}
                                                    @if ( $item -> variation )
                                                        <span class="fs-12 text-nowrap">
                                                            @php $variation = json_decode($item -> variation, true); @endphp
                                                            @isset ( $variation['size'] )
                                                                <br>Talle: {{ $variation['size'] }}
                                                            @endisset
                                                            @isset ( $variation['color'] )
                                                                <br>Color: <span class="d-inline-block ratio ratio-1x1 border rounded-circle position-relative" style="width: 16px; top: 3px; background: {{ $variation['color'] }}"></span>
                                                            @endisset
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item -> sku }}</td>
                                        <td class="text-center">{{ $item -> quantity }}</td>
                                        <td class="text-nowrap">$ {{ number_format(($item -> price_sale > 0) ? $item -> price_sale : $item -> price_regular, 2, '.', ',') }}</td>
                                        <td class="text-end pe-0 text-nowrap">
                                            $ {{ number_format((($item -> price_sale > 0) ? $item -> price_sale : $item -> price_regular) * $item -> quantity, 2, '.', ',') }}
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end">Subtotal</td>
                                    <td class="text-end pe-0 text-nowrap">$ {{ number_format($order -> subtotal, 2, '.', ',') }}</td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end">Envío</td>
                                    <td class="text-end pe-0 text-nowrap">{{ ($order -> shipping_type == 1) ? 'A coordinar' : '$ ' . number_format( $order -> shipping_cost, 2, '.', ',') }}</td>
                                </tr>

                                <tr class="fs-18 text-white">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end">Total</td>
                                    <td class="text-end pe-0 text-nowrap">$ {{ number_format($order -> total, 2, '.', ',') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- TOASTs --}}
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToastUploaded" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Comprobantes subidos correctamente</div>
                <button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>

        <div id="liveToastDeleted" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Comprobante eliminado correctamente</div>
                <button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script type="text/javascript">
        window.livewire.on('uploaded', () => {
            var toast = new bootstrap.Toast(document.getElementById('liveToastUploaded'))
            toast.show()
        })
        window.livewire.on('deleted', () => {
            $('.modal').modal('hide')
            var toast = new bootstrap.Toast(document.getElementById('liveToastDeleted'))
            toast.show()
            Livewire.emitTo('panel.shipping.show', 'countTickets');
        })
    </script>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
