<div>
    {{-- <p>Stock disponible: {{ $product -> getStockAttribute() }}</p> --}}
    
    <div class="d-flex">
        <button class="btn btn-light border" wire:click="less" wire:loading.attr="disabled" {{ $quantity == 1 ? 'disabled' : '' }}>-</button>
        <input type="text" wire:model="quantity" readonly size="4" class="text-center border-0">
        <button class="btn btn-light border me-3" wire:click="plus" wire:loading.attr="disabled" {{ $quantity == $product -> quantity ? 'disabled' : '' }}>+</button>

        <button class="btn btn-success rounded-pill px-4 text-uppercase fw-600 fs-14" wire:click="addItem" wire:loading.attr="disabled">Agregar al carrito</button>
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