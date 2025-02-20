<x-dashboard.layout>

    <x-dashboard.welcome />

    <x-dashboard.page-title>
        <x-slot:title>
            Edit Post
        </x-slot:title>
    </x-dashboard.page-title>

    <form method="POST" action="{{ route('dashboard.posts.update', $post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-12">
            <div class="pb-12">

                <div class="flex gap-6 item-start">

                    <div class="w-9/12 rounded-lg">

                        <x-form.field>

                            <div class="mt-1">
                                <div class="flex items-center pl-3 rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                    <x-form.input name="title" id="title" :value="old('title', $post->title)" class="post-title"/>
                                </div>
                                <x-form.error name="title"/>
                            </div>

                            <div class="flex text-xs mt-3">
                                <p class="pr-1">View Post:</p><a href="{{ config('app.url') . '/blog/' . $post->slug }}" class="underline">{{ config('app.url') . '/blog/' . $post->slug }}</a>
                            </div>

                        </x-form.field>

                        <x-form.field>

                            <div class="mt-4">
                                <textarea name="content" id="content" class="resize-none w-full outline-none">{{ old('content', $post->content) }}</textarea>
                                <x-form.error name="content"/>
                            </div>

                        </x-form.field>

                    </div>

                    <div class="w-3/12 rounded-lg bg-white p-6 shadow-md">

                        <div class="mb-6 flex items-center justify-between gap-x-6">
                            <x-form.button>Update</x-form.button>
                            <button form="deletepost" class="text-xs text-red-500">Delete</button>
                        </div>

                        <x-form.field>
                            <div class="border-b">

                                <x-form.label>
                                    Categories
                                </x-form.label>

                                <select name="categories[]" id="categories" class="select2 form-control w-full px-3" multiple size="5">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                @if(in_array($category->id, $post->categories->pluck('id')->toArray())) selected @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <x-form.error name="categories"/>
                            </div>

                        </x-form.field>

                        <x-form.field>

                            <div class="border-b">
                                <x-form.label>
                                    Tags
                                </x-form.label>

                                <input type="text" id="tagInput" class="block w-full min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="Add any tag and press 'Enter'">
                                <div id="tagsContainer">
                                    @foreach($post->tags as $tag)
                                        <span class="tag" data-name="{{ $tag->name }}">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                                <input type="hidden" name="tags" id="tagsField">
                            </div>

                        </x-form.field>

                        <x-form.field>

                            <div class="">
                                <x-form.label>
                                    Featured Image
                                </x-form.label>

                                <div id="featured-container" class="flex flex-wrap justify-between mt-2" @if(!$post->featured_img) style="display: none;" @endif>
                                    <div class="flex w-full h-[150px]">
                                        <img id="featured-preview" src="{{ $post->featured_img ? asset('storage/' . $post->featured_img) : '#' }}"
                                             alt=""
                                             class="w-full h-full object-cover @if(!$post->featured_img) hidden @endif">
                                    </div>
                                    <button type="button" onclick="removeImage()" class="text-red-600 hover:text-red-900 text-xs mt-2 underline">
                                        Remove image
                                    </button>
                                </div>

                                <input type="hidden" name="remove_featured_img" id="remove_featured_img">

                                <div id="upload-container" class="col-span-full" @if($post->featured_img) style="display: none;" @endif>
                                    <div id="featured-drop-area" class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-5 bg-gray-50 hover:bg-gray-100 transition">
                                        <input type="file" name="featured_img" id="featured_img" class="sr-only" accept="image/*" onchange="previewImage(event)">
                                        <div class="text-center">
                                            <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                                            </svg>
                                            <div class="flex flex-wrap justify-center my-4 flex text-sm/6 text-gray-600">
                                                <label for="featured_img" class="relative px-2 cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-indigo-500">
                                                    <span>Upload a file</span>
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </x-form.field>

                    </div>


                </div>

            </div>

        </div>

    </form>

    <form method="POST" action="{{ route('dashboard.posts.destroy', $post->id) }}" id="deletepost" hidden="">
        @csrf
        @method('DELETE')
    </form>

</x-dashboard.layout>

