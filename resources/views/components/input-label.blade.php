@props(['value'])

<label {{ $attributes->merge([
    'class' => 'block text-xs uppercase tracking-widest text-gray-500 mb-1'
]) }}>
    {{ $value ?? $slot }}
</label>