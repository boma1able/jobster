<div>
    <x-dashboard.welcome />

    <x-dashboard.page-title>
        <x-slot:title>
            <div class="flex justify-between mb-5">
                Products
            </div>
        </x-slot:title>
    </x-dashboard.page-title>

    <a href="/dashboard/products/manage" wire:navigate  class="inline-block rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs">Add new</a>

    @if ($products->count() > 0)
        <div class="space-y-4">
            <div class="my-5">
                {{ $products->links() }}
            </div>
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="flex justify-center px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </th>
                        <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Product name</th>
                        <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase text-center">Stock</th>
                        <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase text-center">Price</th>
                        <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase text-center">Date</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($products as $product)
                        <tr>
                            <td class="px-4 py-4 text-xs text-gray-500 min-w-0 w-[150px] text-center">
                                <img src="{{ asset('storage/products/' . $product->image) }}" alt="" class="aspect-square max-w-[80px] w-full rounded-md bg-gray-200 object-cover m-auto">
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500 min-w-0 w-[300px]">
                                <a href="{{ route('shop.show', $product->id) }}" class="font-semibold hover:underline">{{ $product->name }}</a>
                                <span class="flex flex-wrap mt-2 space-x-3">
                                    <button wire:click="redirectToEdit({{ $product->id }})" class="text-gray-400 text-xxs">Edit</button>
                                    <a href="#" wire:click.prevent="delete({{ $product->id }})" class="text-red-400 text-xxs">Delete</a>
                                </span>
                            </td>
                            <td class="px-4 py-4 text-xxs font-medium text-gray-500 min-w-[107px] text-center">
                                -
                            </td>
                            <td class="px-4 py-4 text-xxs font-medium text-gray-500 min-w-[107px] text-center">
                                {{ $product->price }} USD
                            </td>
                            <td class="px-4 py-4 text-xxs font-medium text-gray-400 min-w-[107px] text-center">
                                {{ $product->created_at->format('d/m/y \a\t h:i a') }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>
        <div class="mt-5">
            {{ $products->links() }}
        </div>
    @else
        <p class="text-gray-500 mt-4">No products available.</p>
    @endif
</div>
