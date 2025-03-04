<div>
    <x-dashboard.welcome />

    <x-dashboard.page-title>
        <x-slot:title>
            <div class="flex justify-between mb-5">
                Orders
            </div>
        </x-slot:title>
    </x-dashboard.page-title>

    @if ($orders->count() > 0)
        <div class="space-y-4">
            <div class="my-5">
{{--                {{ $orders->links() }}--}}
            </div>
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase text-center">Order ID</th>
                        <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase ">Customer name</th>
                        <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase ">Email</th>
                        <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase text-center">Total</th>
                        <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase text-center">Country</th>
                        <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase text-center">Date</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($orders as $order)
                        <tr>
                            <td class="px-4 py-4 text-xs text-gray-500 min-w-0 w-[150px] text-center">
                                {{ $order->id }}
                            </td>
                            <td class="px-4 py-4 text-xxs font-medium text-gray-500 min-w-[107px]">
                                {{ $order->customer_name }}
                            </td>
                            <td class="px-4 py-4 text-xxs font-medium text-gray-500 min-w-[107px]">
                                {{ $order->customer_email }}
                            </td>
                            <td class="px-4 py-4 text-xxs font-medium text-gray-500 min-w-[107px] text-center">
                                {{ $order->total }} USD
                            </td>
                            <td class="px-4 py-4 text-xxs font-medium text-gray-500 min-w-[107px] text-center">
                                {{ $order->customer_country }} <br>
                            </td>
                            <td class="px-4 py-4 text-xxs font-medium text-gray-400 min-w-[107px] text-center">
                                {{ $order->created_at->format('d/m/y \a\t h:i a') }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>
        <div class="mt-5">
            {{ $orders->links() }}
        </div>
    @else
        <p class="text-gray-500 mt-4">No orders available.</p>
    @endif

</div>
