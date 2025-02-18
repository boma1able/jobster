<x-dashboard.layout>

    <x-dashboard.welcome :users="$users"/>

    <x-dashboard.page-title>
        <x-slot:title>
            Dashboard
        </x-slot:title>
    </x-dashboard.page-title>

{{--    @if ($jobs->count() > 0)--}}
{{--        <x-dashboard.jobs-list :jobs="$jobs"/>--}}
{{--        <x-ui-link href="/dashboard/jobs" class="mt-5">See more Jobs</x-ui-link>--}}
{{--    @endif--}}

{{--    @if ($posts->count() > 0)--}}
{{--        <x-dashboard.posts-list :posts="$posts"/>--}}
{{--        <x-ui-link href="/dashboard/posts" class="mt-5">More Posts</x-ui-link>--}}
{{--    @endif--}}

{{--    @extends('components.dashboard.layout')--}}

    @yield('content')

</x-dashboard.layout>
