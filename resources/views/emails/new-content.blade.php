<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Content Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            color: #555;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>New {{ ucfirst($type) }} Available</h1>
    <p>{{ $content->title }}</p>
    <p>Click the link below to read more:</p>
    @php
        $url = ($type == 'post' && isset($content->slug))
            ? route('blog.show', $content->slug)
            : (($type == 'job' && isset($content->id))
                ? route('jobs.show', $content->id)
                : '#');
    @endphp

    <a href="{{ $url }}">
        View {{ ucfirst($type) }}
    </a>
</div>
</body>
</html>
