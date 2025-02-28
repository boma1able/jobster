<div>
    <div class="flex space-4 justify-between border-b pb-20">
        <div class="w-[40%]">
            <img src="{{ asset('storage/products/' . $product->image) }}" alt="" class="aspect-square w-full rounded-md bg-gray-200 object-cover">
        </div>

        <div class="w-[48%] py-4">
            <h1 class="text-[48px]">{{ $product->name }}</h1>
            <div class="flex mb-4 items-center">
                <div class="flex mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#333" viewBox="0 0 24 24" stroke-width="1.5" stroke="" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#333" viewBox="0 0 24 24" stroke-width="1.5" stroke="" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#333" viewBox="0 0 24 24" stroke-width="1.5" stroke="" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#333" viewBox="0 0 24 24" stroke-width="1.5" stroke="" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#333" viewBox="0 0 24 24" stroke-width="1.5" stroke="" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>
                </div>
                <a href="#" class="text-gray-800 text-sm leading-none underline">14 reviews</a>
            </div>

            <p class="text-2xl mb-2">${{ $product->price }}</p>

            <p class="text-gray-700 mb-4 text-gray-400">{{ $product->description }}</p>

            <div class="flex justify-between items-center">
                <livewire:shop.add-to-cart-button :productId="$product->id" />

                <a href="/cart" class="text-blue-400 font-bold text-xs inline-block underline">Go to Cart</a>
            </div>

            <p class="text-xs mt-10">
                Categories:
                @forelse($product->product_categories as $index => $item)
                    <a href="/" class="underline">{{ $item->name }}</a>
                    @if(!$loop->last)
                        <span>, </span>
                    @endif
                @empty
                    <span>Without any category.</span>
                @endforelse
            </p>
        </div>

    </div>

    <div class="flex space-4 mt-14 border-b pb-14">
        <h2 class="w-full text-center text-[28px] text-gray-800">Description</h2>

        <div class="space-y-4">
            <p>The Eclipse Ceramic Vase is a minimalist masterpiece designed to enhance modern interiors. Its smooth matte finish and clean lines exude understated elegance, making it a versatile addition to any space. Perfect for tabletops, shelves, or mantels, this vase complements a variety of decor styles, from contemporary to Scandinavian. Its neutral tone blends seamlessly with any color palette, allowing it to shine as a subtle yet striking centerpiece.</p>
            <p>Crafted from high-quality ceramic, the vase is both durable and lightweight, making it easy to move and style. Whether used to display a single stem, a small bouquet, or as a standalone decorative piece, it adds a touch of sophistication to living rooms, bedrooms, offices, or meditation spaces.</p>
        </div>
    </div>

    <div class="mt-14 pb-10">
        <h2 class="w-full text-[28px] text-gray-800 mb-8">You may also like</h2>

        <div class="flex space-x-[3%]">

            @foreach ($relatedProducts as $product)
                <div class="w-[24%] group relative">
                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="" class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75">
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-700">
                                <a href="{{ route('shop.show', $product->id) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <p class="text-sm font-medium text-gray-900 mt-2">${{ $product->price }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>


</div>
