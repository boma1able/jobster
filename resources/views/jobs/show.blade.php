<x-layout>

    <x-breadcrumbs :job="$job"/>

    <div class="bg-white mx-auto w-full max-w-[768px] pb-6 sm:pb-10 rounded-lg overflow-hidden">
        <div>
            <div>
                <div class="w-full h-[250px] mb-4">
                    <img src="{{ asset('storage/media/' . ($job->featured_img ?? 'default-avatar.jpg')) }}" class="w-full h-full object-cover" alt="">
                </div>

                <div class="px-10 pt-8">

                    <h2 class="text-3xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-3xl">{{ $job->title }}</h2>

                </div>

            </div>

        </div>
    </div>


</x-layout>
