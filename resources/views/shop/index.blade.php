<x-layout>

    <div class="mx-auto max-w-2xl my-10 lg:mx-0">
        <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">Shop</h2>
        <p class="mt-2 text-lg/8 text-gray-600">A boutique shop offering home decor and cosmetics, providing stylish items to enhance both living spaces and personal beauty. It's a one-stop spot for trendy, quality products.</p>
    </div>

    <div class="bg-white">
        <div class="mx-auto p-5 sm:px-6 sm:py-10 lg:px-8">

            <div class="mt-6 grid grid-cols-4 gap-x-6 gap-y-10 sm:grid-cols-4 lg:grid-cols-4 xl:gap-x-8">
                @foreach($products as $product)
                    <div class="group relative">
                        <img src="{{ asset('storage/products/' . $product->image) }}" alt="" class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75">
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a href="{{ route('shop.show', $product->id) }}">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">Black</p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">${{ $product->price }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mt-10">
        {{ $products->links() }}
    </div>


</x-layout>
