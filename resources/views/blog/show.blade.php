<x-layout>

    <x-breadcrumbs :post="$post"/>

    <div class="bg-white mx-auto w-full max-w-[768px] pb-6 sm:pb-10 rounded-lg overflow-hidden">
        <div>
            <div>
                <div class="w-full h-[250px] mb-4">
                    <img src="{{ asset('storage/' . ($post->featured_img ?? 'default-avatar.jpg')) }}" class="w-full h-full object-cover" alt="">
                </div>

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

    <div class="bg-white mx-auto w-full max-w-[768px] mt-8 p-10 sm:py-10 rounded-lg overflow-hidden">

        <h2 class="text-xl font-semibold mb-4">Comments</h2>

        <div class="m-auto space-y-4 comments-list relative">

            @foreach($post->comments as $comment)
                @if($comment->approved)
                    <div class="flex">
                        <span class="w-8 h-8 overflow-hidden rounded-full mr-7 border border-gray-200 hover:border-gray-300">
                            <img src="{{ $comment->user && $comment->user->avatar ? asset('storage/' . $comment->user->avatar) : asset('/storage/default-avatar.jpg') }}"
                                 alt="User"
                                 class="w-full h-full object-cover z-10 relative">
                        </span>
                        <div class="flex-1 border p-3 rounded-lg bg-[#F6F8FC5C]">
                            <div class="flex justify-between mb-2">
                                <h3 class="text-[12px] font-semibold">
                                    {{ $comment->user ? $comment->user->name : 'Анонім' }}
                                </h3>
                                <span class="text-xxs text-gray-500">
                                    {{ $comment->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <p class="text-[14px]">{{ $comment->content }}</p>
                        </div>
                    </div>
                @endif
            @endforeach


        </div>

        @auth
            <div class="flex mt-10 bg-transparent">

                <div class="w-10 h-10 overflow-hidden rounded-full mr-5 border border-gray-200 hover:border-gray-300">
                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('/storage/default-avatar.jpg') }}" alt="User Avatar"
                         class="w-full h-full object-cover">
                </div>

                <div class="flex-1 w-full border rounded-lg space-x-4 overflow-hidden bg-[#F6F8FC5C]">
                    <form action="{{ route('comments.store', $post->slug) }}" method="POST" class="w-full bg-transparent">
                        @csrf

                        <div class="flex items-center rounded-md">
                            <textarea name="content" class="w-full resize-none p-3 text-sm outline-none bg-transparent" placeholder="Add your comment..." required></textarea>
                        </div>
                        <x-form.error name="content"/>

                        <div class="flex items-center justify-end pr-3 pb-3">
                            <button class="flex justify-center text-gray-500 rounded-md px-3 py-1.5 text-sm/6 font-semibold bg-white text-black shadow-xs border hover:bg-gray-200">Add Comment</button>
                        </div>

                    </form>
                </div>
            </div>
        @else
            <div>
                <p class="mt-10 text-center text-sm/6 text-gray-500">
                    You need to be authorized to leave a comment! <a href="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">Please login</a>
                </p>
            </div>
        @endauth


    </div>


</x-layout>
