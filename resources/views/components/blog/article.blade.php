@props(['post'])

<article class="flex max-w-xl flex-col items-start justify-between group">
    <a href="{{ route('blog.show', $post->slug) }}" class="w-full h-[220px] mb-4 overflow-hidden rounded-lg transition-all duration-500">
        <img src="{{ asset('storage/media/' . $post->featured_img) }}" alt="image" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
    </a>
    <div class="flex items-center gap-x-4 text-xs">
        <span class="flex align-center text-gray-500">
            <p class="leading-[10px]">{{ $post->unique_views }}</p>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 ml-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
        </span>
        <time datetime="2020-03-16" class="text-gray-500">{{ $post->created_at->format('d M, Y') }}</time>

        @foreach($post->tags as $tag)
            <a href="{{ route('tag', ['tag' => $tag->slug]) }}" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">{{ $tag->name }}</a>
        @endforeach

    </div>
    <div class="group relative">
        <h3 class="mt-3 text-lg/6 font-semibold text-gray-900">
            <a href="{{ route('blog.show', $post->slug) }}">
                <span class="absolute inset-0"></span>
                {{ $post->title }}
            </a>
        </h3>
        <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600">{{ $post->content }}</p>
    </div>
</article>
