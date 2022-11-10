<div class="p-4">
    <div class="mb-4">
        <h1 class="fs-18 fw-600 m-0">Tiendas</h1>
        <span class="text-muted fs-12">Listado de tiendas eliminadas</span>
    </div>

    <div class="bg-dark-2 border-dashed p-4 br-10">
        <div class="d-flex justify-content-between mb-4">
            <div class="border-0 bg-dark-3 rounded-3 p-2">
                <img src="{{ asset('img/admin/ico-search.svg') }}" width="24" class="f-invert opacity-25">
                <input class="bg-transparent border-0 text-white" type="text" wire:model="search" placeholder="Buscar">
            </div>
        </div>

        @if ( $shops -> count() )

            @php
                $plan = [NULL => 'Sin asignar', 1 => 'Basic', 2 => 'Premium'];
                $plan_color = [NULL => 'secondary', 1 => 'info', 2 => 'success'];
            @endphp

            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead class="fs-12 text-muted opacity-50 text-uppercase">
                        <th class="fw-600 ps-0">Tienda</th>
                        <th class="fw-600">Suscriptor</th>
                        <th class="fw-600 text-center">Plan</th>
                        <th class="fw-600">Fecha de creación</th>
                        <th class="fw-600">Fecha de eliminación</th>
                        <th></th>
                    </thead>
                    <tbody class="text-white fs-14">
                        @foreach ($shops as $shop)
                            <tr class="border-bottom-dashed align-middle">
                                <td class="ps-0">
                                    <div class="d-flex align-items-center py-2">
                                        <div class="ratio ratio-1x1 bg-img-contain me-3 rounded-3" style="background-image: url({{ asset(($shop -> shop -> logo_foot ?? $shop -> shop -> logo) ?? 'img/admin/default.png') }}); width: 50px;"></div>
                                        {{ $shop -> shop -> shop_name }}
                                    </div>
                                </td>
                                <td>{{ ucwords(strtolower($shop -> name)) }}</td>
                                <td class="text-center">
                                    <span class="badge fw-500 badge-light-{{ $plan_color[$shop -> suscriber -> plan] }}">{{ $plan[$shop -> suscriber -> plan] }}</span>
                                </td>
                                <td class="text-white-50">{{ $shop -> created_at -> format('d/m/Y') }}</td>
                                <td class="text-white-50">{{ $shop -> deleted_at -> format('d/m/Y') }}</td>
                                <td class="pe-0 text-end text-nowrap">
                                    @if ( Auth::user() -> user_type != 8 )
                                        <a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" onclick="confirm('¿Seguro que deseas eliminar esta tienda?') || event.stopImmediatePropagation()" wire:click="delete('{{ $shop -> user_id }}')" wire:loading.attr="disabled" wire:target="delete('{{ $shop -> user_id }}')"><img class="f-invert" src="{{ asset('img/admin/ico-delete.svg') }}" width="16"></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between">
                <select class="bg-dark-3 text-white border-0 rounded-3 px-2" wire:model="paginate">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>

                @if ( $shops -> hasPages() )
                    <div class="pagination">
                        {{ $shops -> withQueryString() -> onEachSide(1) -> links() }}
                    </div>
                @endif
            </div>
        

        @else

            <p class="text-center py-5">No tienes tiendas aquí.</p>

        @endif

    </div>
</div>
