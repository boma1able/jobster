<div>
    <div class="flex align-center justify-between">

        <a href="/dashboard/jobs/manage" wire:navigate  class="inline-block rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs">Add new</a>

        <div class="relative flex align-center">
            <input
                type="text"
                wire:model.live="query"
                placeholder="Search for a job..."
                class="block min-w-0 grow py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 font-light pr-10 border rounded"
            >
            <button wire:click="resetQuery" class="ml-2 absolute right-3 top-2.5 {{ $query ? 'text-gray-800' : 'text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

    </div>

    @if(!trim('') || $query)

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @forelse($this->results as $result)
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                    <div class="flex flex-wrap w-full h-full">
                        <div class="flex items-center space-x-4 mb-4">
                            <img class="h-14 w-14 rounded-full object-cover" src="{{ asset('storage/company/' . $result->company_logo) }}" alt="{{ $result->company_name }}">

                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-1">
                                    <a href="">{{ $result->title }}</a>
                                </h2>
                                <p class="text-sm text-gray-600">{{ Str::limit($result->description, 90, '...') }}</p>
                                <p class="text-sm text-gray-400 mt-2">{{ $result->company_name }}</p>
                            </div>
                        </div>

                        <div class="flex justify-end mt-auto items-end space-x-2 w-full">
                            <button wire:click.prevent="redirectToEdit({{ $result->id }})" class="text-gray-400 text-xxs">
                                Edit
                            </button>
                            <button wire:click.prevent="delete({{ $result->id }})"  class="text-red-400 text-xxs">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div>Jobs not found!</div>
            @endforelse
        </div>
    @endif

    <div class="mt-6">
        {{ $this->results->links() }}
    </div>

</div>
