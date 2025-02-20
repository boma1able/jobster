<div>
    <x-dashboard.welcome />

    <x-dashboard.page-title>
        <x-slot:title>
            <div class="flex justify-between mb-6">
                Media Library
            </div>
        </x-slot:title>
    </x-dashboard.page-title>

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
    <div class="max-w-[1000px]">
        <div class="w-full flex justify-center my-4 p-1 text-xs text-gray-500">
            Showing <span class="mx-1">{{ $loadedCount }}</span>of<span class="mx-1">{{ $totalCount }}</span>media items
        </div>
        @if($loadedCount < $totalCount)
            <div class="w-full mt-4 text-center">
                <button wire:click="loadMore" class="mb-8 inline-block rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 cursor-pointer">
                    Load more
                </button>
            </div>
        @endif
    </div>
</div>
