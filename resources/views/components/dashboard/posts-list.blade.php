@props(['posts'])

<div class="mt-6">
    <div class="overflow-hidden shadow-md rounded-lg">
        <div class="space-y-4">

            <div class="overflow-x-auto bg-white">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Author</th>
                        <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Title</th>
                        <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Categories</th>
                        <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Tags</th>
                        <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase text-center">Comments</th>
                        <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Date</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($posts as $post)
                            <x-dashboard.post-item :post="$post"/>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(request()->routeIs('dashboard.posts'))
                <div>
                    {{ $posts->links() }}
                </div>
            @endif

        </div>
    </div>
</div>
