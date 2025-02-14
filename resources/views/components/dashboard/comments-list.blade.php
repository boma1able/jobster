@props(['comments'])

<div class="mt-6">
    <div class="overflow-hidden comments-table shadow-md rounded-lg">
        <div class="space-y-4">

            <div class="overflow-x-auto bg-white">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xxs font-medium text-gray-700 uppercase w-[100px]">Author</th>
                        <th class="px-5 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Comment</th>
                        <th class="px-5 py-3 text-left text-xxs font-medium text-gray-700 uppercase text-center">In response to</th>
                        <th class="px-5 py-3 text-left text-xxs font-medium text-gray-700 uppercase min-w-[160px]">Date</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($comments as $comment)
                        <x-dashboard.comment-item :comment="$comment"/>
                    @endforeach
                    </tbody>
                </table>
            </div>

            @if(request()->routeIs('dashboard.comments'))
                <div>
                    {{ $comments->links() }}
                </div>
            @endif

        </div>
    </div>
</div>
@if(request()->routeIs('dashboard.comments'))
    <div>
        {{ $comments->links() }}
    </div>
@endif
