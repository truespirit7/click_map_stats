<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <main>
    @if(url()->previous() !== url()->current())
    <a style="margin: 10px; margin-left: 30px; background-color: yellow; " href="{{ url()->previous() }}" class="btn btn-info">
        <i class="fas fa-arrow-left"></i> Вернуться назад
    </a>
    @endif
        @yield('content')
    </main>
</body>
</html>