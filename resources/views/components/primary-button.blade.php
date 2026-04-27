<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center px-4 py-2 border-2 border-gray-950 bg-gray-950 text-white text-sm font-semibold hover:bg-white hover:text-gray-950 transition'
]) }}>
    {{ $slot }}
</button>