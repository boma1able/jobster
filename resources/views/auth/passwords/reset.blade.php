<x-layout>

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Forgot Password</h2>
        </div>

        <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <div class="space-y-12">
                    <div>

                        <input type="hidden" name="token" value="{{ $token }}">

                        <x-form.field>

                            <x-form.label>Email address</x-form.label>

                            <div class="mt-1">
                                <div class="flex items-center rounded-md bg-white overflow-hidden">
                                    <x-form.input type="email" id="email" name="email" value="{{ $email ?? old('email') }}" required/>
                                </div>
                                <x-form.error name="password"/>
                            </div>

                        </x-form.field>

                        <x-form.field>

                            <x-form.label>New Password</x-form.label>

                            <div class="mt-1">
                                <div class="flex items-center rounded-md bg-white overflow-hidden">
                                    <x-form.input type="password" id="password" name="password" required/>
                                </div>
                                <x-form.error name="password"/>
                            </div>

                        </x-form.field>

                        <x-form.field>

                            <label for="password_confirmation">Confirm Password</label>

                            <div class="mt-1">
                                <div class="flex items-center rounded-md bg-white overflow-hidden">
                                    <x-form.input type="password" id="password_confirmation" name="password_confirmation" required/>
                                </div>
                                <x-form.error name="password"/>
                            </div>

                        </x-form.field>

                    </div>

                </div>

                <div class="mt-6 flex items-center justify-start gap-x-6">
                    <x-form.button class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Reset Password</x-form.button>
                </div>
            </form>

        </div>
    </div>

</x-layout>
