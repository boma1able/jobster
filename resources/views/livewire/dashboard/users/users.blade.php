<div>

    <x-dashboard.welcome />

    <x-dashboard.page-title>
        <x-slot:title>
            Users
        </x-slot:title>
        <x-slot:subtitle>
            A list of all the users in your account including their name, email and role.
        </x-slot:subtitle>
    </x-dashboard.page-title>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-10">
        <a href="{{ route('dashboard.users.create') }}" wire:navigate  class="inline-block rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs">Add new</a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <p class="flex justify-center">Posts</p>
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <p class="flex justify-center">Jobs</p>
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><p class="flex justify-center">Status</p></th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

            @foreach($users as $user)
                <tr class="align-middle">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <a href="{{ route('dashboard.profile.show', $user->id) }}"
                           class="flex items-center hover:text-black transition-colors duration-300">
                            <span class="w-10 h-10 overflow-hidden rounded-full mr-3 border border-gray-200 hover:border-gray-300 transition-all duration-500">
                                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('/storage/default-avatar.jpg') }}" alt="User Avatar"
                                     class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            </span>
                                            <span class="self-center text-gray-700 hover:text-black transition-colors duration-300">
                                {{ $user->name }}
                            </span>
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <p class="flex justify-center">
                            {{ $user->post->count() }}
                        </p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <p class="flex justify-center">
                            {{ $user->jobs->count() }}
                        </p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->roles->first()->name ?? 'No Role' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <p class="flex justify-center">
                            @if($user->last_active_at >= now()->subMinutes(1))
                                <span class="w-3 h-3 bg-green-500 rounded-full inline-block animate-pulse"></span>
                            @else
                                <span class="w-3 h-3 rounded-full inline-block border border-gray-400"></span>
                            @endif
                        </p>
                    </td>
                    @if (auth()->id() === $user->id || auth()->user()?->isAdmin())
                        <td class="px-6 py-4 text-sm font-medium">
                            <div class="flex">
                                <a href="{{ route('dashboard.users.edit', $user->id) }}" wire:navigate class="text-blue-600 hover:text-blue-900 ml-4">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V20C2 20.5304 2.21071 21.0391 2.58579 21.4142C2.96086 21.7893 3.46957 22 4 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V13M18.4142 2.58579C18.7893 2.21071 19.2979 2 19.8284 2C20.3589 2 20.8676 2.21071 21.2426 2.58579C21.6177 2.96086 21.8284 3.46957 21.8284 4C21.8284 4.53043 21.6177 5.03914 21.2426 5.41421L12 14.6569L8 15.6569L9 11.6569L18.4142 2.58579Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <a href="#" wire:click.prevent="confirmDelete({{ $user->id }})"  class="text-red-600 hover:text-red-900 ml-4">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 6H21M19 6V20C19 21.1046 18.1046 22 17 22H7C5.89543 22 5 21.1046 5 20V6M8 6V4C8 2.89543 8.89543 2 10 2H14C15.1046 2 16 2.89543 16 4V6M10 11V17M14 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    @endif
                </tr>

            @endforeach

            </tbody>
        </table>
    </div>
    @if ($showDeleteConfirmation)
        <x-dashboard.modal.delete :title="$title" :sub="$sub" :userToDelete="$userToDelete" :current="$userToDelete"/>
    @endif
</div>

