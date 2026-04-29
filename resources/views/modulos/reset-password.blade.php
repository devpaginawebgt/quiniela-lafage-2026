<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Quiniela') }} - Nueva contraseña</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    @vite(['resources/css/app.css', 'resources/css/styles.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-dark antialiased bg-light">
    {{-- Full screen background --}}
    <div class="relative min-h-screen w-full">
        {{-- Background: main-bg hasta lg, bg-main-web desde lg --}}
        <div class="absolute inset-0 bg-cover bg-center lg:hidden"
            style="background-image: url({{ asset('images/decoracion/background-sm.png') }});"></div>
        <div class="absolute inset-0 bg-cover bg-center hidden lg:block"
            style="background-image: url({{ asset('images/decoracion/background.png') }});"></div>

        {{-- Mobile: bottom drawer / lg+: centered modal --}}
        <div
            class="
                relative z-10 min-h-screen flex flex-col justify-end items-center
                lg:justify-center lg:items-center lg:p-6
            "
        >
            <div>
                {{-- Logo --}}
                <div>
                    <img
                        src="/images/logos/logo-white.png"
                        class="w-full max-w-40 2xl:max-w-72 mx-auto mb-12"
                        alt="{{ config('app.name', 'Quiniela') }}"
                    >
                </div>

                {{-- Title --}}
                <h1 class="text-3xl text-center font-bold text-light mb-8">Nueva contraseña</h1>
            </div>

            {{-- Drawer / Modal panel --}}
            <div
                class="
                    w-full rounded-t-3xl bg-secondary-light p-8
                    lg:max-w-lg lg:rounded-3xl lg:shadow-2xl lg:w-full
                "
            >
                {{-- Session Status --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                {{-- Toast Errors --}}
                <x-toast-errors :errors="$errors" />

                {{-- Texto introductorio --}}
                <p class="text-dark text-sm text-center mb-6">
                    Crea una nueva contraseña para tu cuenta.
                </p>

                {{-- Form --}}
                <form
                    method="POST"
                    action="{{ route('password.update') }}"
                    class="formulario-auth w-full max-w-108 lg:max-w-108 mx-auto"
                >
                    @csrf

                    {{-- Token y email vienen de la URL del correo --}}
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <input type="hidden" name="email" value="{{ $request->email }}">

                    <x-login-password-input
                        label="Nueva contraseña"
                        id="password"
                        name="password"
                        icon="icon-[material-symbols--lock]"
                        placeholder="Ingresa tu nueva contraseña"
                        autocomplete="new-password"
                        minlength="4"
                        maxlength="50"
                        autofocus
                        required
                    />

                    <x-login-password-input
                        label="Confirma la contraseña"
                        id="password_confirmation"
                        name="password_confirmation"
                        icon="icon-[material-symbols--lock]"
                        placeholder="Repite la contraseña"
                        autocomplete="new-password"
                        minlength="4"
                        maxlength="50"
                        required
                    />

                    <button
                        type="submit"
                        class="w-full bg-primary text-light rounded-full px-6 py-3 hover:brightness-110 focus:ring-3 focus:ring-dark flex items-center justify-center gap-2"
                    >
                        <span class="icon-[material-symbols--lock-reset] w-5 h-5"></span>
                        Restablecer contraseña
                    </button>
                </form>

                {{-- Volver al login --}}
                <div class="text-center mt-8">
                    <a href="{{ route('ingresa') }}" class="text-primary/80 font-semibold text-base hover:text-primary">
                        Volver a iniciar sesión
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
