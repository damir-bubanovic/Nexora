@props(['status'])

@if ($status)
    <div {{ $attributes->merge([
        'class' => 'border border-green-300 bg-green-50 text-green-800 px-4 py-2 text-sm font-semibold'
    ]) }}>
        {{ $status }}
    </div>
@endif