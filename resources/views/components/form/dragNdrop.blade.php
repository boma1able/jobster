@props(['user'])

<div id="avatar-container" class="flex justify-between" @if(!$user->avatar) style="display: none;" @endif>
    <div class="flex w-[100px] h-[100px]">
        <img id="avatar-preview" src="{{ $user->avatar ? asset('storage/' . $user->avatar) : '#' }}"
             alt=""
             class="w-full h-full object-cover rounded-[10px] @if(!$user->avatar) hidden @endif">
    </div>
    <button type="button" onclick="removeImage()" class="text-red-600 hover:text-red-900">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 6H21M19 6V20C19 21.1046 18.1046 22 17 22H7C5.89543 22 5 21.1046 5 20V6M8 6V4C8 2.89543 8.89543 2 10 2H14C15.1046 2 16 2.89543 16 4V6M10 11V17M14 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
</div>

<div id="upload-container" class="col-span-full" @if($user->avatar) style="display: none;" @endif>
    <div id="drop-area" class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10 bg-gray-50 hover:bg-gray-100 transition">
        <input type="file" name="avatar" id="avatar" class="sr-only" accept="image/*" onchange="previewImage(event)">
        <div class="text-center">
            <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
            </svg>
            <div class="mt-4 flex text-sm/6 text-gray-600">
                <label for="avatar" class="relative px-2 cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-indigo-500">
                    <span>Upload a file</span>
                </label>
                <p class="pl-1">or drag and drop</p>
            </div>
            <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
        </div>
    </div>
</div>
