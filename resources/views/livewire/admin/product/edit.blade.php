<div class="p-4">
    <div class="mb-4">
        <h1 class="fs-18 fw-600 m-0">Productos</h1>
        <span class="text-muted fs-12">Editar producto</span>
    </div>

    <div class="row">
        <div class="col-xl-3">
            <div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
                <h2 class="fs-18 mb-4">Imagen destacada</h2>
                <div class="ratio ratio-1x1 bg-img w-75 mx-auto rounded-4" style="background-image: url({{ asset(($image) ? $image -> temporaryUrl() : ($product['image'] ?? 'img/admin/default.png')) }});">
                    <div>
                        <a onclick="$('.imageUpload').click()" class="rounded-circle shadow bg-dark-4 p-2 d-block position-absolute top-0 start-100 translate-middle"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" height="16" class="float-start f-invert"></a>
                    </div>
                </div>
                <input class="imageUpload float-start" type="file" accept=".jpg,.png,.jpeg" wire:model="image" style="height: 1px; opacity: 0; overflow: hidden; width: 1px;">
                <span class="fs-12 text-muted d-block text-center mt-3">Sólo se acepta imagenes en formato *.png, *.jpg and *.jpeg. Peso máximo 4MB.</span>
                @error('image')
                    <br><span class="fs-12 text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
                <h2 class="fs-18 mb-4">Estado</h2>
                <select class="form-select bg-dark-3 rounded-3 py-2 text-white fs-14" wire:model="product.status">
                    <option value="1">Borrador</option>
                    <option value="2">Activo</option>
                </select>
                @error('product.status')
                    <span class="fs-12 text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
                <h2 class="fs-18 mb-4">Detalle</h2>

                <div class="mb-3">
                    <label class="fs-14 fw-400 mb-1">Categoría</label>
                    <select class="form-select bg-dark-3 py-2 rounded-3 text-muted fs-14" wire:model.defer="product.category_id">
                        <option value="">Elige una categoría</option>
                        @each('partials.admin.category', $categories, 'category')
                    </select>
                    @error('product.category_id')
                        <span class="fs-12 text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="fs-14 fw-400 mb-1">Marca</label>
                    <select class="form-select bg-dark-3 py-2 rounded-3 text-muted fs-14" wire:model.defer="product.brand_id">
                        <option value="">Elige una marca</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand -> id }}">{{ $brand -> name }}</option>
                        @endforeach
                    </select>
                </div>

                @php
                    $product_tags = [];
                    foreach ($product -> productTags as $pt) {
                        $product_tags[] = $pt -> tag_id;
                    }
                @endphp

                <div class="mb-3" wire:ignore>
                    <label class="fs-14 fw-400 mb-1">Etiquetas</label><br>
                    <select class="selectpicker fs-14" data-width="100%" wire:model.defer="etiquetas" data-style="border border-secondary border-opacity-25 bg-dark-3 py-2 rounded-3 text-muted fs-14" title="Elige una o más etiquetas" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag -> id }}" @if ( in_array($tag -> id, $product_tags) ) selected @endif>{{ $tag -> name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-9">
            <ul class="nav nav-tabs border-0 mb-4" id="myTab" role="tablist">
                <li class="nav-item me-4" role="presentation" wire:ignore>
                    <button class="nav-link active px-0 border-0 rounded-0" id="general-tab" data-bs-toggle="tab" data-bs-target="#general-tab-pane" type="button" role="tab" aria-controls="general-tab-pane" aria-selected="true">General</button>
                </li>
                <li class="nav-item" role="presentation" wire:ignore>
                    <button class="nav-link px-0 border-0 rounded-0" id="advanced-tab" data-bs-toggle="tab" data-bs-target="#advanced-tab-pane" type="button" role="tab" aria-controls="advanced-tab-pane" aria-selected="false">Avanzado</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="general-tab-pane" role="tabpanel" aria-labelledby="general-tab" wire:ignore.self tabindex="0">
                    <div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
                        <h2 class="fs-18 mb-4">General</h2>

                        <div class="mb-3">
                            <label class="fs-13 opacity-75">Nombre de producto<span class="text-danger fs-16">*</span></label>
                            <input class="form-control bg-transparent text-white" type="text" wire:model="product.name">
                            <span class="text-muted fs-12">{{ url('/') }}/producto/<input type="text" wire:model.defer="slug" class="border-0 bg-transparent text-muted fs-12 p-0"></span>

                            @error('product.name')
                                <br><span class="fs-12 text-danger">{{ $message }}</span>
                            @enderror
                            @error('slug')
                                <br><span class="fs-12 text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <label class="fs-13 opacity-75">Descripción<span class="text-danger fs-16">*</span></label>
                        <div wire:ignore>
                            <textarea class="form-control w-100"
                            wire:model='product.description'
                            x-data
                            x-init="ClassicEditor
                            .create( $refs.myEditor )
                            .then(function(editor){
                                editor.model.document.on('change:data', () => {
                                    @this.set('product.description', editor.getData())
                                })
                            })
                            .catch( error => {
                                console.error( error );
                            } );"
                            x-ref="myEditor"
                            ></textarea>
                        </div>

                        @error('product.description')
                            <span class="fs-12 text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
                        <h2 class="fs-18 mb-4">Precio</h2>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="fs-13 opacity-75">Precio de costo<span class="text-danger fs-16">*</span></label>
                                    <input class="form-control bg-transparent text-white" type="text" wire:model.defer="product.price_cost">

                                    @error('product.price_cost')
                                        <span class="fs-12 text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="fs-13 opacity-75">Precio regular (%)<span class="text-danger fs-16">*</span></label>
                                    <input class="form-control bg-transparent text-white" type="text" wire:model.defer="product.price_regular">

                                    @error('product.price_regular')
                                        <span class="fs-12 text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="fs-13 opacity-75">Precio de oferta (%)</label>
                                    <input class="form-control bg-transparent text-white" type="text" wire:model.defer="product.price_sale">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
                        <h2 class="fs-18 mb-4">Galería de fotos</h2>

                        <div wire:ignore>
                            <form action="{{ route('admin.products.uploadPics', $product) }}" method="POST" class="dropzone mb-4" id="my-awesome-dropzone">
                                <div class="dz-message p-0 m-0 d-flex align-items-center">
                                    <img src="{{ asset('img/admin/ico-upload.svg') }}" height="39" width="39" class="me-2">
                                    <div class="text-start lh-1">
                                        <span class="fs-14">Arrastra las imágenes aquí o haz click para elegirlas.</span><br>
                                        <span class="fs-12 text-muted">Sólo se acepta imagenes en formato *.png, *.jpg and *.jpeg.</span>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @if ( $product -> images -> count() )
                            <div class="py-4">
                                <h3 class="fs-14 fw-500">Galería de fotos</h3>

                                <div class="row">
                                    @foreach ($product -> images as $image)
                                    <div class="col-sm-2 col-6 mb-3">
                                        <div class="ratio ratio-1x1 rounded-3 bg-img" style="background-image: url({{ asset($image -> url) }});">
                                            <div wire:key="image-{{ $image -> id }}">
                                                <button class="btn btn-sm btn-danger position-absolute mt-2 end-0 me-2" onclick="confirm('¿Seguro que deseas eliminar esta foto?') || event.stopImmediatePropagation()" wire:click="deleteImage({{ $image -> id }})" wire:loading.attr="disabled" wire.target="deleteImage({{ $image -> id }})"><img src="{{ asset('img/admin/ico-delete.svg') }}" width="16" class="f-invert"></button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="tab-pane fade" id="advanced-tab-pane" role="tabpanel" aria-labelledby="advanced-tab" wire:ignore.self tabindex="0">
                    <div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
                        <h2 class="fs-18 mb-4">Características</h2>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="fs-13 opacity-75">Dimensiones</label>
                                    <input class="form-control bg-transparent text-white" type="text" wire:model.defer="product.size">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="fs-13 opacity-75">Peso</label>
                                    <input class="form-control bg-transparent text-white" type="text" wire:model.defer="product.weight">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="fs-13 mb-2 opacity-75">Destacado<span class="text-danger fs-16">*</span></label><br>
                                    <div class="form-check form-switch form-check-inline">
                                        <input class="form-check-input" type="radio" role="switch" name="featured" value="1" wire:model.defer="product.featured" id="featured1">
                                        <label class="form-check-label" for="featured1">SI</label>
                                    </div>
                                    <div class="form-check form-switch form-check-inline">
                                        <input class="form-check-input" type="radio" role="switch" name="featured" value="0" wire:model.defer="product.featured" id="featured2" checked>
                                        <label class="form-check-label" for="featured2">NO</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-dashed bg-dark-2 br-10 p-4 mb-4 position-relative">
                        <div wire:loading wire:target="product.variation, save" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
                            <div class="position-absolute top-50 start-50 translate-middle">
                                <div class="spinner-border text-light" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>

                        <h2 class="fs-18 mb-4">Inventario</h2>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="fs-13 opacity-75">SKU<span class="text-danger fs-16">*</span></label>
                                    <input class="form-control bg-transparent text-white" type="text" wire:model.defer="product.sku">

                                    @error('product.price_regular')
                                        <span class="fs-12 text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="fs-13 opacity-75">Variación<span class="text-danger fs-16">*</span></label>
                                    <select class="form-select bg-transparent text-white" wire:model="product.variation">
                                        <option value="">Elegir variación</option>
                                        <option value="1">Sin variación</option>
                                        <option value="2">Color</option>
                                        <option value="3">Tamaño/Talla</option>
                                    </select>
                                </div>
                            </div>

                            @if ( $product -> variation == 1 )
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="fs-13 opacity-75">Cantidad<span class="text-danger fs-16">*</span></label>
                                        <input class="form-control bg-transparent text-white" type="text" wire:model.defer="product.quantity">

                                        @error('product.quantity')
                                            <span class="fs-12 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ( $product -> variation == 2 )
                        <div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
                            <h2 class="fs-18 mb-4">Variaciones de color</h2>
                            @livewire('admin.product.product-color', ['product' => $product, 'key' => $product -> id])
                        </div>
                    @endif

                    @if ( $product -> variation == 3 )
                        <div class="border-dashed bg-dark-2 br-10 p-4 mb-4">
                            <h2 class="fs-18 mb-4">Variaciones de tamaño/talla</h2>
                            @livewire('admin.product.product-size', ['product' => $product, 'key' => $product -> id])
                        </div>
                    @endif
                </div>
            </div>

            <div class="text-end">
                <button class="btn btn-success text-white" wire:click="save" wire:loading.attr="disabled" wire:target="image, save">Guardar producto</button>
            </div>
        </div>
    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Actualizado correctamente</div>
                <button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <div id="liveToastAdded" class="toast bg-cian text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Variación agregada correctamente</div>
                <button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <div id="liveToastDeleted" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Variación eliminada correctamente</div>
                <button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    {{ $product -> productTags }}
