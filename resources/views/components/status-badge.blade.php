@props(['status'])

@php
    $classes = match ($status) {
        'pending' => 'border-yellow-500 text-yellow-700',
        'active' => 'border-green-600 text-green-700',
        'completed' => 'border-blue-600 text-blue-700',
        default => 'border-gray-400 text-gray-700',
    };
@endphp

<span {{ $attributes->merge([
    'class' => "inline-flex items-center px-3 py-1 text-xs font-semibold border-2 $classes"
]) }}>
    {{ ucfirst(str_replace('_', ' ', $status)) }}
</span>