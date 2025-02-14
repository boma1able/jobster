<tr>
    <td class="px-4 py-4 text-xs text-gray-500 min-w-0 w-[150px]">{{ $post->author_name }}</td>
    <td class="px-4 py-4 text-sm text-gray-500 min-w-0 w-[300px]">
        <a href="{{ url('blog') . '/' . $post->slug }}" class="font-semibold hover:underline">{{ $post->title }}</a>
        <span class="flex flex-wrap mt-3 space-x-3 text-gray-400">
            @if(!request()->is('dashboard'))
                <a href="{{ route('dashboard.posts.edit', $post->id) }}" class="text-xxs flex items-center">
                    Edit
                </a>
                <button onclick="openDeleteModal({{ $post->id }}, 'posts')" class="text-xxs text-red-400 flex items-center">
                    Delete
                </button>
            @endif
        </span>
    </td>
    <td class="px-4 py-4 text-xxs font-medium text-gray-500 min-w-[107px]">
        {{ $post->categories->pluck('name')->join(', ') }}
    </td>
    <td class="px-4 py-4 text-xxs font-medium text-gray-500 min-w-[107px]">
        {{ $post->tags->pluck('name')->join(', ') }}
    </td>
    <td class="px-4 py-4 text-xxs font-medium text-gray-500">
        <a href="{{ url('blog') . '/' . $post->slug }}" class="flex justify-center relative">
            <span class="absolute top-[4px]">{{ $post->comments->where('approved', true)->count() }}</span>
            <span class="w-[30px]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" aria-hidden="true" data-slot="icon" class="on bar">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"></path>
            </svg>
            </span>
        </a>
    </td>
    <td class="px-4 py-4 text-xxs font-medium text-gray-400 min-w-[107px]">{{ $post->created_at->format('d/m/y \a\t h:i a') }}</td>

</tr>

