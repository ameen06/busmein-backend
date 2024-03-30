<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <link rel="shortcut icon" href="https://ik.imagekit.io/k4cixy45r/assets/busmein-logo_S4V_D21jj.png?updatedAt=1706453127454" type="image/x-icon">

        <!-- styles & scripts -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/datatable-custom.css'])
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        <div class="w-full min-h-screen bg-gray-100">
            <x-app-side-bar />

            <x-top-header />

            <!-- Page Content -->
            <div class="px-2 sm:px-4 py-8 lg:ml-80">
                <div class="container mx-auto">
                    @if(Session::has('alert'))
                    <x-alert :alertColor="Session::get('alertColor')" :message="Session::get('message')" />
                    @endif

                    <main class="w-full">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>

        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->
        @stack('scripts')
        <script>
            function dropActions(dropdownId){
                $(".actionsDropdownContent[data-dropdownid='" + dropdownId + "']").toggle();
            }
        </script>
    </body>
</html>
