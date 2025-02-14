@props(['items'])

<div class="overflow-hidden">
    <div class="space-y-4">

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-2 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Name</th>
                    <th class="px-2 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Description</th>
                    <th class="px-2 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Slug</th>
                    <th class="px-2 py-3 text-left text-xxs font-medium text-gray-700 uppercase">
                        <p class="flex justify-center">Count</p>
                    </th>
                    @if(!request()->is('dashboard'))
                        <th class="px-2 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Actions</th>
                    @endif
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($items as $item)
                        <x-dashboard.taxonomy-item :item="$item"/>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
