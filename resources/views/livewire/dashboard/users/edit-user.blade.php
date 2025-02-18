<div>

    <x-dashboard.welcome />

    <div class="max-w-sm">
        <h2 class="text-xl mb-2">Update user</h2>

        <form wire:submit.prevent="save">

            <x-form.field>

                <x-form.label for="email" class="!text-gray-400 !text-xs">Full Name</x-form.label>

                <div class="mt-1">
                    <div class="flex items-center rounded-md bg-gray-50 border-b outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <x-form.input type="text" wire:model="name" id="name" required/>
                    </div>
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

            </x-form.field>

            <x-form.field>

                <x-form.label for="email" class="!text-gray-400 !text-xs">Your Name</x-form.label>

                <div class="mt-1">
                    <div class="flex items-center rounded-md bg-gray-50 border-b outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <x-form.input type="email" wire:model="email" id="email" required/>
                    </div>
                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

            </x-form.field>

            @if (auth()->user()?->isAdmin())
                <x-form.field>
                    <x-form.label class="!text-gray-400 !text-xs">Role</x-form.label>

                    <select wire:model="role" class="block w-[100%] bg-white border-b min-w-0 grow py-2.5 px-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" required>
                        <option value="" selected disabled>Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </x-form.field>
            @endif

            <button class="mt-5 bg-green-500 text-white p-2 rounded">Update</button>
        </form>
    </div>

</div>
