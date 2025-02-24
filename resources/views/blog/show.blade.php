<x-layout>

    <x-breadcrumbs :post="$post"/>

    <div class="bg-white mx-auto w-full max-w-[768px] pb-6 sm:pb-10 rounded-lg overflow-hidden">
        <div>
            <div>
                <div class="w-full h-[250px] mb-4">
                    <img src="{{ asset('storage/media/' . ($post->featured_img ?? 'default-avatar.jpg')) }}" class="w-full h-full object-cover" alt="">
                </div>

                @if(Route::is('blog.show'))
                    @php
                        $cookieKey = "viewed_post_{$post->id}";
                    @endphp

                    @if(!request()->hasCookie($cookieKey))
                        @php
                            $post->increment('unique_views');
                            cookie()->queue($cookieKey, true, 60 * 24);
                        @endphp
                    @endif
                @endif

                <div class="px-10 pt-8">
                    <div class="text-xxs mb-4 text-gray-400">
                        @foreach($post->categories as $category)
                            <a href="{{ route('category', ['category' => $category->slug]) }}" class="hover:underline hover:text-gray-900">{{ $category->name }}</a>
                            @if(!$loop->last) ,@endif
                        @endforeach
                    </div>
                    <h2 class="text-3xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-3xl">{{ $post->title }}</h2>
                    <p class="flex mt-5 text-lg/8 text-gray-600 text-sm">
                        <span class="flex w-10 h-10 overflow-hidden rounded-full mr-3 border border-gray-200">
                            <img src="{{ asset('storage/' . ($post->user->avatar ?? 'default-avatar.jpg')) }}" alt="User Avatar" class="w-full h-full object-cover">
                        </span>
                        <span>{{ $post->author_name }}</span>
                    </p>

                    <div class="post-content mx-auto mt-5 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-5 border-t border-gray-200 pt-5 sm:mt-5 sm:pt-8 lg:mx-0 lg:max-w-none">

                        @markdown
                        {!! "\n" . $post->content !!}
                        @endmarkdown

                    </div>

                    @if($post->tags->count())
                        <div class="mt-20 ">
                            @foreach($post->tags as $tag)
                                <a href="{{ route('tag', ['tag' => $tag->slug]) }}" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>

    @livewire('dashboard.comments.post-comments', ['slug' => $post->slug])


</x-layout>
