<div class="w-2/5 bg-gray-100 rounded-lg p-4">
    <h2 class="text-2xl font-bold mb-4">
        {{ $isEditing ? 'Edit job' : 'Add new' }}
    </h2>

    <form wire:submit.prevent="store">
        <x-form.field>
            <x-form.label class="text-xs">
                Job title
            </x-form.label>
            <input type="text" wire:model="title" class="w-full mt-1 p-2 border rounded mb-2">
            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </x-form.field>

        <x-form.field>
            <x-form.label class="text-xs">
                Company name
            </x-form.label>
            <input type="text" wire:model="company_name" class="w-full mt-1 p-2 border rounded mb-2">
            @error('company_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </x-form.field>

        <x-form.field>

            <div class="">
                <x-form.label class="mb-3">
                    Company logo
                </x-form.label>

                <div>
                    @if (!$logo_obj && !$company_logo)
                        <div id="upload-container" class="relative col-span-full">
                            <div id="featured-drop-area" class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-5 bg-gray-50 hover:bg-gray-100 transition">
                                <input type="file" wire:model="logo_obj" class="absolute top-0 left-0 w-full h-full opacity-0 z-10 cursor-pointer">
                                <div class="text-center">
                                    <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                                    </svg>
                                    <div class="flex flex-wrap justify-center my-4 flex text-sm/6 text-gray-600">
                                        <div class="relative px-2 cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-indigo-500">
                                            <span>Upload a file</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($logo_obj)
                        <img src="{{ $this->logo_obj->temporaryUrl() }}" class="text-xs text-gray-500 rounded-lg" alt="Featured Image not set">
                        <button type="button" wire:click="removeImage" class="text-red-600 hover:text-red-900 text-xs mt-2 underline">Remove Image</button>
                    @elseif ($company_logo)
                        <div id="featured-container" class="flex flex-wrap justify-between mt-2">
                            <div class="flex w-full h-[150px]">
                                <img src="{{ asset('storage/company/' . $company_logo) }}" class="text-xs text-gray-500 rounded-lg" alt="Featured Image not set">
                            </div>
                            <button type="button" wire:click="removeImage" class="text-red-600 hover:text-red-900 text-xs mt-2 underline">Remove Image</button>
                        </div>
                    @endif
                </div>
                @error('logo_obj')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

        </x-form.field>

        <x-form.field>
            <x-form.label class="text-xs">
                Description
            </x-form.label>
            <textarea wire:model="description" rows="5" class="mt-1 p-2 border rounded w-full resize-none"></textarea>
            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </x-form.field>

        <livewire:quill-text-editor
            wire:model.live="description"
            theme="bubble" />

        <div class="mt-6 flex items-center">
            <x-form.button type="submit" class="{{ $isEditing ? 'bg-green-500 hover:bg-green-400' : '' }}">
                {{ $isEditing ? 'Update' : 'Add new' }}
            </x-form.button>

            <button type="button" wire:click="create" class="ml-4 text-sm text-gray-600">Cancel</button>
        </div>
    </form>
</div>


