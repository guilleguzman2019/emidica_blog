<div class="p-4">
    <div class="mb-4">
        <h1 class="fs-18 fw-600 m-0">Productos</h1>
        <span class="text-muted fs-12">Papelera</span>
    </div>

    <div class="bg-dark-2 border-dashed p-4 br-10">
        <div class="d-flex justify-content-between mb-4">
            <div class="border-0 bg-dark-3 rounded-3 p-2">
                <img src="{{ asset('img/admin/ico-search.svg') }}" width="24" class="f-invert opacity-25">
                <input class="bg-transparent border-0 text-white" type="text" wire:model="search" placeholder="Buscar">
            </div>

            <div class="d-flex align-items-center">
                <select class="form-select bg-dark-3 fs-14 text-white border-0 rounded-3 ms-2" wire:model="category_id">
                    <option value="">Categoria</option>
                    @each('partials.admin.category', $categories, 'category')
                </select>
            </div>
        </div>

        @if ( $products -> count() )

            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead class="fs-12 text-muted opacity-50 text-uppercase">
                        <th class="fw-600 ps-0">Producto</th>
                        <th class="fw-600">SKU</th>
                        <th class="fw-600 text-center">Cantidad</th>
                        <th class="fw-600 text-end">Costo</th>
                        <th class="fw-600 text-end">Precio</th>
                        <th class="fw-600 text-center">Ventas</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody class="text-white fs-14">
                        @foreach ($products as $product)
                            <tr class="border-bottom-dashed align-middle">
                                <td class="ps-0">
                                    <div class="d-flex align-items-center py-2">
                                        <div class="ratio ratio-1x1 bg-img me-3 rounded-3" style="background-image: url({{ asset($product -> image ?? 'img/admin/default.png') }}); width: 50px;"></div>
                                        <div class="lh-sm">
                                            {{ $product -> name }}<br>
                                            <span class="fs-12 text-muted">{{ $product -> slug }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="opacity-50">{{ $product -> sku }}</td>
                                <td class="opacity-50 text-center">{{ $product -> getStockAttribute() }}</td>
                                <td class="text-end">u$d {{ number_format($product -> price_cost, 2, '.', ',') }}</td>
                                <td class="text-end">
                                    @php $price_regular = (($product -> price_cost * $settings -> dolar) * $product -> price_regular/100) + ($product -> price_cost * $settings -> dolar); @endphp
                                    AR$ {{ number_format($price_regular, 2, '.', ',') }}</td>
                                <td class="text-center">{{ $product -> sales }}</td>
                                <td class="text-center">
                                    <img src="{{ asset($product -> featured ? 'img/admin/ico-star-filled.svg' : 'img/admin/ico-star-empty.svg') }}" width="16">
                                </td>
                                <td class="pe-0 text-end text-nowrap">
                                    <a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" onclick="confirm('¿Seguro que deseas restaurar este producto?') || event.stopImmediatePropagation()" wire:click="bringBack('{{ $product -> slug }}')" wire:loading.attr="disabled" wire:target="delete('{{ $product -> slug }}')"><img class="f-invert" src="{{ asset('img/admin/ico-restore.svg') }}" width="16"></a>
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

                @if ( $products -> hasPages() )
                    <div class="pagination">
                        {{ $products -> withQueryString() -> onEachSide(1) -> links() }}
                    </div>
                @endif
            </div>

        @else

            <p class="text-center py-5">No tienes productos aquí.</p>

        @endif

    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToastRestored" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Producto restaurado correctamente</div>
                <button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        window.livewire.on('restored', () => {
            var toast = new bootstrap.Toast(document.getElementById('liveToastRestored'))
            toast.show()
        })
    </script>
@endpush