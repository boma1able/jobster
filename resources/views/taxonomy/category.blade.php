<x-layout>

    <x-breadcrumbs :category="$category"/>

    <div class="bg-white py-6 sm:py-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">{{ $category->name }}</h2>
                <p class="mt-2 text-lg/8 text-gray-600">{{ $category->description }}</p>
            </div>

            <div class="mx-auto mt-5 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                @foreach($posts as $post)
                    <x-blog.article :post="$post"/>
                @endforeach

            </div>
        </div>

    </div>

    <div class="pt-20 py-6">
        {{ $posts->links() }}
    </div>


</x-layout>
