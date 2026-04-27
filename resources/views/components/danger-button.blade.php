<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'bg-red-600 text-white px-4 py-2 text-sm font-bold hover:bg-red-700 transition'
]) }}>
    {{ $slot }}
</button>