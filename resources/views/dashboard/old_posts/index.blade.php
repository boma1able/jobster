<x-dashboard.layout>

    <x-dashboard.welcome />

        <x-ui-button-link href="/dashboard/posts/create">Add New</x-ui-button-link>

    <x-dashboard.page-title>
        <x-slot:title>
            <div class="flex justify-between">
                Posts
                <x-dashboard.search route="{{ route('dashboard.posts.index') }}"/>
            </div>
        </x-slot:title>
    </x-dashboard.page-title>

    @if ($posts->count() > 0)
        <x-dashboard.posts-list :posts="$posts"/>
    @endif


</x-dashboard.layout>
