@props(['active'])

@php
$classes = ($active ?? false)
    ? 'block w-full px-4 py-2 border-l-4 border-gray-950 bg-gray-950 text-white text-base font-semibold'
    : 'block w-full px-4 py-2 border-l-4 border-transparent text-base font-semibold text-gray-600 hover:border-gray-950 hover:text-gray-950 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>