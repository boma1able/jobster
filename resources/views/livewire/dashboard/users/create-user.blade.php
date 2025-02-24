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
