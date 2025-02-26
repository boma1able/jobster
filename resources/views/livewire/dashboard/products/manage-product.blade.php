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

                            ...

                        </div>

                    </x-form.field>

                </div>

            </div>

        </div>
    </form>
</div>
