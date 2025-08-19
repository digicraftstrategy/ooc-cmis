@props(['route', 'active' => null, 'indent' => 3])

@php
    $isActive = $active ?? request()->routeIs($route);
    $indentClass = $indent ? 'ml-' . $indent * 2 : '';

    $classes = $isActive
        ? "block px-3 py-2 {$indentClass} font-bold text-blue-700 bg-blue-50 rounded-md hover:bg-blue-50 hover:text-blue-700 transition duration-150"
        : "block px-3 py-2 {$indentClass} text-gray-600 rounded-md hover:bg-blue-50 hover:text-blue-700 transition duration-150";
@endphp

<a href="{{ route($route) }}" wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
