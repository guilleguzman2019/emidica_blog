<div class="d-flex justify-content-center">
    <button class="btn btn-light btn-sm border" wire:click="less" wire:loading.attr="disabled">-</button>
    <input type="text" wire:model="quantity" value="{{ $quantity }}" readonly size="4" class="text-center border-0">
    <button class="btn btn-light btn-sm border me-3" wire:click="plus" wire:loading.attr="disabled">+</button>


    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
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
        window.livewire.on('notStock', () => {
            var toast = new bootstrap.Toast(document.getElementById('liveToastNotStock'))
            toast.show()
        })
    </script>
@endpush