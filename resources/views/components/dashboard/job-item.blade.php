<div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
    <div>
        <div class="flex items-center space-x-4 mb-4">
            <img class="h-14 w-14 rounded-full object-cover" src="{{ $job->company_logo }}" alt="{{ $job->company_name }}">

            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-1">
                    <a href="">{{ $job->title }}</a>
                </h2>
                <p class="text-sm text-gray-600">{{ Str::limit($job->description, 90, '...') }}</p>
                <p class="text-sm text-gray-400 mt-2">{{ $job->company_name }}</p>
            </div>
        </div>

        <div class="flex justify-end items-end space-x-2">
            <button>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: inline; vertical-align: middle;">
                    <path d="M11 4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V20C2 20.5304 2.21071 21.0391 2.58579 21.4142C2.96086 21.7893 3.46957 22 4 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V13M18.4142 2.58579C18.7893 2.21071 19.2979 2 19.8284 2C20.3589 2 20.8676 2.21071 21.2426 2.58579C21.6177 2.96086 21.8284 3.46957 21.8284 4C21.8284 4.53043 21.6177 5.03914 21.2426 5.41421L12 14.6569L8 15.6569L9 11.6569L18.4142 2.58579Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </div>
</div>
