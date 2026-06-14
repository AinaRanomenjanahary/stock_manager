<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-3xl text-center px-6">

        <!-- HEADER LOGIN -->
        <!-- HEADER LOGIN -->
        <div class="flex justify-center mb-6 gap-4 flex-wrap">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                    class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                    class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-800">
                        Se connecter
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                        class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                            S'inscrire
                        </a>
                    @endif
                @endauth
            @endif
        </div>

        <!-- HERO -->
        <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">
            Bienvenue sur votre application
        </h1>

        <h2 class="text-2xl font-semibold text-blue-500 mb-4">
            Gestion des produits
        </h2>

        <p class="text-gray-600 dark:text-gray-300 mb-8">
            Gérez facilement vos produits, clients et stocks depuis un tableau de bord simple,
            rapide et moderne.
        </p>

        <!-- CTA -->
        @auth
            <a href="{{ url('/dashboard') }}"
               class="inline-block px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow">
                Accéder au tableau de bord
            </a>
        @else
            <a href="{{ route('login') }}"
               class="inline-block px-8 py-3 bg-amber-600 text-white rounded-lg hover:bg-cyan-600 transition shadow">
                Commencer
            </a>
        @endauth

        <!-- FOOTER NOTE -->
        <p class="text-sm text-gray-400 mt-10">
            © {{ date('Y') }} {{ config('app.name') }} by Fiainana
        </p>

    </div>

</body>
</html>
