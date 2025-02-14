<tr class="{{ $comment->approved ? '' : 'bg-[#ff818114]' }}">
    <td class="px-5 py-4 text-sm text-gray-500 min-w-0 w-[300px]">
        <span class="{{ $comment->approved ? 'approved' : 'unapprove' }}"></span>
        <span class="text-xs">{{ $comment->user->name }}</span>
    </td>
    <td class="px-3 py-3 text-sm text-gray-400 min-w-0 w-[40%] comment-text">
        <a href="{{ route('dashboard.comments.edit', $comment->id) }}" class="text-xxs hover:underline">{{ $comment->content}}</a>
        <span class="flex flex-wrap mt-3 space-x-3">
            @php
                $isApproved = $comment->approved;
                $action = $isApproved
                    ? route('dashboard.comments.reject', $comment->id)
                    : route('dashboard.comments.approve', $comment->id);
                $buttonText = $isApproved ? 'Unapprove' : 'Approve';
                $buttonColor = $isApproved ? 'text-yellow-400' : 'text-green-600';
            @endphp
            <form action="{{ $action }}" method="POST">
                @csrf
                <button type="submit" class="text-xxs {{ $buttonColor }} flex items-center">
                    <span>{{ $buttonText }}</span>
                </button>
            </form>
            @if(!request()->is('dashboard'))
                <a href="{{ route('dashboard.comments.edit', $comment->id) }}" class="text-xxs flex items-center">
                    Edit
                </a>
                <button onclick="openDeleteModal({{ $comment->id }}, 'comments')" class="text-xxs text-red-400 flex items-center">
                    Delete
                </button>
            @endif
        </span>
    </td>
    <td class="px-5 py-4 text-xxs text-gray-500 min-w-0 w-[300px] text-center underline"><a href="{{ url('/blog/' . $comment->post->slug)}}">View Post</a></td>
    <td class="px-5 py-4 text-xxs text-gray-500 min-w-[107px]">{{ $comment->created_at->format('d/m/y \a\t h:i a') }}</td>

</tr>

