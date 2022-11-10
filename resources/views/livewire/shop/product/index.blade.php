<div>
    <div class="d-flex justify-content-between mb-4">
        <div></div>
        
        <div class="d-flex text-nowrap align-items-center fs-14">
            Ordenar por: 
            <select class="form-select fs-14 ms-2" name="order" wire:model="order">
                <option value="name,asc">Nombre <small>(A-Z)</small></option>
                <option value="name,desc">Nombre <small>(Z-A)</small></option>
                <option value="price_ars,asc">Precio <small>(menor a mayor)</small></option>
                <option value="price_ars,desc">Precio <small>(mayor a menor)</small></option>
            </select>
        </div>
    </div>

    <div class="position-relative">
        <div wire:loading wire:target="order" class="position-absolute w-100 h-100 top-0 start-0 bg-light" style="--bs-bg-opacity: 0.9; z-index: 2;">
            <div class="position-absolute mt-5 pt-5 start-50 translate-middle">
                <div class="spinner-border text-dark" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse ($products as $product)
                <x-shop.product-box :product="$product" :shop="$shop" :dolar="$settings -> dolar"/>
            @empty
                <div class="col-sm-12">
                    <div class="alert alert-info text-center">No se encontraron productos</div>
                </div>
            @endforelse
        </div>
    </div>

    @if ( $products -> hasMorePages() )
        <button class="btn btn-primary d-block mx-auto" wire:click="morePages" wire:loading.attr="disabled" wire:target="morePages">Cargar más productos <div wire:loading wire:target="morePages" class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div></button>
    @endif
</div>