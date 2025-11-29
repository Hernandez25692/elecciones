<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso — Elecciones Generales 2025</title>

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

        .login-card {
            background: rgba(255, 255, 255, 0.10);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            padding: 35px;
            width: 100%;
            max-width: 480px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 8px 40px rgba(0, 30, 80, 0.5);
            animation: fadeIn 0.8s ease-in-out;
        }

        .logo-pn {
            width: 95px;
            margin: 0 auto 20px;
            display: block;
            filter: drop-shadow(0 0 6px rgba(255, 255, 255, 0.3));
        }

        .title {
            font-size: 1.8rem;
            font-weight: 800;
            text-align: center;
            color: #ffffff;
            text-shadow: 0 0 8px rgba(0, 102, 255, 0.8);
        }

        .subtitle {
            font-size: 1rem;
            text-align: center;
            color: #dbeafe;
            margin-bottom: 25px;
        }

        .btn-login {
            background: linear-gradient(90deg, #1e3a8a, #2563eb);
            border-radius: 8px;
            padding: 10px 0;
            color: white;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: linear-gradient(90deg, #2563eb, #1e40af);
            transform: translateY(-2px);
        }

        input {
            background: rgba(255, 255, 255, 0.12) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
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

<body>

    <div class="login-card">

        {{-- LOGO PARTIDO NACIONAL --}}
        <img src="{{ asset('storage/logos/NACIONAL.jpg') }}" alt="Partido Nacional" class="logo-pn">

        <h1 class="title">Elecciones Generales 2025</h1>
        <p class="subtitle">Sistema de Digitación y Control de Actas</p>

        <!-- Mensajes de sesión -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" value="Correo electrónico" />
                <x-text-input id="email" type="email" class="block mt-1 w-full" name="email" :value="old('email')"
                    required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" value="Contraseña" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Remember me -->
            <div class="block mb-4 text-gray-200">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-500 bg-white/10"
                        name="remember">
                    <span class="ml-2 text-sm">Recordarme</span>
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between">

                @if (Route::has('password.request'))
                    <a class="text-sm hover:underline" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

                <button class="btn-login w-32 text-center">
                    Ingresar
                </button>

            </div>

        </form>
    </div>

</body>

</html>
