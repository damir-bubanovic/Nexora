<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'inline-flex items-center px-4 py-2 border-2 border-gray-950 bg-white text-gray-950 text-sm font-semibold hover:bg-gray-950 hover:text-white transition disabled:opacity-25'
]) }}>
    {{ $slot }}
</button>