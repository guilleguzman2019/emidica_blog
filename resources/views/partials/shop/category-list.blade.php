@php
    $cantParents = $category -> getAscendantsAttribute() -> count();
    $nbsp = '';
@endphp

@php
    for ($i = 1; $i < $cantParents; $i++) {
        $nbsp .= '&nbsp;&nbsp;&nbsp;';
    }
    if ( $cantParents > 0 ) {
        $nbsp .= '→ ';
    }
@endphp


<li class="ss-{{ $cantParents }} @if ( in_array($category -> id, $parents) ) open @endif mb-2">
    <a class="@if ( $selectedCategory -> slug == $category -> slug ) fw-700 @endif text-dark" href="{{ route('shop.products.index', [$shop, $category]) }}"> {!! $nbsp . $category -> name !!}</a>{{-- $category -> getTotalProduct() --}} 

    @if ( $category -> descendants -> count() > 0 )
        <ul class="list-unstyled my-1">
            @foreach ($category -> descendants -> sortBy('name') as $category)
                @include('partials.shop.category-list', $category)
            @endforeach
        </ul>
    @endif
</li>