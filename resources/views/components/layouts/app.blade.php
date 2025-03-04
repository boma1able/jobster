<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

    @livewireStyles

    @yield('styles')

</head>
<body class="bg-gray-100">
<div class="flex">
    <x-dashboard.sidebar :pending="$pendingCommentsCount"/>

    <div class="ml-64 flex-1 p-6">
        {{ $slot }}
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


</div>
@livewireScripts
@yield('scripts')

<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
</body>
</html>
