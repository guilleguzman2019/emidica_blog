@php
    $cantParents = $category -> getAscendantsAttribute() -> count();
    $nbsp = '';
@endphp
<option value="{{ $category -> id }}" class="ss-{{ $cantParents }}">
    @php
        for ($i = 1; $i < $cantParents; $i++) {
            $nbsp .= '&nbsp;&nbsp;&nbsp;';
        }
        if ( $cantParents > 0 ) {
            $nbsp .= '→ ';
        }
    @endphp
    {!! $nbsp . $category -> name !!}
</option>
@if ( $category -> descendants -> count() > 0 )
    @foreach ($category -> descendants -> sortBy('name') as $category)
        @include('partials.admin.category', $category)
    @endforeach
@endif