<div>
    <x-dashboard.welcome />

    <x-dashboard.page-title>
        <x-slot:title>
            <div class="flex justify-between mb-6">
                Media Library
            </div>
        </x-slot:title>
    </x-dashboard.page-title>

    <div class="w-full flex justify-end mb-6 p-1 border-b text-xs text-gray-500">
        Show <span class="mx-1">{{ $loadedCount }}</span>of<span class="ml-1">{{ $totalCount }}</span>
    </div>

    <div class="flex flex-wrap gap-5">
        @foreach($images as $image)
            @php
                $imageName = pathinfo($image, PATHINFO_FILENAME);
            @endphp
            <div class="relative w-[150px] h-[150px] group">
                <img src="{{ $image }}"
                     class="w-full h-full object-cover rounded shadow group-hover:bg-gray-700 group-hover:opacity-50 duration-200">
                <div class="absolute w-full p-2 flex flex-wrap justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 ">
                    <p class="font-bold mb-2">{{ $imageName }}</p>
                    <button wire:click="deleteImage('{{ $image }}')"
                            class="bg-red-500 text-white px-2 py-1 text-xs rounded">
                        Delete
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    @if($loadedCount < $totalCount)
        <div class="w-full mt-4 text-center">
            <button wire:click="loadMore" class="inline-block rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs">
                Load more
            </button>
        </div>
    @endif
</div>
