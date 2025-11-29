<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro — Elecciones Generales 2025</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: linear-gradient(135deg, #001f4d 0%, #003b8b 50%, #002b5c 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.10);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            padding: 35px;
            width: 100%;
            max-width: 520px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 8px 40px rgba(0, 30, 80, 0.5);
            animation: fadeIn 0.8s ease-in-out;
        }

        .logo-pn {
            width: 95px;
            display: block;
            margin: 0 auto 15px;
            filter: drop-shadow(0 0 6px rgba(255, 255, 255, 0.3));
        }

        .title {
            font-size: 1.7rem;
            font-weight: 800;
            text-align: center;
            color: #ffffff;
            text-shadow: 0 0 12px rgba(0, 102, 255, 0.8);
        }

        .subtitle {
            color: #dbeafe;
            text-align: center;
            margin-bottom: 25px;
            font-size: 1rem;
        }

        input,
        select {
            background: rgba(255, 255, 255, 0.12) !important;
            border: 1px solid rgba(255, 255, 255, 0.18) !important;
            color: #fff !important;
        }

        label {
            color: #dbeafe !important;
            font-weight: 500;
        }

        a {
            color: #93c5fd;
        }

        a:hover {
            color: #bfdbfe;
        }

        .btn-register {
            background: linear-gradient(90deg, #1e3a8a, #2563eb);
            border-radius: 8px;
            padding: 10px 0;
            color: white;
            font-weight: 600;
            transition: 0.3s;
            width: 140px;
            text-align: center;
        }

        .btn-register:hover {
            background: linear-gradient(90deg, #2563eb, #1e40af);
            transform: translateY(-2px);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
@php
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        abort(403, 'No tienes permiso para acceder a esta sección.');
    }
@endphp

<body>

    <div class="register-card">

        {{-- Logo Partido Nacional --}}
        <img src="{{ asset('storage/logos/NACIONAL.jpg') }}" alt="Partido Nacional" class="logo-pn">

        <h1 class="title">Registro de Usuarios</h1>
        <p class="subtitle">Sistema de Digitación — Elecciones Generales 2025</p>

        <form method="POST" action="{{ route('register') }}">

            @csrf

            {{-- Nombre --}}
            <div class="mb-4">
                <x-input-label for="name" value="Nombre completo" />
                <x-text-input id="name" type="text" class="block mt-1 w-full" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <x-input-label for="email" value="Correo electrónico" />
                <x-text-input id="email" type="email" class="block mt-1 w-full" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            {{-- Rol --}}
            <div class="mb-4">
                <x-input-label for="role" value="Tipo de usuario" />
                <select id="role" name="role" class="block mt-1 w-full rounded text-white">
                    <option value="digitador">Digitador</option>
                    <option value="admin">Administrador</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-1" />
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <x-input-label for="password" value="Contraseña" />
                <x-text-input id="password" type="password" class="block mt-1 w-full" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            {{-- Confirmar --}}
            <div class="mb-4">
                <x-input-label for="password_confirmation" value="Confirmar contraseña" />
                <x-text-input id="password_confirmation" type="password" class="block mt-1 w-full"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

            {{-- Botones --}}
            <div class="flex justify-between items-center mt-4">
                <a class="text-sm hover:underline" href="{{ route('login') }}">
                    ¿Ya tienes cuenta?
                </a>

                <button type="submit" class="btn-register">
                    Registrar
                </button>
            </div>

        </form>

    </div>

</body>

</html>
