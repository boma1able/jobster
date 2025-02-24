<x-layout>

    <x-breadcrumbs :job="$job"/>

    <div class="bg-white mx-auto w-full max-w-[768px] pb-6 sm:pb-10 rounded-lg overflow-hidden">
        <div>
            <div>

                <div class="px-10 pt-8">

                    <h2 class="text-3xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-3xl">{{ $job->title }}</h2>

                </div>

            </div>

        </div>
    </div>


</x-layout>
