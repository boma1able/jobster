@props([
    'route',
])

<form method="GET" action="{{ $route }}" class="flex flex-wrap">

    <div class="relative flex items-center">
        <x-form.input type="text" name="search" id="search" :value="request('search')" class="font-light pr-10 border rounded" placeholder="Search..." required/>
        <button class="absolute right-1 inline-block rounded-md bg-indigo-600 px-3 py-1 text-sm text-white shadow-xs hover:bg-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0a7.5 7.5 0 1 0-10.6 0 7.5 7.5 0 0 0 10.6 0z"></path>
            </svg>
        </button>
    </div>
    <x-form.error name="search"/>

</form>
