<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Quiniela') }} - Iniciar Sesión</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        @vite(['resources/css/app.css', 'resources/css/styles.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-dark antialiased bg-light">
        <div class="relative min-h-screen w-full">
            <div class="absolute inset-0 bg-cover bg-center lg:hidden"
                 style="background-image: url({{ asset('images/decoracion/background-sm.png') }});"></div>
            <div class="absolute inset-0 bg-cover bg-center hidden lg:block"
                 style="background-image: url({{ asset('images/decoracion/background.png') }});"></div>

            <div
                class="
                    relative z-10 min-h-screen flex flex-col justify-end items-center
                    lg:justify-center lg:items-center pt-4 lg:p-6
                "
            >
                <div>
                    <img
                        src="/images/logos/logo-white.png"
                        class="w-full max-w-32 2xl:max-w-72 mx-auto mb-4"
                        alt="{{ config('app.name', 'Quiniela') }}"
                    >
                </div>

                <div
                    class="
                        w-full rounded-t-3xl bg-secondary-light p-8
                        lg:max-w-lg lg:rounded-3xl lg:shadow-2xl lg:w-full
                    "
                >
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <x-toast-errors :errors="$errors" />

                    <h1 class="text-3xl text-center font-bold text-dark mb-8">Inicia Sesión</h1>

                    <form
                        method="POST"
                        action="{{ route('login') }}"
                        class="formulario-auth w-full max-w-108 lg:max-w-108 mx-auto"
                    >
                        @csrf

                        <x-login-input
                            label="Correo electrónico"
                            id="email"
                            name="email"
                            type="email"
                            icon="icon-[material-symbols--mail]"
                            placeholder="correo@ejemplo.com"
                            maxlength="255"
                            autocomplete="username"
                            required
                        />

                        <x-login-password-input
                            label="Contraseña"
                            id="password"
                            name="password"
                            icon="icon-[material-symbols--lock]"
                            placeholder="Ingrese su contraseña"
                            autocomplete="current-password"
                            maxlength="255"
                            required
                        />

                        <div class="text-right mb-6">
                            <a
                                href="{{ route('password.request') }}"
                                class="text-primary text-sm font-bold hover:text-secondary transition-color duration-300 ease-in-out"
                            >
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-primary text-light rounded-full px-6 py-3 hover:brightness-110 focus:ring-3 focus:ring-dark flex items-center justify-center gap-2"
                        >
                            <span class="icon-[material-symbols--login] w-5 h-5"></span>
                            Iniciar Sesión
                        </button>
                    </form>

                    <div class="text-center mt-6">
                        <p class="text-zinc-600 text-sm mb-3">¿Aún no tienes cuenta?</p>
                        <a
                            href="{{ route('register') }}"
                            class="w-full inline-flex items-center justify-center border border-primary text-primary font-bold rounded-full px-6 py-2 hover:bg-white transition-colors duration-300 ease-in-out"
                        >
                            Crear cuenta
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
