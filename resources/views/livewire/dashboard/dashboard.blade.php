<div>

    <div class="flex mt-[60px]">
        <div class="w-[50px] h-[50px] rounded-full overflow-hidden mr-6 flex-shrink-0">
            <img
                src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('/storage/default-avatar.jpg') }}"
                class="w-full h-full object-cover"
                alt="avatar">
        </div>
        <div class="flex flex-wrap">
            <h2 class="block w-full text-[32px] leading-[36px] mb-1 text-gray-700">Good day, {{ Auth::user()->name }}</h2>
            <span class="text-xxs text-gray-400">
                @php
                    use Carbon\Carbon;
                    echo $today = Carbon::now()->format('jS F Y');
                @endphp
            </span>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6 my-10">

        <div class="bg-white p-6 rounded-lg shadow-md items-center">
            <h3 class="text-gray-600 font-light text-sm">Total Posts</h3>
            <a href="/dashboard/posts" wire:navigate class="text-blue-700 text-[46px] font-thin leading-tight">{{ $posts->count() }}</a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md items-center">
            <h3 class="text-gray-600 font-light text-sm">Total Jobs</h3>
            <a href="/dashboard/jobs" wire:navigate class="text-blue-700 text-[46px] font-thin leading-tight">{{ $jobs->count() }}</a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md items-center">
            <h3 class="text-gray-600 font-light text-sm">Total Users</h3>
            <a href="/dashboard/users" wire:navigate class="text-blue-700 text-[46px] font-thin leading-tight">{{ $users->count() }}</a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md items-center">
            <h3 class="text-gray-600 font-light text-sm mb-6">Recent Comments</h3>
            <div class="flex flex-wrap">
                @foreach($comments as $comment)

                    <div class="flex mb-5 w-full last:mb-0">

                        <div class="w-[30px] h-[30px] rounded-full overflow-hidden mr-3 flex-shrink-0">
                            <img
                                src="{{ $comment->user->avatar ? asset('storage/' . $comment->user->avatar) : asset('/storage/default-avatar.jpg') }}"
                                class="w-full h-full object-cover"
                                alt="img">
                        </div>

                        <div>
                            <div class="flex flex-wrap text-gray-500 font-light text-xs mb-2 font-semibold">
                                <div class="block w-full">{{ $comment->user->name }}</div>
                                <span class="text-gray-400 text-xxs font-light">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-400 font-light text-xxs">{{ Str::limit($comment->content, 70, '...') }}</p>
                        </div>

                    </div>

                @endforeach

                <div class="flex w-full justify-center">
                    <a href="/dashboard/comments" wire:navigate class="text-[10px] text-blue-500 underline font-light">Check all</a>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md items-center h-[max-content]">

            <div>
                <canvas id="myChart"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                        datasets: [{
                            label: '# of Votes',
                            data: [12, 19, 3, 5, 2, 3],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>

        </div>

        <div class="bg-white p-6 rounded-lg shadow-md items-center h-[max-content]">
            <h3 class="text-gray-600 font-light text-sm">Total post views</h3>
            <a href="/dashboard/posts" wire:navigate class="text-blue-700 text-[46px] font-thin leading-tight">{{ $totalViews }}</a>
        </div>

    </div>

</div>
