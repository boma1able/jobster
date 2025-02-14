<x-dashboard.layout>

    <x-dashboard.welcome />

    <x-dashboard.page-title>
        <x-slot:title>
            Comments
        </x-slot:title>
    </x-dashboard.page-title>

    <div class="flex justify-between mt-10 item-center">
        <div class="flex self-center">
            <x-dashboard.filter-bar/>
        </div>
        <x-dashboard.search route="{{ route('dashboard.comments.index') }}"/>
    </div>

    @if ($comments->count() > 0)
        <x-dashboard.comments-list :comments="$comments"/>
    @endif

</x-dashboard.layout>
