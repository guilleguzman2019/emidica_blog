<div>
    <button class="text-center lh-1 text-uppercase mt-2 pt-1 bg-transparent border-0 w-100" wire:click="addItem">
        <span class="text-dark" wire:loading.remove>agregar al carrito</span>
        <div wire:loading class="spinner-border spinner-border-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </button>

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