<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
    <div class="bg-black">
        <div class="flex py-1 pl-4">
            <a href="/">
                <x-application-logo width="15" class="fill-current text-gray-500" />
            </a>
        </div>
    </div>
        <div class="min-h-screen flex flex-col justify-center items-center sm:pt-0 bg-white">
            <div class="items-center justify-center">
                <x-application-logo width="60" class="fill-current" />
            </div>
            <div class="items-center justify-center text-4xl font-bold">
                Login
            </div>

            <div class="w-full max-w-md mt-6 p-8 bg-black shadow-md overflow-hidden">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
