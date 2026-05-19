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
        <div class="relative h-screen w-full flex flex-col overflow-hidden md:h-auto md:min-h-screen md:overflow-visible md:justify-center md:items-center md:p-6">
            <div class="absolute inset-0 bg-cover bg-center md:hidden"
                 style="background-image: url({{ asset('images/decoracion/background-sm.png') }});"></div>
            <div class="absolute inset-0 bg-cover bg-center hidden md:block"
                 style="background-image: url({{ asset('images/decoracion/background.png') }});"></div>

            <div class="relative z-10 w-full flex flex-col flex-1 min-h-0 md:flex-none md:max-w-xl">
                {{-- Back button --}}
                <div class="px-4 pt-4 shrink-0 md:hidden">
                    <a
                        href="{{ route('ingresa') }}"
                        class="inline-flex items-center justify-center w-10 h-10 text-light hover:opacity-80"
                        aria-label="Volver"
                    >
                        <span class="icon-[material-symbols--arrow-back-rounded] w-6 h-6"></span>
                    </a>
                </div>

                <x-toast-errors :errors="$errors" :message-error="$message_error ?? null" />

                <div class="w-full flex-1 min-h-0 overflow-y-auto rounded-t-3xl bg-secondary-light p-6 md:flex-none md:max-h-[90vh] md:rounded-3xl md:shadow-3xl md:p-8">
                    {{-- Logo --}}
                    <div class="mb-4">
                        <img
                            src="/images/logos/logo-dark.png"
                            class="w-full max-w-28 2xl:max-w-56 mx-auto"
                            alt="{{ config('app.name', 'Quiniela') }}"
                        >
                    </div>

                    {{-- Title --}}
                    <h1 class="text-3xl text-center font-bold text-dark mb-4">Crear cuenta</h1>

                    {{-- Tabs pills --}}
                    <ul
                        class="flex text-base font-medium text-center bg-complementary-primary rounded-full mb-6"
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
                        <div class="hidden" id="doctor-panel" role="tabpanel" aria-labelledby="doctor-tab">
                            <x-register-doctor-form />
                        </div>
                        <div class="hidden" id="dependiente-panel" role="tabpanel" aria-labelledby="dependiente-tab">
                            <x-register-dependent-form />
                        </div>
                    </div>

                    {{-- Login link --}}
                    <div class="text-center mt-6">
                        <p class="text-zinc-600 text-sm mb-3">¿Ya tienes cuenta?</p>
                        <a
                            href="{{ route('ingresa') }}"
                            class="w-full inline-flex items-center justify-center border border-primary text-primary font-bold rounded-full px-6 py-2 hover:bg-white transition-colors duration-300 ease-in-out"
                        >
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
