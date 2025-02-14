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

    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        var simplemde = new SimpleMDE({ element: document.getElementById("content") });
    </script>

    @if (session('success'))
        <script>
                toastr.options = {
                closeButton: false,
                progressBar: false,
                timeOut: 3000,
                // extendedTimeOut: 1000,
                positionClass: "toast-bottom-right",
                showMethod: "slideDown",
                hideMethod: "slideUp",
                showDuration: 400,
                hideDuration: 400,
                escapeHtml: false,
                preventDuplicates: true,
            };

            toastr.success(`
                <div class="bg-white border border-gray-300 rounded-[8px] px-4 py-4 shadow-lg">
                    <div class="flex">
                        <div class="w-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#05df72" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                            </svg>
                        </div>
                        <div class="mx-3 w-[250px]">
                            <p class="text-gray-800 text-[14px] lh-[20px]">Success!</p>
                            <p class="text-gray-500 text-xs pt-1">{{ session('success') }}</p>
                        </div>
                        <div class="w-5 toast-close">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#99a1af" aria-hidden="true" class="pointer">
                                <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            `, '');
        </script>
    @endif


</div>

</body>
</html>
