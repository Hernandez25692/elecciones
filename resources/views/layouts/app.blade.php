<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema Electoral') }}</title>

    <!-- Fuente limpia y moderna -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Fondo institucional Partido Nacional */
        body {
            background: linear-gradient(135deg, #001B3A, #003C84);
            min-height: 100vh;
        }

        /* Tarjetas */
        .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        /* Tarjeta oscura */
        .card-dark {
            background: #0f172a;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .35);
        }

        /* Header superior */
        .pn-header {
            background: #002F6C;
            border-bottom: 4px solid #1E88E5;
            color: #fff;
        }

        /* Títulos */
        .pn-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #ffffff;
        }

        /* Subtítulos */
        .pn-subtitle {
            font-size: 1.1rem;
            color: #E5EFFF;
        }

        /* Contenido general */
        main {
            padding-top: 20px;
        }

        /* Divider */
        .pn-divider {
            height: 2px;
            background: #1E88E5;
            margin: 12px 0;
            border-radius: 5px;
        }
    </style>
</head>

<body class="font-sans">

    <!-- Header Superior PN -->
    <header class="pn-header shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div>
                <h1 class="pn-title">Sistema Electoral - Partido Nacional</h1>
                <p class="pn-subtitle">Control, Registro y Proyección de Actas</p>
            </div>

            {{-- Navegación --}}
            <div class="hidden md:block">
                @include('layouts.navigation')
            </div>
        </div>
    </header>

    <!-- Página -->
    <main class="max-w-7xl mx-auto px-6">
        @isset($header)
            <div class="bg-white/10 backdrop-blur-md shadow rounded p-4 mt-6 mb-4">
                {{ $header }}
            </div>
        @endisset

        {{ $slot }}
    </main>

</body>

</html>
