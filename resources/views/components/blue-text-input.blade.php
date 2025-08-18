@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'block w-full pl-10 border-gray-300 rounded-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm',
]) !!}>
