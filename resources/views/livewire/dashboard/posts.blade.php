<div>
    <x-dashboard.welcome />


    @unless ($isCreating || $isEditing)
        <x-ui-button-link wire:click="create" class="cursor-pointer">Add New</x-ui-button-link>
        <x-dashboard.page-title>
            <x-slot:title>
                <div class="flex justify-between">
                    Posts
                    <x-dashboard.search route="{{ route('dashboard.posts') }}"/>
                </div>
            </x-slot:title>
        </x-dashboard.page-title>
    @endunless

    @if (session()->has('message'))
        <div class="p-2 bg-green-200 text-green-700 rounded mb-2">{{ session('message') }}</div>
    @endif

    <div>
        @if ($isCreating || $isEditing)
            <div class="mb-4">
                <h2 class="text-xl font-bold mb-4">{{ $isEditing ? 'Edit Post' : 'Create Post' }}</h2>
            </div>

            <div class="space-y-12">

                <form wire:submit.prevent="store">
                    <div class="pb-12">

                        <div class="flex gap-6 item-start">
                            <div class="w-9/12 rounded-lg">

                                <x-form.field>

                                    <div class="mt-1">
                                        <div class="flex items-center rounded-md bg-white overflow-hidden">
                                            <x-form.input name="title" id="title" wire:model="title" placeholder="Add title"/>
                                        </div>
                                        @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>
                                    @if ($isEditing)
                                        <div class="mt-2 text-xxs ">
                                            <span class="text-gray-500">View: </span> <a href="{{ url('/blog/' . $slug) }}" class="text-gray-600 underline" target="_blank">{{ url('/blog/' . $slug) }}</a>
                                        </div>
                                    @endif

                                </x-form.field>

                                <x-form.field>

                                    <div class="mt-4">
                                        <textarea name="content" id="content" wire:model="content" rows="6" class="w-full resize-none rounded-md py-1.5 px-3 text-sm overflow-hidden" placeholder="Add content"/></textarea>
                                        @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>

                                </x-form.field>

                            </div>

                            <div class="w-3/12 rounded-lg bg-white p-6 shadow-md">

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
                                                @foreach($categories as $category)
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

                                    <div class="border-b pb-2">

                                        <x-form.label>
                                            Tags
                                        </x-form.label>

                                        <div class="my-4">
                                            <div class="relative flex items-center">
                                                <input type="text" wire:model="tag" id="tags" class="block min-w-0 grow py-1.5 border rounded-md px-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 font-light pr-10" placeholder="Add tag..." />
                                                <button type="button" wire:click="addTag" class="absolute right-1 inline-block rounded-md bg-indigo-600 px-3 py-1 text-sm text-white shadow-xs hover:bg-indigo-500">
                                                    Add
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            @if(count($tags) > 0)
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach($tags as $tag)
                                                        <span class="bg-gray-200 text-gray-800 p-2 text-xs leading-none rounded-full flex items-center">
                                                            {{ $tag }}
                                                            <button type="button" wire:click="removeTag('{{ $tag }}')" class="ml-2 text-red-500 hover:text-red-700">
                                                                ×
                                                            </button>
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>


                                    </div>

                                </x-form.field>

                                <x-form.field>

                                    <div class="">
                                        <x-form.label class="mb-3">
                                            Featured Image
                                        </x-form.label>

                                        <div>
                                            @if ($isCreating || $isEditing)
                                                @if (!$featured_obj && !$featured_img)
                                                    <div id="upload-container" class="relative col-span-full">
                                                        <div id="featured-drop-area" class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-5 bg-gray-50 hover:bg-gray-100 transition">
                                                            <input type="file" wire:model="featured_obj" class="absolute top-0 left-0 w-full h-full opacity-0 z-10 cursor-pointer">
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

                                                @if ($featured_obj)
                                                    <img src="{{ $this->featured_obj->temporaryUrl() }}" class="text-xs text-gray-500 rounded-lg" alt="Featured Image not set">
                                                    <button type="button" wire:click="removeImage" class="text-red-600 hover:text-red-900 text-xs mt-2 underline">Remove Image</button>
                                                @elseif ($featured_img)
                                                    <div id="featured-container" class="flex flex-wrap justify-between mt-2">
                                                        <div class="flex w-full h-[150px]">
                                                            <img src="{{ asset('storage/media/' . $featured_img) }}" class="text-xs text-gray-500 rounded-lg" alt="Featured Image not set">
                                                        </div>
                                                        <button type="button" wire:click="removeImage" class="text-red-600 hover:text-red-900 text-xs mt-2 underline">Remove Image</button>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>

                                    </div>

                                </x-form.field>

                            </div>

                        </div>

                    </div>
                </form>

            </div>

        @else
            <div>

                @if ($posts->count() > 0)
                    <div class="mt-6">
                        <div class="mb-5">
                            {{ $posts->links() }}
                        </div>
                        <div class="overflow-hidden shadow-md rounded-lg">
                            <div class="space-y-4">

                                <div class="overflow-x-auto bg-white">
                                    <table class="min-w-full table-auto">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Author</th>
                                            <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Title</th>
                                            <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Categories</th>
                                            <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Tags</th>
                                            <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase text-center">Comments</th>
                                            <th class="px-4 py-3 text-left text-xxs font-medium text-gray-700 uppercase">Date</th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($posts as $post)
                                                <tr>
                                                    <td class="px-4 py-4 text-xs text-gray-500 min-w-0 w-[150px]">{{ $post->author_name }}</td>
                                                    <td class="px-4 py-4 text-sm text-gray-500 min-w-0 w-[300px]">
                                                        <a href="{{ url('blog') . '/' . $post->slug }}" class="font-semibold hover:underline">{{ $post->title }}</a>
                                                        <span class="flex flex-wrap mt-2 space-x-3">
                                                            <button wire:click="edit({{ $post->id }})" class="text-gray-400 text-xxs">Edit</button>
                                                            <a href="#" wire:click.prevent="confirmDelete({{ $post->id }})" class="text-red-400 text-xxs">Delete</a>
                                                        </span>
                                                    </td>
                                                    <td class="px-4 py-4 text-xxs font-medium text-gray-500 min-w-[107px]">
                                                        {{ $post->categories->pluck('name')->join(', ') }}
                                                    </td>
                                                    <td class="px-4 py-4 text-xxs font-medium text-gray-500 min-w-[107px]">
                                                        {{ $post->tags->pluck('name')->join(', ') }}
                                                    </td>
                                                    <td class="px-4 py-4 text-xxs font-medium text-gray-500">
                                                        <a href="{{ url('blog') . '/' . $post->slug }}" class="flex justify-center relative">
                                                            <span class="absolute top-[4px]">{{ $post->comments->where('approved', true)->count() }}</span>
                                                            <span class="w-[30px]">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" aria-hidden="true" data-slot="icon" class="on bar">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"></path>
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </td>
                                                    <td class="px-4 py-4 text-xxs font-medium text-gray-400 min-w-[107px]">
                                                        {{ $post->created_at->format('d/m/y \a\t h:i a') }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                        <div class="mt-5">
                            {{ $posts->links() }}
                        </div>
                    </div>
                @else
                    <p class="text-gray-500">No posts available.</p>
                @endif

            </div>
        @endif
    </div>
    @if ($showDeleteConfirmation)
        <x-dashboard.modal.delete :title="$modal_title" :sub="$sub" :postToDelete="$postToDelete" :current="$postToDelete"/>
    @endif
</div>
