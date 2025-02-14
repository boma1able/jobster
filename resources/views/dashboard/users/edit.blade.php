<x-dashboard.layout>

    <x-dashboard.welcome />

    <div class="grid grid-cols-12 gap-10 pt-10">

        <div class="col-span-4">
            <h2 class="text-md">Personal Information</h2>
            <p class="text-xs text-gray-500">Use a permanent address where you can receive mail.</p>
        </div>

        <div class="col-span-6 bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('dashboard.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <x-form.field>

                    <x-form.dragNdrop :user="$user" />

                </x-form.field>


                <x-form.field>

                    <x-form.label for="email" class="!text-gray-400 !text-xs">Full Name</x-form.label>

                    <div class="mt-1">
                        <div class="flex items-center rounded-md bg-gray-50 border-b outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <x-form.input type="text" name="name" id="name" :value="old('name', $user->name)" required/>
                        </div>
                        <x-form.error name="name"/>
                    </div>

                </x-form.field>

                <x-form.field>

                    <x-form.label for="email" class="!text-gray-400 !text-xs">Email address</x-form.label>

                    <div class="mt-1">
                        <div class="flex items-center rounded-md border-b outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <x-form.input type="email" name="email" id="email" :value="old('email', $user->email)" required/>
                        </div>
                        <x-form.error name="email"/>
                    </div>

                </x-form.field>

                @if (auth()->user()?->isAdmin())
                    <x-form.field>

                        <x-form.label class="!text-gray-400 !text-xs">Role</x-form.label>

                        <select name="role" class="block w-[100%] bg-white border-b min-w-0 grow py-2.5 px-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" autocomplete="off" required>
                            <option value="" selected disabled>Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ (old('role', $user->refresh()->roles->first()->id) == $role->id) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>

                    </x-form.field>
                @endif

                <div class="mt-6 flex items-center justify-start gap-x-6">
                    <x-form.button>Update</x-form.button>
                </div>
            </form>
        </div>

    </div>

</x-dashboard.layout>
