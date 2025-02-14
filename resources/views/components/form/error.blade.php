@props(['name'])

@if ($errors->has($name))
    <p class="text-red-500 text-xs">{{ $errors->first($name) }}</p>
@endif
