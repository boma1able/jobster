<x-layout>

    <div class="mx-auto max-w-2xl my-10 lg:mx-0">
        <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">Jobs</h2>
        <p class="mt-2 text-lg/8 text-gray-600">Learn how to grow your business with our expert advice.</p>
    </div>

    <div class="bg-white pb-20">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mx-auto mt-2 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:mt-5 sm:pt-10 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                @forelse($jobs as $job)
                    <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div class="flex flex-wrap w-full h-full">
                            <div class="flex items-center space-x-4 mb-4">
                                <img class="h-14 w-14 rounded-full object-cover" src="{{ asset('storage/company/' . $job->company_logo) }}" alt="{{ $job->company_name }}">

                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800 mb-1">
                                        <a href="{{ route('jobs.show', $job->id) }}">{{ $job->title }}</a>
                                    </h2>
                                    <p class="text-sm text-gray-600">{{ Str::limit($job->description, 90, '...') }}</p>
                                    <p class="text-sm text-gray-400 mt-2">{{ $job->company_name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div>Jobs not found!</div>
                @endforelse
            </div>
        </div>

    </div>

    <div class="pt-10 py-6">
        {{ $jobs->links() }}
    </div>


</x-layout>
