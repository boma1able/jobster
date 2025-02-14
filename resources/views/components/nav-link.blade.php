@props([
'active' => false
])

@php
    $baseClasses = "rounded-md px-3 py-2 transition";
    $defaultClasses = "text-gray-300 hover:bg-gray-700";
    $activeClasses = "bg-gray-900 text-white";
@endphp

<a {{ $attributes->merge([
    'class' => $active ? "$baseClasses $activeClasses" : "$baseClasses $defaultClasses"
]) }}>
    {{ $slot }}
</a>

