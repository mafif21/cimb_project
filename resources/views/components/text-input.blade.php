@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 focus:border-cimb-maroon  focus:ring-cimb-maroon  rounded-md shadow-sm',
]) !!}>
