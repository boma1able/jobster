<div>
    <x-dashboard.welcome />


    <div class="flex space-x-6">

        <div class="w-2/5 bg-gray-100 rounded-lg">
            <h2 class="text-2xl font-bold mb-4">
                {{ $isEditing ? 'Edit category' : 'Add category' }}
            </h2>

            <x-form.field class="bg-gray-50">
                <x-form.label class="text-xs">
                    Category Name
                </x-form.label>
                <input type="text" wire:model="name" class="w-full mt-1 p-2 border rounded mb-2">
            </x-form.field>

            <x-form.field>
                <x-form.label class="text-xs">
                    Category Slug(Optional)
                </x-form.label>
                <input type="text" wire:model="slug" class="w-full mt-1 p-2 border rounded mb-2">
            </x-form.field>

            <x-form.field>
                <x-form.label class="text-xs">
                    Description
                </x-form.label>
                <textarea wire:model="description" rows="5" class="mt-1 p-2 form-control border rounded !w-full resize-none"></textarea>
            </x-form.field>

            <x-form.button wire:click="store" class="mt-6 {{ $isEditing ? 'bg-green-500 hover:bg-green-400' : '' }}">
                {{ $isEditing ? 'Update' : 'Add new' }}
            </x-form.button>

            @if($isEditing)
                <button wire:click="create" class="ml-4 text-sm">Cancel</button>
            @endif
        </div>


        <div class="w-3/5 rounded-lg p-6 bg-white shadow-md">

            @if (session()->has('message'))

            @endif

            <div class="overflow-hidden rounded-lg">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-2 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Name</th>
                        <th class="px-2 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Description</th>
                        <th class="px-2 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Slug</th>
                        <th class="px-2 py-3 text-left text-xxs font-medium text-gray-700 uppercase">
                            <p class="flex justify-center">Count</p>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($categories as $category)
                        <tr>
                            <td class="p-4 min-w-0 w-[300px]">
                                <span class="text-sm text-gray-600 font-bold">{{ $category->name }}</span>
                                <div class="flex flex-wrap mt-2 space-x-3">
                                    <button wire:click="edit({{ $category->id }})" class="text-xxs text-gray-400">Edit</button>
                                    <button wire:click="delete({{ $category->id }})" class="text-xxs text-red-400">Delete</button>
                                </div>
                            </td>
                            <td class="p-4 text-sm text-gray-500 min-w-0 w-[300px] text-xs">
                                {{ \Str::limit(strip_tags($category->description), 50) }}
                            </td>
                            <td class="p-4 text-xs font-medium text-gray-500 min-w-[107px]">{{ $category->slug }}</td>
                            <td class="p-4 text-xs font-medium text-gray-500 min-w-[107px]">
                                <p class="flex justify-center">
                                    <a href="{{ url('/' . $category->slug)}}" class="hover:text-black hover:underline">{{ $category->posts()->count() }}</a>
                                </p>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
