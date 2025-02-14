@props(['pending'])

<div class="fixed inset-y-0 left-0 w-64 bg-gray-800 text-white">
    <div class="flex items-center justify-center h-16 bg-gray-900">
        <div class="shrink-0">
            <a href="/"><img class="size-8" src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Logo"></a>
        </div>
    </div>

    <nav class="mt-6">
        <x-nav-link-dash href="/dashboard" icon="1" active="{{ request()->is('dashboard') ? 'active' : '' }}">
            Dashboard
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

            <x-nav-link-dash href="/dashboard/posts" icon="3" active="{{ $isPostsActive ? 'active' : '' }}">
                Posts
            </x-nav-link-dash>

            @if($isPostsActive)
                <div class="left-0 space-y-2 w-full bg-gray-700 pl-[36px]">
                    <x-nav-child-link href="/dashboard/posts/" active="{{ request()->is('dashboard/posts') ? 'active' : '' }}">All Posts</x-nav-child-link>
                    <x-nav-child-link href="/dashboard/posts/create" active="{{ request()->is('dashboard/posts/create') ? 'active' : '' }}">Add new</x-nav-child-link>
                    <x-nav-child-link href="/dashboard/categories" active="{{ request()->is('dashboard/categories', 'dashboard/categories/*/edit', 'dashboard/categories/create') ? 'active' : '' }}">Categories</x-nav-child-link>
                    <x-nav-child-link href="/dashboard/tags" active="{{ request()->is('dashboard/tags', 'dashboard/tags/*/edit', 'dashboard/tags/create') ? 'active' : '' }}">Tags</x-nav-child-link>
                </div>
            @endif
        </div>

        <x-nav-link-dash href="/dashboard/comments" icon="5" active="{{ request()->is('dashboard/comments', 'dashboard/comments/*/edit') ? 'active' : '' }}">
            Comments
            @if ($pending > 0)
                <span class="badge flex w-[18px] h-[18px] text-[10px] justify-center text-center  rounded-full bg-red-500 text-white ml-2 leading-[17px]">{{ $pending }}</span>
            @endif
        </x-nav-link-dash>

        <div class="relative">
            @php
                $isActive = request()->is(
                    'dashboard/users*',
                    'dashboard/user/*'
                    );
            @endphp

            <x-nav-link-dash href="/dashboard/users" icon="4" active="{{ $isActive ? 'active' : '' }}">
                Users
            </x-nav-link-dash>

            @if($isActive)
                <div class="left-0 space-y-2 w-full bg-gray-700 pl-[36px]">
                    <x-nav-child-link href="/dashboard/users/" active="{{ request()->is('dashboard/users') ? 'active' : '' }}">
                        All Users
                    </x-nav-child-link>
                    <x-nav-child-link href="/dashboard/users/create" active="{{ request()->is('dashboard/users/create') ? 'active' : '' }}">
                        Add New
                    </x-nav-child-link>
                    <x-nav-child-link href="/dashboard/user/{{ $user->id }}" active="{{ request()->is('dashboard/user/*') ? 'active' : '' }}">
                        Your Profile
                    </x-nav-child-link>
                </div>
            @endif
        </div>
    </nav>


</div>
