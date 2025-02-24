<div class="py-4">

    <div class="flex mb-2 space-x-2">
        <input type="email" wire:model="email" placeholder="Your email"
               class="border p-2 rounded w-full">
        <button wire:click="subscribe" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Subscribe
        </button>
    </div>

    <div class="flex text-white text-sm space-x-4">
        <label class="block mb-2">
            <input type="checkbox" wire:model="subscribeToPosts"> Subscribe for new posts
        </label>

        <label class="block mb-2">
            <input type="checkbox" wire:model="subscribeToJobs"> Subscribe for new jobs
        </label>
    </div>


</div>
