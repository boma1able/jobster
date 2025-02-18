<x-layout>

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Forgot Password</h2>
        </div>

        <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">

            @if (session('status'))
                <div class="text-center pb-3">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="space-y-12">
                    <div>
                        <x-form.label>Email address</x-form.label>

                        <div class="mt-1">
                            <div class="flex items-center rounded-md bg-white overflow-hidden">
                                <x-form.input type="email" id="email" name="email" value="{{ old('email') }}" required/>
                            </div>
                            <x-form.error name="email"/>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-start gap-x-6">
                    <x-form.button class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Send Password Reset Link</x-form.button>
                </div>
            </form>
        </div>
    </div>



</x-layout>
