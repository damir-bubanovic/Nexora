<a {{ $attributes->merge([
    'class' => 'block w-full px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-100 hover:text-gray-950 transition'
]) }}>
    {{ $slot }}
</a>