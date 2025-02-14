<x-layout>

    <div class="mx-auto max-w-2xl my-10 lg:mx-0">
        <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">From the blog</h2>
        <p class="mt-2 text-lg/8 text-gray-600">Learn how to grow your business with our expert advice.</p>
    </div>

    <div class="bg-white pb-20">

        <div class="flex mx-auto text-center bg-[#F6F8FC5C] border-b justify-start space-x-10 px-8 sm:py-4 sm:mb-8">

            @foreach($categories as $category)
                <a href="{{ route('category', ['category' => $category->slug]) }}" class="text-gray-500 hover:text-gray-900 hover:text-bold pr-4">{{ $category->name }}</a>
            @endforeach

        </div>

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mx-auto mt-2 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:mt-5 sm:pt-10 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                @foreach($posts as $post)
                    <x-blog.article :post="$post"/>
                @endforeach

            </div>
        </div>

    </div>

    <div class="pt-10 py-6">
        {{ $posts->links() }}
    </div>


</x-layout>
