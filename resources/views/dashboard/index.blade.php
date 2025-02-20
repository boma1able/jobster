<x-dashboard.layout>

    <x-dashboard.welcome :users="$users"/>

    <x-dashboard.page-title>
        <x-slot:title>
            Dashboard
        </x-slot:title>
    </x-dashboard.page-title>

    @yield('content')

</x-dashboard.layout>
