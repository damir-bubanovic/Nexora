@props(['status'])

@php
    $classes = match ($status) {
        'pending' => 'bg-yellow-100 text-yellow-800',
        'active' => 'bg-green-100 text-green-800',
        'completed' => 'bg-blue-100 text-blue-800',
        default => 'bg-gray-100 text-gray-800',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex px-2 py-1 text-xs font-semibold rounded-full $classes"]) }}>
    {{ ucfirst($status) }}
</span>