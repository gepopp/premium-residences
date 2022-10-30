@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-logo']) }}>
    {{ $value ?? $slot }}
</label>
