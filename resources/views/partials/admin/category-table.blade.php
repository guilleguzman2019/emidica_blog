@php
    $cantParents = $category -> getAscendantsAttribute() -> count();
    $nbsp = '';
@endphp

<tr class="border-bottom-dashed align-middle {{ ( $category -> getAscendantsAttribute() -> count() > 0 ) ? 'd-none' : '' }} {{ $category -> parent ? 'parent-' . $category -> parent -> id : '' }}" data-cat-id="{{ $category -> id }}" wire:ignore.self>
    <td class="ps-0">
        @php
            for ($i = 1; $i < $cantParents; $i++) {
                $nbsp .= '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;';
            }
            if ( $cantParents > 0 ) {
                $nbsp .= '→ ';
            }
        @endphp
        <div class="d-flex justify-content-start align-items-center">
            <span class="">{!! $nbsp !!}</span>
            <div class="ratio ratio-1x1 me-3 rounded-3 bg-img" style="background-image: url({{ asset($category -> megamenu ?? $category -> image) }}); width: 50px"></div>
            {{ $category -> name }}
        </div>
    </td>
    <td>{{ $category -> slug }}</td>
    <td><img src="{{ asset($category -> featured ? 'img/admin/ico-star-filled.svg' : 'img/admin/ico-star-empty.svg') }}" width="16"></td>
    <td class="text-end pe-0">
        <a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4" wire:click="edit('{{ $category -> slug }}')" data-bs-toggle="modal" data-bs-target="#editModal"><img src="{{ asset('img/admin/ico-edit.svg') }}" width="16" class="f-invert"></a>
        <a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4 ms-1" onclick="confirm('¿Seguro que deseas eliminar esta categoría?') || event.stopImmediatePropagation()" wire:click="destroy('{{ $category -> slug }}')"><img src="{{ asset('img/admin/ico-delete.svg') }}" width="16" class="f-invert"></a>
        @if ( $category -> descendants -> count() > 0 )
            <a class="d-inline-block px-2 py-1 rounded-2 bg-dark-4 ms-1" @if ( $category -> descendants ) onclick="$('.parent-{{ $category -> id }}').toggleClass('d-none'); $(this).find('.toggle').toggleClass('invert')" @endif><img src="{{ asset('img/admin/ico-down.svg') }}" width="16" class="f-invert toggle"></a>
        @endif
    </td>
</tr>

@if ( $category -> descendants -> count() > 0 )
    @foreach ($category -> descendants -> sortBy('name')  as $category)
        @include('partials.admin.category-table', $category)
    @endforeach
@endif