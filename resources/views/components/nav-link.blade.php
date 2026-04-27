@props(['active'])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center px-3 py-2 border-2 border-gray-950 bg-gray-950 text-white text-sm font-semibold transition'
    : 'inline-flex items-center px-3 py-2 border-2 border-transparent text-sm font-semibold text-gray-600 hover:border-gray-950 hover:text-gray-950 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>