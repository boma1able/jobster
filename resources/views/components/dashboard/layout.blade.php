<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    @livewireStyles
</head>
<body class="bg-gray-100">
<div class="flex">
    <x-dashboard.sidebar :pending="$pendingCommentsCount"/>

    <div class="ml-64 flex-1 p-6">
        {{ $slot }}
    </div>

    <x-dashboard.modal.modal>

        <x-slot:title>
            Delete!
        </x-slot:title>

        <x-slot:sub>
            Are you sure you want to delete this post? All of your data will be permanently removed. This action cannot be undone.
        </x-slot:sub>

    </x-dashboard.modal.modal>




</div>
@livewireScripts

</body>
</html>
