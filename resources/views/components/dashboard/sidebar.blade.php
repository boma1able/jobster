@props(['pending'])

<div class="fixed inset-y-0 left-0 w-64 bg-gray-800 text-white">
    <div class="flex items-center justify-center h-16 bg-gray-900">
        <div class="shrink-0">
            <a href="/"><img class="size-8" src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Logo"></a>
        </div>
    </div>

    <nav class="flex flex-col mt-6 [min-height:calc(100vh-110px)]">
        <x-nav-link-dash href="/dashboard" icon="1" wire:navigate active="{{ request()->is('dashboard') ? 'active' : '' }}">
            Dashboard
        </x-nav-link-dash>

        <x-nav-link-dash href="/dashboard/media" icon="6" wire:navigate active="{{ request()->is('dashboard/media') ? 'active' : '' }}">
            Media
        </x-nav-link-dash>

        <x-nav-link-dash href="/dashboard/jobs" icon="2" wire:navigate active="{{ request()->is('dashboard/jobs') ? 'active' : '' }}">
            Jobs
        </x-nav-link-dash>

        <div class="relative">
            @php
                $isPostsActive = request()->is(
                    'dashboard/posts*',
                    'dashboard/categories',
                    'dashboard/categories/*/edit',
                    'dashboard/categories/create',
                    'dashboard/tags',
                    'dashboard/tags/*/edit',
                    'dashboard/tags/create'
                    );
            @endphp

            <x-nav-link-dash href="/dashboard/posts" icon="3" wire:navigate active="{{ $isPostsActive ? 'active' : '' }}">
                Posts
            </x-nav-link-dash>

            @if($isPostsActive)
                <div class="left-0 space-y-2 w-full bg-gray-700 pl-[36px]">
                    <x-nav-child-link href="/dashboard/posts/" wire:navigate active="{{ request()->is('dashboard/posts') ? 'active' : '' }}">All Posts</x-nav-child-link>
                    <x-nav-child-link href="/dashboard/posts" wire:navigate wire:current="/dashboard/posts?view=create" active="{{ request()->is('dashboard/posts?view=create') ? 'active' : '' }}">Add new</x-nav-child-link>
                    <x-nav-child-link href="/dashboard/categories" wire:navigate active="{{ request()->is('dashboard/categories', 'dashboard/categories/*/edit', 'dashboard/categories/create') ? 'active' : '' }}">Categories</x-nav-child-link>
                    <x-nav-child-link href="/dashboard/tags" wire:navigate active="{{ request()->is('dashboard/tags', 'dashboard/tags/*/edit', 'dashboard/tags/create') ? 'active' : '' }}">Tags</x-nav-child-link>
                </div>
            @endif
        </div>

        <x-nav-link-dash href="/dashboard/comments" icon="5" wire:navigate active="{{ request()->is('dashboard/comments', 'dashboard/comments/*/edit') ? 'active' : '' }}">
            Comments
            <livewire:dashboard.comments.new-comments-counter />
        </x-nav-link-dash>

        <div class="relative">
            @php
                $isActive = request()->is(
                    'dashboard/users*',
                    'dashboard/user/*'
                    );
            @endphp

            <x-nav-link-dash href="/dashboard/users" icon="4" wire:navigate active="{{ $isActive ? 'active' : '' }}">
                Users
            </x-nav-link-dash>

            @if($isActive)
                <div class="left-0 space-y-2 w-full bg-gray-700 pl-[36px]">
                    <x-nav-child-link href="/dashboard/users/" wire:navigate active="{{ request()->is('dashboard/users') ? 'active' : '' }}">
                        All Users
                    </x-nav-child-link>
                    <x-nav-child-link href="/dashboard/users/create" wire:navigate active="{{ request()->is('dashboard/users/create') ? 'active' : '' }}">
                        Add New
                    </x-nav-child-link>
                    <x-nav-child-link href="/dashboard/user/{{ $user->id }}" wire:navigate active="{{ request()->is('dashboard/user/*') ? 'active' : '' }}">
                        Your Profile
                    </x-nav-child-link>
                </div>
            @endif
        </div>

        <x-nav-link class="block px-6 !mt-auto" style="background-color: unset;">
            <form action="/logout" method="POST">
                @csrf
                <button title="Logout!" class="flex items-center">
                    <span class="flex w-8 h-8 overflow-hidden rounded-full mr-3">
                        <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('/storage/default-avatar.jpg') }}"
                             alt="User Avatar" class="w-full h-full object-cover">
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                </button>
            </form>
        </x-nav-link>
    </nav>


</div>
