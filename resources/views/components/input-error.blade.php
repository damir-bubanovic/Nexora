@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge([
        'class' => 'border border-red-300 bg-red-50 text-red-700 px-3 py-2 text-sm space-y-1'
    ]) }}>
        @foreach ((array) $messages as $message)
            <div>{{ $message }}</div>
        @endforeach
    </div>
@endif