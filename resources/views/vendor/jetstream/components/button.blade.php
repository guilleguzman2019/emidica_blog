<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary fs-14']) }}>
    {{ $slot }}
</button>
