<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }} - {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="shortcut icon" href="https://ik.imagekit.io/k4cixy45r/assets/busmein-logo_S4V_D21jj.png?updatedAt=1706453127454" type="image/x-icon">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="w-full flex items-start">
            <div class="hidden lg:block min-h-screen w-1/3 p-8 bg-cover bg-no-repeat bg-center" style="background-image: url('https://images.unsplash.com/photo-1479839672679-a46483c0e7c8?q=80&w=3346&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
                <a href="{{ route('home') }}" class="block">
                    <img src="https://ik.imagekit.io/k4cixy45r/assets/busmein-logo_S4V_D21jj.png?updatedAt=1706453127454" alt="AdAgency Logo" class="h-12">
                </a>
            </div>
            <div class="w-full max-w-4xl min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white">
                <div class="w-full sm:max-w-md mt-6 bg-white">
                    <h2 class="text-2xl font-bold text-left">{{ $title }}</h2>

                    <div class="w-full mt-6 px-6 py-4 overflow-hidden sm:rounded-lg border border-gray-300">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