</div>

@push('scripts')
    <script type="text/javascript">
        window.livewire.on('saved', () => {
            $('.modal').modal('hide')
            var toast = new bootstrap.Toast(document.getElementById('liveToast'))
            toast.show()

            Livewire.emitTo('admin.product.product-color', 'render')
            Livewire.emitTo('admin.product.product-size', 'render')
        })
        window.livewire.on('added', () => {
            var toast = new bootstrap.Toast(document.getElementById('liveToastAdded'))
            toast.show()

            Livewire.emitTo('admin.product.product-color', 'render')
            Livewire.emitTo('admin.product.product-size', 'render')
        })
        window.livewire.on('deleted', () => {
            var toast = new bootstrap.Toast(document.getElementById('liveToastDeleted'))
            toast.show()

            Livewire.emitTo('admin.product.product-color', 'render')
            Livewire.emitTo('admin.product.product-size', 'render')
        })

        Dropzone.options.myAwesomeDropzone = { // camelized version of the `id`
            headers: {
                'X-CSRF-TOKEN' : "{{ csrf_token() }}"
            },
            acceptedFiles: '.jpg,.png,.jpeg',
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 4, // MB
            complete: function (file) {
                this.removeFile(file)
            },
            queuecomplete: function () {
                Livewire.emit('refreshProduct')
            }
        };


        $(function () {
            //$('.selectpicker').selectpicker('val', [{{-- implode(',', $product -> productTags -> toArray()) --}}]);
        })
    </script>
@endpush