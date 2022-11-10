<div class="row justify-content-center">
	<div class="col-sm-10">
		<div class="bg-dark-2 border-dashed p-4 br-10 mb-4 position-relative">

			<div wire:loading wire:target="saveDomain" class="position-absolute w-100 h-100 top-0 start-0 bg-dark br-10" style="--bs-bg-opacity: 0.9; z-index: 2;">
				<div class="position-absolute top-50 start-50 translate-middle">
					<div class="spinner-border text-light" role="status">
						<span class="visually-hidden">Loading...</span>
					</div>
				</div>
			</div>

			<h3 class="fs-18 fw-600">Plan Premium</h3>

			@if ( ! $domain_status )
				<p class="fs-14">Como parte de los beneficios que tienes en el plan premium, puedes tener tu propio dominio. Realiza la búsqueda del dominio que quieres para tu tienda para verificar que esté disponible.</p>

				<div class="row">
					<div class="col-sm-6">
						<div class="input-group mb-3">
							<input class="form-control text-lowercase fs-14" type="text" name="domain" id="domainSearch" wire:model.defer="domain_name" placeholder="Elige tu dominio" oninput="formatDomain( $(this).val() )">
							<select class="form-select fs-14" id="domainExtension" wire:model.defer="extension">
								<option value="">Extensión</option>
								<option value=".com">.com</option>
								<option value=".net">.net</option>
								<option value=".shop">.shop</option>
								<option value=".store">.store</option>
								<option value=".beauty">.beauty</option>
								<option value=".site">.site</option>
							</select>
							<button class="btn btn-secondary fs-14" type="button" id="button-addon2" onclick="searchDomain()">Buscar</button>
						</div>
					</div>
				</div>

				<p class="fs-14 text-danger">IMPORTANTE: Recuerda que sólo puedes utilizar esta opción una sola vez, por lo cual asegurate de que el nombre que elijas es el que quieres para tu tienda.</p>
				<p class="fs-12">Al mismo tiempo, existen dominios que pueden estar disponibles, pero eso no significa que se vaya a otorgar inmediatamente. El dominio que elijas pasará un proceso de verificación antes de que puedas utilizarlo. En caso que se rechace la solicitud, se te informará.</p>

				@error('domain_result_status')
					<p class="text-danger fs-12">{{ $message }}</p>
				@enderror

				<input type="hidden" id="domain_result_status" wire:model.defer="domain_result_status">
				<button class="btn btn-primary btn-sm fs-12 px-3" wire:click="saveDomain" wire:loading.attr="disabled" wire:target="saveDomain">Solicitar dominio</button>
			@elseif ( $domain_status == 2 )
				<div class="alert alert-warning text-center mb-0">Tu dominio está en proceso de validación. Pronto tendrás novedades.</div>
			@endif

		</div>
	</div>

    {{-- TOASTs --}}
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToastUpdated" class="toast bg-primary text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center pe-2">
                <div class="toast-body">Solicitud enviada correctamente</div>
                <button type="button" class="btn-close f-invert" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
	<script type="text/javascript">
        window.livewire.on('updated', () => {
            var toast = new bootstrap.Toast(document.getElementById('liveToastUpdated'))
            toast.show()
        })

		function formatDomain(value) {
			var out = '';
			//Se añaden las letras validas
			var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890-';//Caracteres validos

			for (var i=0; i<value.length; i++)
				if (filtro.indexOf(value.charAt(i)) != -1) 
					out += value.charAt(i);

			return $('#domainSearch').val(out);
		}

		function searchDomain() {
			$('.response').remove();
			$('.input-group button').attr('disabled', 'disabled');

			if ( $('#domainSearch').val() == '' ) {
				$('.input-group button').removeAttr('disabled');
				alert('Debes escribir un nombre de dominio.')
				return false;
			}


			const settings = {
				"async": true,
				"crossDomain": true,
				"url": "https://domainr.p.rapidapi.com/v2/status?mashape-key=046c1c5bfbmshafd510625ed7e94p138b26jsn37302e9ed6f8&domain=" + $('#domainSearch').val() + $('#domainExtension option:selected').val(),
				"method": "GET",
				"headers": {
					"X-RapidAPI-Key": "c08ebcd30fmshb9f124a9700ddb4p1d895fjsnaac8bbd23e88",
					"X-RapidAPI-Host": "domainr.p.rapidapi.com"
				}
			};

			$.ajax(settings).done(function (response) {
				console.log(response)
				$('.input-group button').removeAttr('disabled');

				var status = response['status'][0]

				if ( status.status == 'undelegated inactive' || status.status == 'undelegated' ) {
					$('.input-group').after('<div class="response bg-success p-2 fs-12 mb-3 rounded-3 text-white text-center">El dominio está disponible.</div>')
					$('#domain_result_status').val(1)
					document.getElementById("domain_result_status").dispatchEvent(new Event('input'));
				} else {
					$('.input-group').after('<div class="response bg-danger p-2 fs-12 mb-3 rounded-3 text-white text-center">Lo sentimos, el dominio no está disponible.</div>')
					$('#domain_result_status').val(0)
					document.getElementById("domain_result_status").dispatchEvent(new Event('input'));
				}
			});
		}
	</script>
@endpush