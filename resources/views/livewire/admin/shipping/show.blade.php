<div class="p-4">
    <div class="mb-4">
        <h1 class="fs-18 fw-600 m-0">Envíos</h1>
        <span class="text-muted fs-12">Detalle del envío</span>
    </div>

    @php
        $status_array = ['', 'Pendiente de pago', 'Comprobantes enviado', 'Pago aprobado', 'Listo para enviar', 'Enviado'];
        $color = ['', 'warning', 'primary', 'info', 'danger', 'success'];
    @endphp


    <div class="row">
        <div class="col-sm-3">
            <div class="sticky-top">
                <div class="border-dashed bg-dark-2 br-10 p-4 mb-4 sticky-top text-center">
                    <div class="mx-auto mb-2 ratio ratio-1x1 bg-img-contain rounded-3" style="background-image: url({{ asset($shipping -> shop -> logo_foot ?? ($shipping -> shop -> logo ?? 'img/admin/default.png')) }}); width: 80px;"></div>

                    <h1 class="fs-21 fw-400">{{ $shipping -> shop -> shop_name }}</h1>
                    <span class="fs-12 text-muted align-items-center">
                        <img src="{{ asset('img/admin/ico-user-mini.svg') }}" width="16" class="f-invert opacity-50 me-1"> {{ $shipping -> shop -> user -> name }}<br>
                        <img src="{{ asset('img/admin/ico-mail-mini.svg') }}" width="16" class="f-invert opacity-50 me-1"> {{ $shipping -> shop -> user -> email }}<br>
                        <img src="{{ asset('img/admin/ico-phone-mini.svg') }}" width="16" class="f-invert opacity-50 me-1"> {{ $shipping -> shop -> user -> suscriber -> phone }}
                    </span>
                </div>

                <div class="bg-dark-2 border-dashed p-4 br-10 mb-4 position-relative">
                    <div wire:loading wire:target="approve, destroy" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
                        <div class="position-absolute top-50 start-50 translate-middle">
                            <div class="spinner-border text-light" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>

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
                                <td class="ps-0 py-3">TOTAL a cobrar</td>
                                <td class="text-end pe-0">$ {{ number_format($shipping -> total, 2, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    @if ( $shipping -> responsable_id )
                        <div class="bg-dark-4 p-2 mb-3 rounded-3 fs-14 fw-500 text-center">
                            <span class="fs-12 fw-300">Responsable de armado:</span><br>
                            {{ $shipping -> responsable -> name }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        @if ( Auth::user() -> user_type == 1 || Auth::user() -> user_type == 3 )
                            @if ( $shipping -> status == 2 )
                                <button onclick="confirm('¿Confirma el pago de este envío?') || event.stopImmediatePropagation()" wire:click="approve" wire:loading.attr="disabled" wire:target="approve" class="btn btn-success fs-14">Aprobar solicitud <span class="spinner-border spinner-border-sm" role="status" wire:loading wire:target="aprove" aria-hidden="true"></span></button>
                            @endif
                            @if ( $shipping -> status == 1 || $shipping -> status == 2 )
                                <button onclick="confirm('¿Seguro que deseas cancelar este envío?') || event.stopImmediatePropagation()" wire:click="destroy" wire:loading.attr="disabled" wire:target="destroy" class="btn btn-danger fs-14">Cancelar solicitud <span class="spinner-border spinner-border-sm" role="status" wire:loading wire:target="destroy" aria-hidden="true"></span></button>

                                @if ( $shipping -> shipping_cost )
                                    <button onclick="confirm('¿Confirma el descuento del envío?') || event.stopImmediatePropagation()" class="btn btn-primary fs-14" wire:click="discountShipping" wire:loading.attr="disabled" wire:target="discountShipping">Descontar Envío</button>
                                @endif
                            @endif
                        @endif
                    </div>

                    @if ( $shipping -> status == 3 && Auth::user() -> user_type == 6 && ! $shipping -> responsable_id )
                        <button onclick="confirm('¿Seguro que deseas tomar estos pedidos? Se te asignarán a ti.') || event.stopImmediatePropagation()" wire:click="takeOrders" wire:loading.attr="disabled" wire:target="takeOrders" class="btn btn-primary btn-sm w-100">Tomar pedidos</button>
                    @endif

                    @if ( Auth::user() -> user_type == 6 && $shipping -> responsable_id || ( Auth::user() -> user_type == 1 && $shipping -> status > 2 ))
                        @if ( $shipping -> status == 3 || Auth::user() -> user_type == 1 )
                            <div class="d-flex justify-content-between mb-3">
                                <a class="btn btn-primary btn-sm px-3" href="{{ route('admin.shippings.sheet', $shipping) }}" target="_blank">Imprimir pedidos</a>
                                <a class="btn btn-warning btn-sm px-3" href="{{ route('admin.shippings.control', $shipping) }}" target="_blank">Imprimir control</a>
                            </div>
                        @endif
                        @if ( $shipping -> status == 3 )
                            <button onclick="confirm('¿Confirma que los pedidos están listos para su envío?') || event.stopImmediatePropagation()" wire:click="ordersEnded" wire:loading.attr="disabled" wire:target="ordersEnded" class="btn btn-success btn-sm mt-3 w-100">Listo para enviar</button>
                        @endif
                    @endif

                    @if ( ( Auth::user() -> user_type == 1 || Auth::user() -> user_type == 7 ) && $shipping -> status == 4 )
                        <button onclick="confirm('¿Confirma que los pedidos fueron enviados? También recuerda que puedes colocar el código de seguimiento en cada pedido.') || event.stopImmediatePropagation()" wire:click="ordersSent" wire:loading.attr="disabled" wire:target="ordersSent" class="btn btn-warning btn-sm w-100">Pedidos enviados</button>
                    @endif
                </div>

                @if ( $shipping -> status > 1 )
                    @if ( Auth::user() -> user_type == 1 || Auth::user() -> user_type == 3 )
                        <div class="bg-dark-2 border-dashed p-4 br-10 sticky-top">
                            <h3 class="fs-18 fw-500 mb-4">Comprobantes enviados</h3>

                            <div class="row">
                                @foreach ($shipping -> tickets as $tckt)
                                    @php $extension = pathinfo($tckt -> ticket, PATHINFO_EXTENSION); @endphp
                                    <div class="col-sm-4">
                                        <div class="ratio ratio-1x1 mb-2 bg-img rounded-3" style="background-image: url({{ asset( ($extension == 'pdf') ? 'img/panel/default-pdf.png' : $tckt -> ticket) }});">
                                            <div>
                                                @if ( $extension == 'pdf' )
                                                    <a href="{{ asset($tckt -> ticket) }}" target="_blank" class="position-absolute w-100 h-100 top-0 start-0" style="z-index: 1"></a>
                                                @else
                                                    <a href="{{ asset($tckt -> ticket) }}" data-lightbox="roadtrip" class="position-absolute w-100 h-100 top-0 start-0" style="z-index: 1"></a>
                                                @endif

                                                @if ( $shipping -> status == 2 )
                                                    <div data-bs-toggle="modal" data-bs-target="#deleteVoucher" wire:click="deleteTicket({{ $tckt -> id }})" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle" style="cursor: pointer; z-index: 2"><img src="{{ asset('img/admin/ico-delete.svg') }}" width="16" height="16" class="float-start f-invert"></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>

        <div class="col-sm-9">
            @foreach ($orders as $order)
                <div class="bg-dark-2 p-4 border-dashed rounded-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="fs-18 fw-400">Pedido #{{ str_pad($order -> id, 8, '0', STR_PAD_LEFT) }}</h3>

                        @if ( ( Auth::user() -> user_type == 1 || Auth::user() -> user_type == 7 ) && $shipping -> status == 4 )
                            <div class="d-flex align-items-center">
                                <label class="fs-13 text-muted">Código de seguimiento:</label>
                                <input class="form-control w-auto bg-transparent text-white ms-2" type="text" wire:model.defer="trackingCode.{{ $order -> id }}">
                            </div>
                        @endif

                        @if ( $order -> tracking_code )
                            Nro. de seguimiento: {{ $order -> tracking_code }}
                        @endif
                    </div>

                    @if ( Auth::user() -> user_type == 7 || Auth::user() -> user_type == 3 || Auth::user() -> user_type == 1 )
                        @if ( $order -> shipping_type == 2  )
                            <div class="p-3 bg-dark-4 rounded-3">
                                <table class="table text-white fs-14 table-borderless m-0">
                                    <tr>
                                        <td class="py-0"><strong class="fw-600">Nombre y Apellido:</strong> {{ $order -> customer_name }}</td>
                                        <td class="py-0"><strong class="fw-600">Dirección:</strong> {{ $order -> customer_address }} {{ $order -> customer_number }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0"><strong class="fw-600">DNI:</strong> {{ $order -> customer_doc }}</td>
                                        <td class="py-0"><strong class="fw-600">Barrio:</strong> {{ $order -> customer_neighborhood }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0"><strong class="fw-600">Teléfono:</strong> {{ $order -> customer_phone }}</td>
                                        <td class="py-0"><strong class="fw-600">Localidad:</strong> {{ $order -> customer_city }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0"><strong class="fw-600">Email:</strong> {{ $order -> customer_email }}</td>
                                        <td class="py-0"><strong class="fw-600">Provincia:</strong> {{ $order -> customer_province }} (C.P.: {{ $order -> customer_zip }})</td>
                                    </tr>
                                </table>
                            </div>
                        @else
                            <div class="p-3 bg-dark-4 rounded-3">
                                <table class="table text-white fs-14 table-borderless m-0">
                                    <tr>
                                        <td class="py-0"><strong class="fw-600">Nombre y Apellido:</strong> {{ $order -> shop -> user -> name }}</td>
                                        <td class="py-0"><strong class="fw-600">Dirección:</strong> {{ $order -> shop -> user -> suscriber -> address }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0"><strong class="fw-600">DNI:</strong> {{ $order -> shop -> user -> suscriber -> doc_number }}</td>
                                        <td class="py-0"><strong class="fw-600">Localidad:</strong> {{ $order -> shop -> user -> suscriber -> city }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0"><strong class="fw-600">Teléfono:</strong> {{ $order -> shop -> user -> suscriber -> phone }}</td>
                                        <td class="py-0"><strong class="fw-600">Provincia:</strong> {{ $order -> shop -> user -> suscriber -> province }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0"><strong class="fw-600">Email:</strong> {{ $order -> customer_email }}</td>
                                        <td class="py-0"><strong class="fw-600">Cod. Postal:</strong> {{ $order -> shop -> user -> suscriber -> zip }}</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    @endif

                    @if ( $order -> comments )
                        <div class="bg-dark-3 p-3 border border-secondary rounded-4 my-3">
                            <span class="fs-14 fw-400">Comentarios:</span>

                            <span class="fs-14 text-white-50">{{ $order -> comments }}</span>
                        </div>
                    @endif

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
                                                <a href="{{ asset($item -> product -> image ?? 'img/shop/default.png') }}" data-lightbox="product-{{ $item -> id }}">
                                                    <div class="ratio ratio-1x1 bg-img me-3 rounded-3" style="background-image: url({{ asset($item -> product -> image ?? 'img/shop/default.png') }}); width: 42px;"></div>
                                                </a>
                                                <div>
                                                    {{ $item -> product_name }}
                                                    @if ( $item -> variation )
                                                        <span class="fs-12">
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
                                        <td>$ {{ number_format(($item -> price_sale > 0) ? $item -> price_sale : $item -> price_regular, 2, '.', ',') }}</td>
                                        <td class="text-end pe-0">
                                            $ {{ number_format((($item -> price_sale > 0) ? $item -> price_sale : $item -> price_regular) * $item -> quantity, 2, '.', ',') }}
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end">Subtotal</td>
                                    <td class="text-end pe-0">$ {{ number_format($order -> subtotal, 2, '.', ',') }}</td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end">Envío</td>
                                    <td class="text-end pe-0">{{ ($order -> shipping_type == 1) ? 'A coordinar' : '$ ' . number_format( $order -> shipping_cost, 2, '.', ',') }}</td>
                                </tr>

                                <tr class="fs-18 text-white">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end">Total</td>
                                    <td class="text-end pe-0">$ {{ number_format($order -> total, 2, '.', ',') }}</td>
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
        <div id="liveToastUpdated" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Envío actualizado correctamente</div>
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


    <div class="modal fade" wire:ignore.self id="deleteVoucher" tabindex="-1" aria-labelledby="deleteVoucherLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark-2">
                <div wire:loading wire:target="deleteTicket, destroyTicket" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-header border-bottom-dashed">
                    <h5 class="modal-title" id="deleteVoucherLabel">Eliminar comprobante</h5>
                    <button type="button" class="btn-close f-invert" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="fs-14 text-white-50">Estás por eliminar un comprobante de pago. Coloca aquí el motivo para hacerle saber al suscriptor.</label>
                    <textarea class="form-control fs-14 bg-dark-2 text-white" wire:model.defer="motive" placeholder="Motivo"></textarea>
                </div>
                <div class="modal-footer pt-0 border-top-0">
                    <button type="button" class="btn fs-14 btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn fs-14 btn-danger" onclick="confirm('¿Seguro que deseas eliminar este comprobante?') || event.stopImmediatePropagation()" wire:click="destroyTicket()" wire:click="update" wire:loading.attr="disabled" wire:target="destroyTicket">Eliminar</button>
                </div>
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
        window.livewire.on('deleted', () => {
            $('.modal').modal('hide')
            var toast = new bootstrap.Toast(document.getElementById('liveToastDeleted'))
            toast.show()
            Livewire.emitTo('admin.shipping.show', 'countTickets');
        })
    </script>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush