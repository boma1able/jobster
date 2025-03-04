<div class="p-10">
    @if (!empty($cart))

        <table class="overflow-x-auto bg-white shadow-md rounded-lg min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase text-center">Action</th>
                    <th class="flex justify-center px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </th>
                    <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Product name</th>
                    <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase text-center">Price</th>
                    <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase text-center">Quantity</th>
                    <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase text-center">Subtotal</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($cart as $item)
                    <tr>
                        <td class="text-center">
                            <button wire:click="removeItem({{ $item['product_id'] }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="gray" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </button>
                        </td>
                        <td class="px-4 py-4 text-xs text-gray-500 min-w-0 w-[150px] text-center">
                            <a href="{{ route('shop.show', $item['product_id']) }}" class="font-semibold hover:underline">
                                <img src="{{ asset('storage/products/' . $item['image']) }}" alt="" class="aspect-square max-w-[80px] w-full rounded-md bg-gray-200 object-cover m-auto">
                            </a>
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-500 min-w-0 w-[300px]">
                            <a href="{{ route('shop.show', $item['product_id']) }}" class="font-semibold hover:underline">{{ $item['name'] }}</a>
                        </td>
                        <td class="px-4 py-4 text-xxs font-medium text-gray-500 min-w-[107px] text-center">
                            ${{ $item['price'] }}
                        </td>
                        <td class="px-4 py-4 text-xxs font-medium text-gray-500 min-w-[107px] text-center">
                            {{ $item['quantity'] }}
                        </td>
                        <td class="px-4 py-4 text-xxs font-medium text-gray-500 min-w-[107px] text-center">
                            ${{ number_format($item['price'] * $item['quantity'], 2) }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="my-4">
            <button wire:click="clearCart" class="text-xxs text-gray-500 underline">Clear Cart</button>
        </div>

        <div class="w-full flex justify-end flex-wrap">
            <div class="flex w-[40%]">
                <div class="w-full">
                    <table class="overflow-x-auto bg-white shadow-md rounded-lg min-w-full table-auto">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Card Total</th>
                            <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase text-center"></th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-4 py-4 text-sm font-medium text-gray-500 min-w-[107px]">
                                Subtotal
                            </td>
                            <td class="px-4 py-4 text-sm font-medium text-gray-500 min-w-[107px]">
                                ${{ $this->getTotalAmount() }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-4 text-sm font-medium text-gray-500 min-w-[107px]">
                                Total
                            </td>
                            <td class="px-4 py-4 text-sm font-medium text-gray-500 min-w-[107px]">
                                ${{ $this->getTotalAmount() }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="mt-6">
                        <a href="/checkout"
                           class="w-full block text-center rounded bg-gray-800 text-white px-4 py-2 border border-gray-800 hover:bg-gray-600">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>

        </div>

    @else
        <p class="w-full text-center text-xs text-gray-500">Your cart is empty. Return to the <a href="/shop" class="underline">Shop</a></p>
    @endif

</div>



