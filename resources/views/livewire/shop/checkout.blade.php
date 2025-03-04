
    <div class="container mx-auto py-12 grid grid-cols-1 md:grid-cols-2 gap-8">

        <div>
            <h2 class="text-2xl font-semibold mb-4">Billing info</h2>

            <form wire:submit.prevent="placeOrder" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium">Name</label>
                    <input type="text" wire:model="billing.name" class="w-full border p-2 rounded">
                    @error('billing.name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" wire:model="billing.email" class="w-full border p-2 rounded">
                    @error('billing.email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Address</label>
                    <input type="text" wire:model="billing.address" class="w-full border p-2 rounded">
                    @error('billing.address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">City</label>
                        <input type="text" wire:model="billing.city" class="w-full border p-2 rounded">
                        @error('billing.city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Post code</label>
                        <input type="text" wire:model="billing.zip" class="w-full border p-2 rounded">
                        @error('billing.zip') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium">Country</label>
                    <x-country-select/>
                    @error('billing.country') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full block text-center rounded bg-gray-800 text-white px-4 py-2 border border-gray-800 hover:bg-gray-600">Place Order</button>
            </form>

            @if (session()->has('success'))
                <p class="text-green-600 mt-4">{{ session('success') }}</p>
            @endif
        </div>

        <div>
            <h2 class="text-2xl font-semibold mb-4">Your order</h2>

            <table class="overflow-x-auto bg-white shadow-md rounded-lg min-w-full table-auto">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Product name</th>
                    <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase text-center">Subtotal</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($cart as $item)
                        <tr>
                            <td class="px-4 py-4 text-sm text-gray-700 min-w-0">
                                <a href="{{ route('shop.show', $item['product_id']) }}" class="font-semibold hover:underline">{{ $item['name'] }} x {{ $item['quantity'] }}</a>
                            </td>
                            <td class="px-4 py-4 text-xxs font-medium text-gray-500 min-w-[107px] text-center">
                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                            </td>
                        </tr>
                    @empty
                        <p class="w-full text-center text-xs text-gray-800 mb-5 bg-yellow-300 p-2">Cart is empty!</p>
                    @endforelse
                </tbody>
            </table>

            <div class="bg-white shadow-md rounded-xs min-w-full mt-8 p-4 font-semibold text-ls text-gray-700 min-w-0">
                Total: ${{ number_format($this->getTotalAmount(), 2) }}
            </div>

            <div class="flex justify-end mt-5">
                <a href="/cart" class="text-xxs underline text-blue-500">Back to cart</a>
            </div>
        </div>
    </div>
