<x-dashboard.layout>

    <x-dashboard.welcome />

    @if (auth()->user()?->isAdmin())
        <x-ui-button-link href="/dashboard/users/create">Add user</x-ui-button-link>
    @endif

    <x-dashboard.page-title>
        <x-slot:title>
            Users
        </x-slot:title>
        <x-slot:subtitle>
            A list of all the users in your account including their name, email and role.
        </x-slot:subtitle>
    </x-dashboard.page-title>

    <x-dashboard.users-list :users="$users"/>

</x-dashboard.layout>
