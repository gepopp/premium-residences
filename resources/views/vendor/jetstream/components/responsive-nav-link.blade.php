@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-3 pr-4 py-2 border-l-4 border-logo text-base font-medium text-logo focus:outline-none focus:text-logo focus:bg-logo focus:border-logo transition'
            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-logo hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
