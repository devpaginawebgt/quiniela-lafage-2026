<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Quiniela') }} - Registro Colaboradores</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        @vite(['resources/css/app.css', 'resources/css/styles.css', 'resources/js/app.js', 'resources/js/views/register.js'])
    </head>
    <body class="font-sans text-dark antialiased bg-light">
        <div class="relative min-h-screen w-full flex flex-col justify-center items-center pt-6">
            <div class="absolute inset-0 bg-cover bg-center lg:hidden"
                 style="background-image: url({{ asset('images/decoracion/background-sm.png') }});"></div>
            <div class="absolute inset-0 bg-cover bg-center hidden lg:block"
                 style="background-image: url({{ asset('images/decoracion/background.png') }});"></div>

            <div class="w-full max-w-2xl z-10">
                {{-- Logo --}}
                <div class="mb-8 px-4">
                    <img
                        src="/images/logos/logo-white.png"
                        class="w-full max-w-40 2xl:max-w-72 mx-auto"
                        alt="{{ config('app.name', 'Quiniela') }}"
                    >
                </div>

                {{-- Title --}}
                <h1 class="text-3xl text-center font-bold text-light mb-8 px-4">Registro de Colaboradores</h1>

                {{-- Toast Errors --}}
                <x-toast-errors :errors="$errors" :message-error="$message_error ?? null" />

                <div class="max-w-xl mx-auto rounded-t-3xl bg-secondary-light p-8
                        lg:max-w-3xl lg:rounded-3xl lg:shadow-3xl lg:w-full">

                    <x-register-lafage-form :lines="$lines" :countries="$countries" :country="$country" />

                    {{-- Login link --}}
                    <div class="text-center mt-6">
                        <p class="text-dark text-sm mb-2">¿Ya tienes cuenta?</p>
                        <a href="{{ route('ingresa') }}" class="text-primary/80 font-bold text-base hover:text-primary">
                            Iniciar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Terms & Conditions Modal --}}
        <x-terms-modal :terms="$terms" />
    </body>
</html>
