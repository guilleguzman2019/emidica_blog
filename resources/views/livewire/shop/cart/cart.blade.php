<div>
    <div class="header-category bg-img" style="background-image: url({{ asset('img/shop/cta.jpeg') }});">
        <div class="bg-dark bg-opacity-25 py-5 text-center text-white">
            <h1 class="fs-21 fw-700">Carrito de compras</h1>
        </div>
    </div>

    <div class="container py-5">
        @if ( Cart::count() )
            <div class="table-responsive">
                <table class="table align-middle mb-5">
                    <thead>
                        <tr class="fs-13 text-uppercase">
                            <th>Producto</th>
                            <th class="text-center">SKU</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>

                    <tbody class="border-0">
                        @foreach(Cart::content() as $item)
                            <tr>
                                <td class="border-light">
                                    <div class="d-flex align-items-center py-2">
                                        <div class="ratio ratio-1x1 me-4 bg-img" style="background-image: url({{ asset( $item -> options -> image ) }}); width: 112px;"></div>
                                        <div>
                                            <h3 class="fs-16 fw-600 mb-1">{{ $item -> name }}</h3>
                                            @if ( $item -> options -> size_id )
                                                <span class="fs-14 text-nowrap">Tamaño: {{ $item -> options -> size_name }}</span><br>
                                            @endif
                                            @if ( $item -> options -> color_id )
                                                <span class="fs-14 text-nowrap d-flex align-items-center">Color: 
                                                    <label class="rounded-circle ms-2 mb-2 mb-sm-0 ratio ratio-1x1" style="background-color: {{ $item -> options -> color_name }}; width: 24px;"></label>
                                                </span>
                                            @endif
                                            <a wire:click="destroy('{{ $item -> rowId }}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"><img src="{{ asset('img/shop/ico-delete.svg') }}" width="16"></a>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-light text-center">
                                    {{ $item -> options -> sku }}
                                </td>
                                <td class="border-light text-center text-nowrap">
                                    $ {{ number_format($item -> price, 2, '.', ',') }}
                                </td>
                                <td class="border-light text-center">
                                    @livewire('shop.cart.update-item', ['rowId' => $item -> rowId], key($item -> rowId))
                                </td>
                                <td class="border-light text-end text-nowrap">
                                    $ {{ number_format($item -> price * $item -> qty, 2, '.', ',') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row d-flex justify-content-between">
                <div class="col-sm-4">
                    {{--<p>¿Tienes un cupón de descuento?</p>
                    <div class="d-flex">
                        <input type="text" class="form-control rounded-pill flex-fill" wire:model="coupon" name="coupon">
                        <button class="btn btn-primary rounded-pill px-3 ms-2">Aplicar</button>
                    </div>--}}
                </div>
                <div class="col-sm-3">
                    <table class="table shadow-sm rounded-3">
                        <tbody class="border-0">
                            <tr class="table-light fw-700">
                                <td class="border-0 p-3">Subtotal</td>
                                <td class="text-end border-0 p-3">$ {{ Cart::subtotal() }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="text-end">
                        <a href="{{ route('shop.order.create', $shop) }}" class="btn btn-success rounded-pill px-4">Confirmar pedido</a>
                    </p>
                </div>
            </div>

        @else

            <div class="text-center my-5">
                <img src="{{ asset('img/shop/ico-cart.svg') }}" width="32">
                <p class="text-muted my-4">No tienes productos en tu carrito.</p>
                <a href="{{ route('shop.index', $shop) }}" class="btn btn-success">Ir a la tienda</a>
            </div>

        @endif

    </div>
</div>
