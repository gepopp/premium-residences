@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-logo focus:ring focus:ring-logo focus:ring-opacity-50 shadow-sm']) !!}>
