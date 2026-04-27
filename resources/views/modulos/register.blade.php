<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Quiniela') }} - Registro</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        @vite(['resources/css/app.css', 'resources/css/styles.css', 'resources/js/app.js', 'resources/js/views/register.js'])
    </head>
    <body class="font-sans text-dark antialiased bg-light">
        <div class="relative min-h-screen w-full flex flex-col justify-center items-center pt-6">
            <div class="absolute inset-0 bg-cover bg-center lg:hidden"
                 style="background-image: url({{ asset('images/decoracion/background-sm.png') }});"></div>
            <div class="absolute inset-0 bg-cover bg-center hidden lg:block"
                 style="background-image: url({{ asset('images/decoracion/background.png') }});"></div>
            {{-- Overlay oscuro --}}
            {{-- <div class="absolute inset-0 bg-black"></div> --}}

            <div class="w-full max-w-2xl z-10">
                {{-- Logo --}}
                <div class="mb-8">
                    <img
                        src="/images/logos/logo-white.png"
                        class="w-full max-w-40 2xl:max-w-72 mx-auto"
                        alt="{{ config('app.name', 'Quiniela') }}"
                    >
                </div>

                {{-- Title --}}
                <h1 class="text-3xl text-center font-bold text-light mb-8">Crear cuenta</h1>                    

                {{-- Toast Errors --}}
                <x-toast-errors :errors="$errors" :message-error="$message_error ?? null" />

                {{-- Tabs pills --}}
                <div class="max-w-xl mx-auto rounded-t-3xl bg-secondary-light p-8
                        lg:max-w-3xl lg:rounded-3xl lg:shadow-3xl lg:w-full">
                    <ul
                        class="flex text-base font-medium text-center bg-complementary-primary rounded-full mb-8"
                        id="register-tab"
                        data-tabs-toggle="#register-tab-content"
                        data-tabs-type="pills"
                        data-tabs-active-classes="bg-primary text-light"
                        data-tabs-inactive-classes="text-dark"
                        role="tablist"
                    >
                        <li class="flex-1" role="presentation">
                            <button
                                class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full"
                                id="doctor-tab"
                                data-tabs-target="#doctor-panel"
                                type="button"
                                role="tab"
                                aria-controls="doctor-panel"
                                aria-selected="true"
                            >
                                <span class="icon-[material-symbols--medical-services-outline] w-5 h-5"></span>
                                Doctor
                            </button>
                        </li>
                        <li class="flex-1" role="presentation">
                            <button
                                class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full"
                                id="dependiente-tab"
                                data-tabs-target="#dependiente-panel"
                                type="button"
                                role="tab"
                                aria-controls="dependiente-panel"
                                aria-selected="false"
                            >
                                <span class="icon-[material-symbols--person-outline] w-5 h-5"></span>
                                Dependiente
                            </button>
                        </li>
                    </ul>

                    {{-- Tab Content --}}
                    <div id="register-tab-content">
                        <div class="hidden" id="dependiente-panel" role="tabpanel" aria-labelledby="dependiente-tab">
                            <x-register-dependent-form :lines="$lines" :companies="$companies" :country="$country" />
                        </div>
                        <div class="hidden" id="doctor-panel" role="tabpanel" aria-labelledby="doctor-tab">
                            <x-register-doctor-form :lines="$lines" :country="$country" />
                        </div>
                    </div>

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
