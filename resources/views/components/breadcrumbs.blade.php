@props(['tag' => null, 'category' => null, 'job' => null, 'post' => null])

<nav class="flex mt-5 mb-10 text-xxs" aria-label="Breadcrumb">
    <ol class="inline-flex items-center">
        <li>
            <div class="flex items-center">
                <a href="{{ $job ? '/jobs' : '/blog' }}" class="text-gray-400 hover:text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </a>
            </div>
        </li>
        @if($category)
            <li>
                <div class="flex items-center">
                    <span class="mx-2 text-gray-400">/</span>
                    <p class="text-gray-400">Category</p>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <span class="mx-2 text-gray-400">/</span>
                    <a href="{{ route('category', $category) }}" class="text-gray-400 hover:text-gray-500">{{ $category->name }}</a>
                </div>
            </li>
        @endif

        @if($tag)
            <li>
                <div class="flex items-center">
                    <span class="mx-2 text-gray-400">/</span>
                    <p class="text-gray-400">Tag</p>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <span class="mx-2 text-gray-400">/</span>
                    <a href="{{ route('tag', $tag) }}" class="text-gray-400 hover:text-gray-500">{{ $tag->name }}</a>
                </div>
            </li>
        @endif

        @if($job)
            <li>
                <div class="flex items-center">
                    <span class="mx-2 text-gray-400">/</span>
                    <p class="text-gray-400">Job</p>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <span class="mx-2 text-gray-400">/</span>
                    <span class="text-gray-400">{{ $job->title }}</span>
                </div>
            </li>
        @endif

        @if($post)
            <li aria-current="page">
                <div class="flex items-center">
                    <span class="mx-2 text-gray-400">/</span>
                    <span class="text-gray-500">{{ $post->title }}</span>
                </div>
            </li>
        @endif
    </ol>
</nav>
