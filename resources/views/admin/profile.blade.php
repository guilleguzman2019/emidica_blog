<x-app-layout>
	<div class="p-4">
		<div class="mb-4">
			<h1 class="fs-18 fw-600 m-0">Perfil</h1>
			<span class="text-muted fs-12">Actualiza tu información personal</span>
		</div>

		<div class="row">
			<div class="col-md-3 d-none d-sm-block">
				<div id="navAside" class="bg-dark-2 p-4 border-dashed rounded-4 mb-4 sticky-top">
					<ul class="fs-14 text-white-50 m-0 m-2 list-unstyled ">
						<li class="mb-2">
							<a href="#profile" class="text-white d-block px-3 py-2 rounded-3">Información de perfil</a>
						</li>
						<li class="mb-2">
							<a href="#password" class="text-white d-block px-3 py-2 rounded-3">Actualizar contraseña</a>
						</li>
						<li class="mb-2">
							<a href="#two-factor" class="text-white d-block px-3 py-2 rounded-3">Autenticación de dos factores</a>
						</li>
						<li class="mb-2">
							<a href="#logout" class="text-white d-block px-3 py-2 rounded-3">Sesiones de navegador</a>
						</li>
						<li class="mb-2">
							<a href="#delete" class="text-white d-block px-3 py-2 rounded-3">Borrar cuenta</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="col-md-9" data-bs-spy="scroll" data-bs-target="#navAside" data-bs-root-margin="0px 0px">
				<div id="profile">
					@if (Laravel\Fortify\Features::canUpdateProfileInformation())
						@livewire('admin.profile.profile')
					@endif
				</div>

				<div id="password">
					@if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
						@livewire('admin.profile.password')
					@endif
				</div>

				<div id="two-factor">
					@if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
						@livewire('profile.two-factor-authentication-form')
					@endif
				</div>

				<div id="logout">
					@livewire('profile.logout-other-browser-sessions-form')
				</div>

				<div id="delete">
					@if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
						@livewire('profile.delete-user-form')
					@endif
				</div>
			</div>
		</div>
	</div>


    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToastUpdated" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Actualizado correctamente</div>
                <button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

	@push('scripts')
		<script type="text/javascript">
			window.livewire.on('updated', () => {
				var toast = new bootstrap.Toast(document.getElementById('liveToastUpdated'))
				toast.show()
			})
		</script>
	@endpush
</x-app-layout>