<div class="container">
    <div class="row">
        <div class="col-sm-8 py-sm-5 pb-3 pe-sm-5">
            <nav class="breadcrumb pb-3 pt-4 pt-sm-0">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item fs-13"><a href="{{ route('shop.index', $shop) }}">Home</a></li>
                    <li class="breadcrumb-item fs-13"><a href="{{ route('shop.cart', $shop) }}">Carrito de compras</a></li>
                    <li class="breadcrumb-item fs-13 active" aria-current="page">Confirmar pedido</li>
                </ol>
            </nav>

            @if (session('status'))
                <div class="mb-4 alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif

            <h4 class="fs-18 fw-600 mb-3">Información de personal</h4>

            <div class="mb-3">
                <div class="form-floating">
                    <input class="form-control" type="text" wire:model.defer="createArray.customer_name" placeholder="Nombre y Apellido">
                    <label>Nombre y Apellido</label>
                </div>
                @error('createArray.customer_name')
                    <span class="text-danger fs-14">{{ $message }}</span>
                @enderror
            </div>
            <div class="row">
                <div class="col-sm-6 mb-3">
                    <div class="form-floating">
                        <input class="form-control" type="text" wire:model.defer="createArray.customer_phone" placeholder="Teléfono">
                        <label>Teléfono</label>
                    </div>
                    @error('createArray.customer_phone')
                        <span class="text-danger fs-14">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3">
                    <div class="form-floating">
                        <input type="email" class="form-control" wire:model.defer="createArray.customer_email" placeholder="Email">
                        <label>Email</label>
                    </div>
                    @error('createArray.customer_email')
                        <span class="text-danger fs-14">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-check form-switch fs-12 mb-4">
                <input class="form-check-input" wire:model.defer="createArray.email_marketing" type="checkbox" value="1" role="switch" id="email_marketing">
                <label class="form-check-label" for="email_marketing">Enviarme novedades y ofertas</label>
            </div>


            <h4 class="fs-18 fw-600 mt-3 mb-2">Método de envío</h4>

            <div class="mb-3">
                <div class="d-flex">
                    @if ( $shop -> delivery_coordinate )
                        <label class="border-dashed d-flex align-items-center p-3 rounded-3 me-3 shipping_type {{ $createArray['shipping_type'] == 1 ? 'active' : '' }}" wire:ignore.self onclick="$('.shipping_type').removeClass('active'); $(this).addClass('active')" style="cursor: pointer;">
                            <img src="{{ asset('img/shop/ico-chat.svg') }}" width="24" class="me-2">
                            <h3 class="fs-16 m-0">A coordinar</h3>
                            <input type="radio" class="opacity-0 float-start overflow-hidden" style="height: 1px; width: 1px;" name="shipping_type" value="1" wire:model="createArray.shipping_type">
                        </label>
                    @endif

                    @if ( $shop -> delivery_home )
                        <label class="border-dashed d-flex align-items-center p-3 rounded-3 me-3 shipping_type {{ $createArray['shipping_type'] == 2 ? 'active' : '' }}" wire:ignore.self onclick="$('.shipping_type').removeClass('active'); $(this).addClass('active')" style="cursor: pointer;">
                            <img src="{{ asset('img/shop/ico-truck.svg') }}" width="24" class="me-2">
                            <h3 class="fs-16 m-0">Envío a domicilio</h3>
                            <input type="radio" class="opacity-0 float-start overflow-hidden" style="height: 1px; width: 1px;" name="shipping_type" value="2" wire:model="createArray.shipping_type">
                        </label>
                    @endif
                </div>
                @error('createArray.shipping_type')
                    <span class="text-danger fs-14">{{ $message }}</span>
                @enderror
            </div>

            @if ( $createArray['shipping_type'] == 2 )
                <div class="row">
                    <div class="col-sm-8 mb-3">
                        <div class="form-floating">
                            <input class="form-control" type="text" wire:model.defer="createArray.customer_address" placeholder="Calle">
                            <label>Calle</label>
                        </div>
                        @error('createArray.customer_address')
                            <span class="text-danger fs-14">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="form-floating">
                            <input class="form-control" type="text" wire:model.defer="createArray.customer_number" placeholder="Nro.">
                            <label>Nro.</label>
                        </div>
                        @error('createArray.customer_number')
                            <span class="text-danger fs-14">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-12 mb-3">
                        <div class="form-floating">
                            <input class="form-control" type="text" wire:model.defer="createArray.customer_neighborhood" placeholder="Barrio">
                            <label>Barrio</label>
                        </div>
                        @error('createArray.customer_neighborhood')
                            <span class="text-danger fs-14">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="form-floating">
                            <input class="form-control" type="text" wire:model.defer="createArray.customer_city" placeholder="Teléfono">
                            <label>Ciudad</label>
                        </div>
                        @error('createArray.customer_city')
                            <span class="text-danger fs-14">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="form-floating">
                            <select class="form-select" wire:model.defer="createArray.customer_province">
                                <option value="">Provincia</option>
                                <option value="Buenos Aires">Buenos Aires</option>
                                <option value="CABA">CABA</option>
                                <option value="Catamarca">Catamarca</option>
                                <option value="Chaco">Chaco</option>
                                <option value="Chubut">Chubut</option>
                                <option value="Córdoba">Córdoba</option>
                                <option value="Corrientes">Corrientes</option>
                                <option value="Entre Ríos">Entre Ríos</option>
                                <option value="Formosa">Formosa</option>
                                <option value="Jujuy">Jujuy</option>
                                <option value="La Pampa">La Pampa</option>
                                <option value="La Rioja">La Rioja</option>
                                <option value="Mendoza">Mendoza</option>
                                <option value="Misiones">Misiones</option>
                                <option value="Neuquén">Neuquén</option>
                                <option value="Río Negro">Río Negro</option>
                                <option value="Salta">Salta</option>
                                <option value="San Juan">San Juan</option>
                                <option value="San Luis">San Luis</option>
                                <option value="Santa Cruz">Santa Cruz</option>
                                <option value="Santa Fe">Santa Fe</option>
                                <option value="Santiago del Estero">Santiago del Estero</option>
                                <option value="Tierra del Fuego">Tierra del Fuego</option>
                                <option value="Tucumán">Tucumán</option>
                            </select>
                            <label>Provincia</label>
                        </div>
                        @error('createArray.customer_province')
                            <span class="text-danger fs-14">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3">
                        <div class="form-floating">
                            <input class="form-control" type="text" wire:model.defer="createArray.customer_zip" placeholder="Código postal">
                            <label>Código postal</label>
                        </div>
                        @error('createArray.customer_zip')
                            <span class="text-danger fs-14">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-5 mb-3">
                        <div class="form-floating">
                            <input class="form-control" type="number" wire:model.defer="createArray.customer_doc" placeholder="DNI">
                            <label>DNI</label>
                        </div>
                        @error('createArray.customer_doc')
                            <span class="text-danger fs-14">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @endif

            <input type="hidden" value="{{ $token }}" name="token">
        </div>

        <div class="col-sm-4 ps-sm-5 py-sm-5 pb-5">
            <div class="bg-light br-10 p-4">
                @foreach (Cart::content() as $item)

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="pe-3 position-relative">
                            <span class="fs-11 d-block bg-secondary rounded-pill position-absolute text-white" style="top: -7px; right: 10px; z-index: 2; padding: 2px 8px">{{ $item -> qty }}</span>
                            <div class="ratio ratio-1x1 bg-img" style="background-image: url({{ asset( $item -> options -> image ) }}); width: 64px;"></div>
                        </div>

                        <div class="fs-12 flex-fill">
                            <h3 class="fs-14 fw-600 mb-1">{{ $item -> name }}</h3>
                            <span class="fs-12">
                                @if ( $item -> options -> color_id )
                                    <span class="fs-14 d-flex align-items-center">Color: 
                                        <label class="rounded-circle ms-2 ratio ratio-1x1" style="background-color: {{ $item -> options -> color_name }}; width: 16px;"></label>
                                    </span>
                                @endif
                                @if ( $item -> options -> size_id )
                                    Tamaño: {{ $item -> options -> size_name }}<br>
                                @endif
                                SKU: {{ $item -> options -> sku }}
                            </span>
                            
                        </div>

                        <div>
                            $ {{ number_format($item -> price, 2, '.', ',') }}
                        </div>
                    </div>
                @endforeach

                <hr style="opacity: .1;">

                <div class="d-flex justify-content-between align-items-center py-2">
                    <div class="fs-14 text-muted">Subtotal</div>
                    <div>$ {{ Cart::subtotal() }}</div>
                </div>
                <div class="d-flex justify-content-between align-items-center py-2">
                    <div class="fs-14 text-muted">Envío</div>
                    <div>{{ $shipping }}</div>
                </div>

                <hr class="my-2" style="opacity: .1;">

                <div class="d-flex justify-content-between align-items-center py-2">
                    <div class="fs-16">Total</div>
                    <div class="fs-21 fw-600"><small class="fs-14">$</small> {{ number_format($total, 2, '.', ',') }}</div>
                </div>
            </div>

            <div class="pt-3">
                <p class="fs-14 m-0">¿Quieres dejar algun comentario para la entrega?</p>
                <div class="form-floating">
                    <textarea class="form-control" wire:model.defer="createArray.comments" placeholder="Comentarios"></textarea>
                    <label>Comentarios</label>
                </div>
            </div>

            @if ( $shop -> slug == 'latiendadepaula' )
                <div class="bg-light border p-2 fs-14 font-italic text-center">Esta es una tienda modelo, no se pueden realizar pedidos.</div>
            @else
                <button type="button" id="saveOrderBt" wire:click="create" wire:loading.attr="disabled" wire:target="create, createArray.shipping_type" class="btn btn-success py-2 px-5 mt-3">Confirmar órden <span class="spinner-border spinner-border-sm" wire:loading wire:target="create" role="status" aria-hidden="true"></span></button>
            @endif
            
        </div>
    </div>
</div>