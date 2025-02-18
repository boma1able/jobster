<x-layout>

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
        </div>

        <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">

            <form method="POST" action="/login">
                @csrf

                <div class="space-y-12">
                    <div class="pb-4">

                        <x-form.field>

                            <x-form.label for="email">Email address</x-form.label>

                            <div class="mt-1">
                                <div class="flex items-center rounded-md overflow-hidden bg-white">
                                    <x-form.input type="email" name="email" id="email" :value="old('email')" required/>
                                </div>
                                <x-form.error name="email"/>
                            </div>

                        </x-form.field>

                        <x-form.field>

                            <div class="flex items-center justify-between">
                                <x-form.label for="password">Password</x-form.label>
                                <div class="text-sm">
                                    <a href="/forgot-password" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                                </div>
                            </div>

                            <div class="mt-1">
                                <div class="flex items-center rounded-md overflow-hidden bg-white">
                                    <x-form.input type="password" name="password" id="password" required/>
                                </div>
                                <x-form.error name="password"/>
                            </div>

                        </x-form.field>

                    </div>


                </div>

                <div class="mt-6 flex items-center justify-start gap-x-6">
                    <x-form.button class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Login</x-form.button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm/6 text-gray-500">
                Not a member?
                <a href="/register" class="font-semibold text-indigo-600 hover:text-indigo-500">Register</a>
            </p>
        </div>
    </div>



</x-layout>
