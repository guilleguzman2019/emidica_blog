<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-secondary fs-14']) }}>
    {{ $slot }}
</button>
