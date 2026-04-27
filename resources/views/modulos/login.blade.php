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
        {{-- Full screen background --}}
        <div class="relative min-h-screen w-full">
            {{-- Background: main-bg hasta lg, bg-main-web desde lg --}}
            <div class="absolute inset-0 bg-cover bg-center lg:hidden"
                 style="background-image: url({{ asset('images/decoracion/background-sm.png') }});"></div>
            <div class="absolute inset-0 bg-cover bg-center hidden lg:block"
                 style="background-image: url({{ asset('images/decoracion/background.png') }});"></div>
            {{-- Overlay oscuro --}}
            {{-- <div class="absolute inset-0 bg-black"></div> --}}

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
                    <h1 class="text-3xl text-center font-bold text-light mb-8">Inicia Sesión</h1>
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

                    {{-- Tabs pills --}}
                    <ul
                        class="flex text-base font-medium text-center bg-complementary-primary rounded-full mb-8"
                        id="login-tab"
                        data-tabs-toggle="#login-tab-content"
                        data-tabs-type="pills"
                        data-tabs-active-classes="bg-primary text-light"
                        data-tabs-inactive-classes="text-dark"
                        role="tablist"
                    >
                        <li class="flex-1" role="presentation">
                            <button
                                class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full"
                                id="login-doctor-tab"
                                data-tabs-target="#login-doctor-panel"
                                type="button"
                                role="tab"
                                aria-controls="login-doctor-panel"
                                aria-selected="true"
                            >
                                <span class="icon-[material-symbols--medical-services-outline] w-5 h-5"></span>
                                Doctor
                            </button>
                        </li>
                        <li class="flex-1" role="presentation">
                            <button
                                class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full"
                                id="login-dependiente-tab"
                                data-tabs-target="#login-dependiente-panel"
                                type="button"
                                role="tab"
                                aria-controls="login-dependiente-panel"
                                aria-selected="false"
                            >
                                <span class="icon-[material-symbols--person-outline] w-5 h-5"></span>
                                Dependiente
                            </button>
                        </li>
                    </ul>

                    {{-- Tab Content --}}
                    <div id="login-tab-content">
                        {{-- Doctor panel --}}
                        <div id="login-doctor-panel" role="tabpanel" aria-labelledby="login-doctor-tab">
                            <form
                                method="POST"
                                action="{{ route('login') }}"
                                class="formulario-auth w-full max-w-108 lg:max-w-108 mx-auto"
                            >
                                @csrf

                                <input type="hidden" name="user_type_id" value="2">

                                <x-login-input
                                    label="Número de colegiado"
                                    id="colegiado"
                                    name="identity"
                                    icon="icon-[material-symbols--medical-information]"
                                    placeholder="Ingrese su colegiado"
                                    maxlength="20"
                                    required
                                />

                                <x-login-password-input
                                    label="Contraseña"
                                    id="doctor-password"
                                    name="password"
                                    icon="icon-[material-symbols--lock]"
                                    placeholder="Ingrese su contraseña"
                                    autocomplete="current-password"
                                    maxlength="255"
                                    required
                                />

                                <button
                                    type="submit"
                                    class="w-full bg-primary text-light rounded-full px-6 py-3 hover:brightness-110 focus:ring-3 focus:ring-dark flex items-center justify-center gap-2"
                                >
                                    <span class="icon-[material-symbols--login] w-5 h-5"></span>
                                    Iniciar Sesión
                                </button>
                            </form>
                        </div>

                        {{-- Dependiente panel --}}
                        <div class="hidden" id="login-dependiente-panel" role="tabpanel" aria-labelledby="login-dependiente-tab">
                            <form
                                method="POST"
                                action="{{ route('login') }}"
                                class="formulario-auth w-full max-w-108 lg:max-w-108 mx-auto"
                            >
                                @csrf

                                <input type="hidden" name="user_type_id" value="1">

                                <x-login-input
                                    label="{{ $country->document_name ?? 'Número de documento' }}"
                                    id="numero_documento"
                                    name="identity"
                                    icon="icon-[material-symbols--badge]"
                                    placeholder="Ingrese su {{ $country->document_name ?? 'Número de documento' }}"
                                    pattern="{{ $country->document_regex }}"
                                    title="{{ $country->document_regex_message }}"
                                    required
                                />

                                <x-login-password-input
                                    label="Contraseña"
                                    id="dependiente-password"
                                    name="password"
                                    icon="icon-[material-symbols--lock]"
                                    placeholder="Ingrese su contraseña"
                                    autocomplete="current-password"
                                    maxlength="255"
                                    required
                                />

                                <button
                                    type="submit"
                                    class="w-full bg-primary text-light rounded-full px-6 py-3 hover:brightness-110 focus:ring-3 focus:ring-dark flex items-center justify-center gap-2"
                                >
                                    <span class="icon-[material-symbols--login] w-5 h-5"></span>
                                    Iniciar Sesión
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Register link --}}
                    <div class="text-center mt-8">
                        <p class="text-dark text-sm mb-2">¿No tienes cuenta?</p>
                        <a href="{{ route('register') }}" class="text-primary/80 font-semibold text-base hover:text-primary">
                            Regístrate
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>
