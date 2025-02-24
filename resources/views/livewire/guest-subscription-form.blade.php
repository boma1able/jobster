<div class="py-4">

    <div class="flex mb-2 space-x-2">
        <input type="email" wire:model="email" placeholder="Add email"
               class="border p-2 rounded w-full">
        <button wire:click="subscribe" class="px-4 py-2 bg-blue-500 text-white rounded">
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
