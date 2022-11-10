<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-danger fs-14']) }}>
    {{ $slot }}
</button>
