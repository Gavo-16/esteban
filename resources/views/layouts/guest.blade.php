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

        <title>{{ config('app.name', 'AltaByte') }} - Inicio de Sesión</title>
        <link rel="icon" type="image/png" href="{{ asset('src/Altabyte.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('src/Altabyte.png') }}">
        <link rel="manifest" href="{{ asset('manifest.json') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            <!-- Background decorations -->
            <div class="absolute top-20 left-20 w-72 h-72 bg-blue-400/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-400/10 rounded-full blur-3xl"></div>

            <!-- Logo and branding -->
            <div class="mb-8 text-center animate-fade-in">
                <a href="/" wire:navigate class="inline-flex items-center space-x-4 mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-xl transform hover:scale-110 transition-transform duration-300">
                        <span class="text-white text-3xl">🙏</span>
                    </div>
                    <div class="text-left">
                        <h1 class="text-3xl font-bold text-high-contrast" style="font-family: 'Playfair Display', serif;">{{ config('app.name', 'AltaByte') }}</h1>
                        <p class="text-sm text-medium-contrast">Sistema de Asistencias Juveniles</p>
                    </div>
                </a>
            </div>

            <!-- Content card -->
            <div class="w-full sm:max-w-md relative z-10 animate-fade-in-delayed" style="animation-delay: 0.2s;">
                <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm shadow-2xl overflow-hidden rounded-3xl border border-gray-200 dark:border-gray-700">
                    <div class="px-8 py-10">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center text-sm text-gray-600 dark:text-gray-400 animate-fade-in-delayed" style="animation-delay: 0.4s;">
                <p>&copy; {{ date('Y') }} AltaByte • Hecho con fe y cariño</p>
            </div>
        </div>
    </body>
</html>
