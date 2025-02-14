<x-dashboard.layout>

    <x-dashboard.welcome />

    <x-dashboard.page-title>
        <x-slot:title>
            Jobs list
        </x-slot:title>
    </x-dashboard.page-title>

    @if ($jobs->count() > 0)
        <x-dashboard.jobs-list :jobs="$jobs"/>
    @endif

</x-dashboard.layout>
