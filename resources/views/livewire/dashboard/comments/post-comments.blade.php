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
                                {{ $comment->user ? $comment->user->name : 'Blog Author' }}
                            </h3>
                            <span class="text-xxs text-gray-500">
                                    {{ $comment->created_at->diffForHumans() }}
                                </span>
                        </div>
                        <p class="text-[14px]">{{ $comment->content }}</p>
                        <livewire:comment-likes :comment="$comment" />
                    </div>
                </div>
            @endif
        @endforeach


    </div>

    @auth
        @if ($successMessage && !auth()->user()->isAdmin())
            <div class="text-green-500 text-xs mt-4 text-center">
                {{ $successMessage }}
            </div>
        @endif
        <div class="flex mt-10 bg-transparent">


            <div class="w-10 h-10 overflow-hidden rounded-full mr-5 border border-gray-200 hover:border-gray-300">
                <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('/storage/default-avatar.jpg') }}" alt="User Avatar"
                     class="w-full h-full object-cover">
            </div>

            <div class="flex-1 w-full border rounded-lg space-x-4 overflow-hidden bg-[#F6F8FC5C]">
                <form wire:submit.prevent="submitComment" class="w-full bg-transparent">
                    <div class="flex items-center rounded-md">
                        <textarea wire:model="content" placeholder="Add your comment..." class="w-full resize-none p-3 text-sm outline-none bg-transparent"></textarea>
                    </div>
                    @error('content') <span class="text-red-500">{{ $message }}</span> @enderror

                    <div class="flex items-center justify-end pr-3 pb-3">
                        <button type="submit" class="flex justify-center text-gray-500 rounded-md px-3 py-1.5 text-sm/6 font-semibold bg-white text-black shadow-xs border hover:bg-gray-200">
                            Add Comment
                        </button>
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
