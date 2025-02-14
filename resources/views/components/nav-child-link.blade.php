@props([
'active' => false
])

@php
    $baseClasses = "flex items-center mx-0 !my-0 px-6 py-2 font-medium text-xs transition";
    $defaultClasses = "text-gray-400 hover:bg-gray-700 hover:text-white";
    $activeClasses = "text-white";

    $classes = "$baseClasses " . ($active ? $activeClasses : $defaultClasses);
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
