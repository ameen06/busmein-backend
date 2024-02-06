<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Interior</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <main class="w-full h-screen p-8">
            <img src="https://www.adagency.design/images/icon/ad_logo_.png" alt="AdAgency Logo" class="w-20 h-20">
            <div class="w-full h-4/5 flex items-center justify-center">
                <h1 class="text-4xl xl:text-5xl font-semibold text-gray-900">Interior Module</h1>
            </div>
        </main>
    </body>
</html>
