<div>
    <x-dashboard.welcome />


    <h2 class="text-2xl font-bold mb-4">
        {{ $isEditing ? 'Edit Product' : 'Add product' }}
    </h2>

    <form wire:submit.prevent="store">
        <div class="pb-12">

            <div class="flex gap-6 item-start">
                <div class="w-9/12 rounded-lg">

                    <x-form.field>

                        <div class="flex w-full space-x-4">
                            <div class="mt-1 w-full">
                                <x-form.label class="text-xs mb-1">
                                    Product name
                                </x-form.label>
                                <div class="flex items-center rounded-md bg-white overflow-hidden">
                                    <x-form.input name="name" id="name" wire:model="name" />
                                </div>
                                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-1 w-full">
                                <x-form.label class="text-xs mb-1">
                                    Price
                                </x-form.label>
                                <div class="flex items-center rounded-md bg-white overflow-hidden">
                                    <x-form.input name="price" id="price" wire:model="price"/>
                                </div>
                                @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    </x-form.field>

                    <x-form.field>

                        <div class="mt-4">
                            <x-form.label class="text-xs mb-1">
                                Description
                            </x-form.label>
                            <textarea name="description" id="description" wire:model="description" rows="6" class="w-full resize-none rounded-md py-1.5 px-3 text-sm overflow-hidden"/></textarea>
                            @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                    </x-form.field>

                </div>

                <div class="w-3/12 rounded-lg bg-white p-6 shadow-sm">

                    <div class="mb-6 flex items-center justify-between gap-x-6">
                        <x-form.button type="submit">{{ $isEditing ? 'Update' : 'Create' }}</x-form.button>
                        <button type="button" wire:click="cancel" class="text-xs">Cancel</button>
                    </div>

                    <x-form.field>

                        <div class="border-b">
                            <x-form.label>
                                Categories
                            </x-form.label>

                            <div class="space-y-2">
                                <div class="max-h-48 overflow-y-auto p-3">
                                    @foreach($product_categories as $category)
                                        <div class="form-check flex align-center mt-2">
                                            <input type="checkbox"
                                                   class="form-check-input"
                                                   wire:model="selectedCategories"
                                                   value="{{ $category->id }}">
                                            <label class="form-check-label text-xs ml-1">{{ $category->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <x-form.error name="selectedCategories"/>
                        </div>

                    </x-form.field>

                    <x-form.field>

                        <div class="">
                            <x-form.label class="mb-3">
                                Product Image
                            </x-form.label>

                            <div>
                                @if (!$product_obj_img && !$product_img)
                                    <div id="upload-container" class="relative col-span-full">
                                        <div id="featured-drop-area" class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-5 bg-gray-50 hover:bg-gray-100 transition">
                                            <input type="file" wire:model="product_obj_img" class="absolute top-0 left-0 w-full h-full opacity-0 z-10 cursor-pointer">
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

                                @if ($product_obj_img)
                                    <img src="{{ $this->product_obj_img->temporaryUrl() }}" class="text-xs text-gray-500 rounded-lg" alt="Product Image not set">
                                    <button type="button" wire:click="removeImage" class="text-red-600 hover:text-red-900 text-xs mt-2 underline">Remove Image</button>
                                @elseif ($product_img)
                                    <div id="featured-container" class="flex flex-wrap justify-between mt-2">
                                        <div class="flex w-full h-[150px]">
                                            <img src="{{ asset('storage/products/' . $product_img) }}" class="text-xs text-gray-500 rounded-lg" alt="Product Image not set">
                                        </div>
                                        <button type="button" wire:click="removeImage" class="text-red-600 hover:text-red-900 text-xs mt-2 underline">Remove Image</button>
                                    </div>
                                @endif
                            </div>
                            @error($product_obj_img)
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror

                        </div>

                    </x-form.field>

                </div>

            </div>

        </div>
    </form>
</div>
