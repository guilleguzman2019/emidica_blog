<x-app-layout>
	<div class="p-4">
		<div class="mb-4">
			<h1 class="fs-18 fw-600 m-0">Banners</h1>
			<span class="text-muted fs-12">Crea, edita y elimina banners</span>
		</div>

		@livewire('panel.banner.own', key( rand() ) )

		@livewire('panel.banner.emidica', key( rand() ) )
	</div>


    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToastSave" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Guardado correctamente</div>
                <button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

	@push('scripts')
		<script type="text/javascript">
			window.livewire.on('saved', () => {
				var toast = new bootstrap.Toast(document.getElementById('liveToastSave'))
				toast.show()
			})
		</script>
	@endpush
</x-app-layout>