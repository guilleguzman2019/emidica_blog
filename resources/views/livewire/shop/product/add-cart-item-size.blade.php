<div>
    {{-- <p>Stock disponible: {{ $product -> getStockAttribute() }}</p> --}}

    <div class="d-sm-flex align-items-center mb-3">
        <p class="mb-0 fs-14 fw-500 me-sm-2">Elegir talle:</p>
        @foreach ($product -> sizes as $sz)
            <label class="border-dashed px-2 py-1 rounded-3 me-2 mb-2 mb-sm-0 {{ $size == $sz -> id ? 'active' : '' }}" style="cursor: pointer;">
                {{ $sz -> name }}
                <input type="radio" wire:model="size" value="{{ $sz -> id }}" style="float: left; height: 1px; opacity: 0; width: 1px;">
            </label>
        @endforeach
    </div>

    <div class="d-flex align-items-center">
        @if ( $size )
            <button class="btn btn-light border" wire:click="less" wire:loading.attr="disabled" wire:target="plus,size" {{ $quantity == 1 ? 'disabled' : '' }}>-</button>
            <input type="text" wire:model="quantity" readonly size="4" class="text-center border-0">
            <button class="btn btn-light border me-3" wire:click="plus" wire:loading.attr="disabled" wire:target="plus,size" {{ $quantity == $max -> quantity ? 'disabled' : '' }}>+</button>

            <button class="btn btn-success rounded-pill px-4 text-uppercase fw-600 fs-14 me-2" wire:click="addItem" wire:loading.attr="disabled" wire:target="plus,size,addItem">Agregar al carrito</button>
        @endif

        <div class="spinner-border spinner-border-sm text-primary" role="status" wire:loading>
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToastAdded" class="toast bg-cian text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Producto agregado</div>
                <button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <div id="liveToastNotStock" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-start pe-2">
                <div class="toast-body fs-12 text-start">Lo sentimos. No hay mas stock para que agregues.</div>
                <button type="button" class="btn-close f-invert mt-2" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        window.livewire.on('added', () => {
            var toast = new bootstrap.Toast(document.getElementById('liveToastAdded'))
            toast.show()
        })
        window.livewire.on('notStock', () => {
            var toast = new bootstrap.Toast(document.getElementById('liveToastNotStock'))
            toast.show()
        })
    </script>
@endpush