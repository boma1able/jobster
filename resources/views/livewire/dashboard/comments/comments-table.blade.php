<div>
    @if ($comments->count() > 0)
        <div class="flex space-x-4 text-xs text-gray-600">
            <button wire:click="setFilter('all')"
                    class="border-r border-gray-400 pr-4 {{ $filter === 'all' ? 'text-blue-700' : '' }}">
                All ({{ $counts['all'] }})
            </button>

            <button wire:click="setFilter('mine')"
                    class="border-r border-gray-400 pr-4 {{ $filter === 'mine' ? 'text-blue-700' : '' }}">
                Mine ({{ $counts['mine'] }})
            </button>

            <button wire:click="setFilter('pending')"
                    class="border-r border-gray-400 pr-4 {{ $filter === 'pending' ? 'text-blue-700' : '' }}">
                Pending ({{ $counts['pending'] }})
            </button>

            <button wire:click="setFilter('approved')"
                    class="{{ $filter === 'approved' ? 'text-blue-700' : '' }}">
                Approved ({{ $counts['approved'] }})
            </button>
        </div>
    @else
        <p class="text-gray-500 mt-4">No comments available.</p>
    @endif

    @if ($editingComment)
        <div class="my-8 bg-white rounded px-5 py-3 shadow">
            <h3 class="text-md font-semibold mb-2">Edit Comment #{{ $editingComment->id }}</h3>
            <textarea wire:model="newContent" class="w-full p-2 border rounded-lg"></textarea>
            @error('newContent')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <div class="mt-2 flex space-x-2">
                <button wire:click="updateComment" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Update</button>
                <button wire:click="cancelEdit" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Cancel</button>
            </div>
        </div>
    @endif

    @if ($comments->count() > 0)
        <div class="mt-6">
            <div class="overflow-hidden comments-table shadow-md rounded-lg">
                <div class="space-y-4">

                    <div class="overflow-x-auto bg-white">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-5 py-3 text-left text-xxs font-medium text-gray-700 uppercase w-[100px]">Author</th>
                                <th class="px-5 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Comment</th>
                                <th class="px-5 py-3 text-left text-xxs font-medium text-gray-700 uppercase text-center">In response to</th>
                                <th class="px-5 py-3 text-left text-xxs font-medium text-gray-700 uppercase min-w-[160px]">Date</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($comments as $comment)
                                <tr class="{{ $comment->approved ? '' : 'bg-[#ff818114]' }}">
                                    <td class="px-5 py-4 text-sm text-gray-500 min-w-0 w-[300px]">
                                        <span class="{{ $comment->approved ? 'approved' : 'unapprove' }}"></span>
                                        <span class="text-xs">{{ $comment->user->name }}</span>
                                    </td>
                                    <td class="px-3 py-3 text-sm text-gray-400 min-w-0 w-[40%] comment-text">
                                        <a href="" class="text-xxs hover:underline">{{ $comment->content}}</a>
                                        <span class="flex flex-wrap mt-3 space-x-3">
                                                @if($comment->approved)
                                                <button wire:click="reject({{ $comment->id }})" class="text-xxs flex items-center text-yellow-500">Reject</button>
                                            @else
                                                <button wire:click="approve({{ $comment->id }})" class="text-xxs flex items-center text-green-500">Approve</button>
                                            @endif
                                            @if(!request()->is('dashboard'))
                                                <button wire:click="editComment({{ $comment->id }})" class="text-xxs flex items-center">
                                                    Edit
                                                </button>
                                                <button wire:click="deleteComment({{ $comment->id }})" class="text-xxs text-red-400 flex items-center">
                                                    Delete
                                                </button>
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-xxs text-gray-500 min-w-0 w-[300px] text-center underline"><a href="{{ url('/blog/' . $comment->post->slug)}}">View Post</a></td>
                                    <td class="px-5 py-4 text-xxs text-gray-500 min-w-[107px]">{{ $comment->created_at->format('d/m/y \a\t h:i a') }}</td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="mt-5">
            {{ $comments->links() }}
        </div>
    @endif
</div>
