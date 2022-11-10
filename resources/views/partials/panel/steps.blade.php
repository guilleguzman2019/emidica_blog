<div class="p-sm-5 p-3 mb-2 text-center text-sm-start">
    <img src="{{ asset('img/logo.svg') }}" width="130" class="f-brightness">
</div>
<div class="p-sm-5 p-3 text-white text-center text-sm-start">
    <div class="row">
        <div class="col-sm-12 col-4">
            <div class="mb-sm-5 d-sm-flex align-items-center">
                <span class="fs-18 d-inline-block px-3 mb-3 mb-sm-0 py-2 rounded-3 {{ ($step == 1) ? 'bg-cian' : 'badge-light-primary' }} me-sm-3">1</span>
                <div>
                    <h2 class="fs-21 fs-sm-16 fw-400 lh-1 m-sm-0 mb-1 text-muted">Suscripción</h2>
                    <span class="fs-14 fs-sm-11 fw-300 d-block">Elegir plan</span>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-4">
            <div class="mb-sm-5 d-sm-flex align-items-center">
                <span class="fs-18 d-inline-block px-3 mb-3 mb-sm-0 py-2 rounded-3 {{ ($step == 2) ? 'bg-cian' : 'badge-light-primary' }} me-sm-3">2</span>
                <div>
                    <h2 class="fs-21 fs-sm-16 fw-400 lh-1 m-sm-0 mb-1 text-muted">Tienda</h2>
                    <span class="fs-14 fs-sm-11 fw-300 d-block">Completa información</span>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-4">
            <div class="d-sm-flex align-items-center">
                <span class="fs-18 d-inline-block px-3 mb-3 mb-sm-0 py-2 rounded-3 {{ ($step == 3) ? 'bg-cian' : 'badge-light-primary' }} me-sm-3">3</span>
                <div>
                    <h2 class="fs-21 fs-sm-16 fw-400 lh-1 m-sm-0 mb-1 text-muted">Compartir</h2>
                    <span class="fs-14 fs-sm-11 fw-300 d-block">Comparte tu tienda</span>
                </div>
            </div>
        </div>
    </div>
</div>