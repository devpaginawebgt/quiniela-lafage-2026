@props([
    'countries',
    'country',
])

@php
    $selectedCountry = $countries->firstWhere('id', (int) old('pais_id', $country->id ?? null)) ?? $country;
@endphp

<form
    method="POST"
    action="{{ route('register') }}"
    class="formulario-auth flex flex-col gap-6 w-full max-w-xl mx-auto"
>
    @csrf

    <input type="hidden" name="user_type_id" value="2">
    <input type="hidden" name="accepted_terms_version" value="">

    <x-auth-input
        label="Nombres"
        id="doc_nombres"
        name="nombres"
        placeholder="Ingrese sus nombres"
        minlength="2"
        maxlength="60"
        :required="true"
    >
        <x-slot name="prefix">
            <span class="icon-[material-symbols--person] w-5 h-5"></span>
        </x-slot>
    </x-auth-input>

    <x-auth-input
        label="Apellidos"
        id="doc_apellidos"
        name="apellidos"
        placeholder="Ingrese sus apellidos"
        minlength="2"
        maxlength="60"
        :required="true"
    >
        <x-slot name="prefix">
            <span class="icon-[material-symbols--person-outline] w-5 h-5"></span>
        </x-slot>
    </x-auth-input>

    <x-auth-input
        label="Correo electrónico"
        id="doc_email"
        name="email"
        type="email"
        placeholder="correo@ejemplo.com"
        minlength="5"
        maxlength="255"
        :required="true"
    >
        <x-slot name="prefix">
            <span class="icon-[material-symbols--mail] w-5 h-5"></span>
        </x-slot>
    </x-auth-input>

    <x-auth-select
        label="País"
        id="doc_pais_id"
        name="pais_id"
        :required="true"
    >
        <x-slot name="prefix">
            <span class="icon-[material-symbols--public] w-5 h-5"></span>
        </x-slot>
        @foreach($countries as $countryOption)
            <option
                value="{{ $countryOption->id }}"
                @selected($selectedCountry && (int) $selectedCountry->id === (int) $countryOption->id)
            >
                {{ $countryOption->name }}
            </option>
        @endforeach
    </x-auth-select>

    <x-auth-password-input
        id="doc_password"
        label="Contraseña"
        name="password"
        placeholder="Mínimo 8 caracteres"
        minlength="8"
        maxlength="50"
        required
    >
        <x-slot name="prefix">
            <span class="icon-[material-symbols--lock] w-5 h-5"></span>
        </x-slot>
    </x-auth-password-input>

    <x-auth-password-input
        id="doc_password_confirmation"
        label="Confirmar contraseña"
        name="password_confirmation"
        placeholder="Repita su contraseña"
        minlength="8"
        maxlength="50"
        required
    >
        <x-slot name="prefix">
            <span class="icon-[material-symbols--lock-outline] w-5 h-5"></span>
        </x-slot>
    </x-auth-password-input>

    <div class="mt-2">
        <button
            type="button"
            class="btn-crear-cuenta w-full bg-primary text-light rounded-full px-6 py-3 hover:brightness-110 focus:ring-3 focus:ring-dark flex items-center justify-center gap-2"
        >
            <span class="icon-[material-symbols--person-add] w-6 h-6"></span>
            Crear Cuenta
        </button>
    </div>
</form>
