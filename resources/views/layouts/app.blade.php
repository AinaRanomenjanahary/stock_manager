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

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="flex min-h-screen bg-gray-100">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg hidden md:block">

            <div class="h-16 flex items-center justify-center border-b">
                <h1 class="text-xl font-bold text-blue-600">
                    Page administration
                </h1>
            </div>

            <nav class="mt-6">

                <a href="{{ url('/dashboard') }}"
                   class="flex items-center px-6 py-3 hover:bg-blue-50">
                    🏠 <span class="ml-3">Dashboard</span>
                </a>

                <a href="{{ url('/clients') }}"
                   class="flex items-center px-6 py-3 hover:bg-blue-50">
                    👤 <span class="ml-3">Clients</span>
                </a>

                <a href="{{ url('/produits') }}"
                   class="flex items-center px-6 py-3 hover:bg-blue-50">
                    📦 <span class="ml-3">Produits</span>
                </a>

                <a href="{{ url('/stocks') }}"
                   class="flex items-center px-6 py-3 hover:bg-blue-50">
                    🗂️ <span class="ml-3">Stocks</span>
                </a>

            </nav>

        </aside>

        <!-- Zone principale -->
        <div class="flex-1 flex flex-col">

            <!-- Navigation supérieure -->
            @include('layouts.navigation')

            <!-- En-tête de page -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Contenu -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>

        </div>

    </div>
</body>
</html>
