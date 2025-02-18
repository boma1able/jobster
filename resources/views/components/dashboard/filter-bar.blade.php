<div class="flex space-x-4 text-xs text-gray-600">

    <a href="{{ url('/dashboard/comments') }}"
       wire:navigate
       class="border-r border-gray-400 pr-4 {{ request()->fullUrl() == url('dashboard/comments') ? 'text-blue-700' : '' }}">All ({{ App\Models\Comment::count() }})</a>
    <a href="{{ url('/dashboard/comments?user_comments=' . $user->id) }}"
       wire:navigate
       class="border-r border-gray-400 pr-4 {{ request()->fullUrl() == url('/dashboard/comments?user_comments=' . $user->id) ? 'text-blue-700' : '' }}">Mine ({{ App\Models\Comment::where('user_id', auth()->id())->count() }})</a>
    <a href="{{ url('/dashboard/comments?pending') }}"
       wire:navigate
       class="border-r border-gray-400 pr-4 {{ request()->has('pending') ? 'text-blue-700' : '' }}">Pending ({{ $pendingCommentsCount }})</a>
    <a href="{{ url('/dashboard/comments?approved') }}"
       wire:navigate
       class="{{ request()->has('approved') ? 'text-blue-700' : '' }}">Approved ({{ $approvedCommentsCount }})</a>

</div>
