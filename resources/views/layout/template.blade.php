<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Video Section')</title>
    <link rel="stylesheet" href="{{ asset('css/videos.css') }}">
</head>
<body>
    <div class="video-container">
        @yield('content')
    </div>
    <script src="{{ asset('js/videos.js') }}"></script>
</body>
</html>
