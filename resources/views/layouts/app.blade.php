<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="theme-color" content="#2563eb">

        <title>{{ config('app.name', 'AltaByte') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('src/Altabyte.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('src/Altabyte.png') }}">
        <link rel="manifest" href="{{ asset('manifest.json') }}">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-fixed bg-gradient-to-br from-blue-50 to-white dark:from-gray-900 dark:to-gray-800 text-gray-800 dark:text-gray-200">
        <div class="min-h-screen flex flex-col">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-gradient-to-r from-blue-600 to-blue-800 shadow-lg">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center">
                            <div class="text-white text-2xl mr-4">✝️</div>
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="py-8 flex-1">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-gradient-to-r from-white to-blue-50 dark:from-gray-900 dark:to-gray-800 border-t border-gray-200 dark:border-gray-700">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
                        <div class="flex items-center space-x-4">
                            <div class="text-2xl">✝️</div>
                            <div>
                                
                                <div class="text-sm text-gray-500 dark:text-gray-400">AltaByte - Sistema de control de asistencias juveniles</div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">&copy; {{ date('Y') }} • Hecho con fe y cariño</div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
