@props(['post'])

<article class="flex max-w-xl flex-col items-start justify-between group">
    <a href="{{ route('blog.show', $post->slug) }}" class="w-full h-[220px] mb-4 overflow-hidden rounded-lg transition-all duration-500">
        <img src="{{ asset('storage/media/' . $post->featured_img) }}" alt="image" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
    </a>
    <div class="flex items-center gap-x-4 text-xs">
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
