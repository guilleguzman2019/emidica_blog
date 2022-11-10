@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="modal-content bg-dark-2">
        <div class="modal-header border-bottom-dashed">
            <h5 class="modal-title">{{ $title }}</h5>
            <button type="button" class="btn-close f-invert" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body border-bottom-dashed">
            {{ $content }}
        </div>
        <div class="modal-footer border-top-0">
            {{ $footer }}
        </div>
    </div>
</x-jet-modal>