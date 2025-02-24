<div>
    <x-dashboard.welcome />

    <x-dashboard.page-title>
        <x-slot:title>
            Register new user
        </x-slot:title>
    </x-dashboard.page-title>

    <div class="max-w-sm">
        <form wire:submit.prevent="store">

            <x-form.field>

                <x-form.label class="!text-gray-400 !text-xs">Name</x-form.label>

                <input type="text" id="name" wire:model="name" class="border rounded p-2 w-full" />

                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

            </x-form.field>

            <x-form.field>

                <x-form.label class="!text-gray-400 !text-xs">Email</x-form.label>

                <input type="email" id="email" wire:model="email" class="border rounded p-2 w-full" />
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror

            </x-form.field>

            <x-form.field>

                <div class="">
                    <x-form.label class="!text-gray-400 !text-xs">
                        User logo
                    </x-form.label>

                    <div>
                        @if (!$avatar_obj)
                            <div id="upload-container" class="relative col-span-full">
                                <div id="featured-drop-area" class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-5 bg-gray-50 hover:bg-gray-100 transition">
                                    <input type="file" wire:model="avatar_obj" class="absolute top-0 left-0 w-full h-full opacity-0 z-10 cursor-pointer">
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

                        @if ($avatar_obj)
                            <img src="{{ $this->avatar_obj->temporaryUrl() }}" class="text-xs text-gray-500 rounded-lg" alt="Featured Image not set">
                            <button type="button" wire:click="removeImage" class="text-red-600 hover:text-red-900 text-xs mt-2 underline">Remove Image</button>
                        @elseif ($avatar)
                            <div id="featured-container" class="flex flex-wrap justify-between mt-2">
                                <div class="flex w-full h-[150px]">
                                    <img src="{{ asset('storage/avatar/' . $avatar) }}" class="text-xs text-gray-500 rounded-lg" alt="Avatard Image not set">
                                </div>
                                <button type="button" wire:click="removeImage" class="text-red-600 hover:text-red-900 text-xs mt-2 underline">Remove Image</button>
                            </div>
                        @endif
                    </div>
                    @error('avatar_obj')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

            </x-form.field>

            <x-form.field>

                <x-form.label class="!text-gray-400 !text-xs">Role</x-form.label>

                <select wire:model="role" class="block pl-3 w-[100%] bg-white min-w-0 grow py-2.5 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" required>
                    <option value="" selected disabled>Select Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>

                @error('role') <span class="text-red-500">{{ $message }}</span> @enderror

            </x-form.field>

            <x-form.field>

                <x-form.label class="!text-gray-400 !text-xs">Password</x-form.label>

                <input type="password" id="password" wire:model="password" class="border rounded p-2 w-full" />
                @error('password') <span class="text-red-500">{{ $message }}</span> @enderror

            </x-form.field>

            <button class="mt-5 bg-green-500 text-white p-2 rounded">Add user</button>
        </form>
    </div>

</div>
