<x-dashboard.layout>
        <x-dashboard.welcome />

        <x-dashboard.page-title>
            <x-slot:title>
                Register new user
            </x-slot:title>
        </x-dashboard.page-title>

        <div class="grid grid-cols-5 sm:grid-cols-3">
            <form method="POST" action="{{ route('dashboard.users.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">

                        <x-form.field>

                            <x-form.label>Name</x-form.label>

                            <div class="mt-1">
                                <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                    <x-form.input name="name" id="name" :value="old('name')"/>
                                </div>
                                <x-form.error name="name"/>
                            </div>

                        </x-form.field>

                        <x-form.field>

                            <x-form.label>Email</x-form.label>

                            <div class="mt-1">
                                <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                    <x-form.input type="email" name="email" id="email" :value="old('email')" required/>
                                </div>
                                <x-form.error name="email"/>
                            </div>

                        </x-form.field>

                        <x-form.field>

                            <x-form.label>Role</x-form.label>

                            <select name="role" class="block pl-3 w-[100%] bg-white min-w-0 grow py-2.5 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" required>
                                <option value="" selected disabled>Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>

                            <x-form.error name="role"/>

                        </x-form.field>

                        <x-form.field>

                            <x-form.label>Password</x-form.label>

                            <div class="mt-1">
                                <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                    <x-form.input type="password" name="password" id="password" required/>
                                </div>
                                <x-form.error name="password"/>
                            </div>

                        </x-form.field>

                        <x-form.field>

                            <x-form.label>Password Confirm</x-form.label>

                            <div class="mt-1">
                                <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                    <x-form.input type="password" name="password_confirmation" id="password_confirmation" required/>
                                </div>
                                <x-form.error name="password_confirmation"/>
                            </div>

                        </x-form.field>

                    </div>


                </div>

                <div class="mt-6 flex items-center justify-start gap-x-6">
                    <x-form.button>Register User</x-form.button>
                </div>
            </form>
        </div>

</x-dashboard.layout>




