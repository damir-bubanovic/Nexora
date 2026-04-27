@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge([
    'class' => 'w-full border-2 border-gray-950 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-0 focus:border-gray-700 disabled:opacity-50'
]) }}>