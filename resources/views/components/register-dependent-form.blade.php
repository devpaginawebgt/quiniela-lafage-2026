<form
    method="POST"
    action="{{ route('register') }}"
    class="formulario-auth grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-2xl mx-auto"
>
    @csrf

    <input type="hidden" name="user_type_id" value="1">
    <input type="hidden" name="accepted_terms_version" value="">

    <x-auth-input
        label="Nombres"
        id="dep_nombres"
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
        id="dep_apellidos"
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
        label="{{ $country->document_name ?? 'Número de documento' }}"
        id="dep_numero_documento"
        name="numero_documento"
        placeholder="Ingrese su {{ $country->document_name ?? 'Número de documento' }}"
        maxlength="20"
        pattern="{{ $country->document_regex }}"
        title="{{ $country->document_regex_message }}"
        :required="true"
    >
        <x-slot name="prefix">
            <span class="icon-[material-symbols--badge-rounded] w-5 h-5"></span>
        </x-slot>
    </x-auth-input>

    <x-auth-input
        label="Correo electrónico"
        id="dep_email"
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
        
    <x-auth-select label="País" id="doc_pais_id" name="pais_id" :required="true">
        <x-slot name="prefix">
            <span class="icon-[material-symbols--flag] w-5 h-5"></span>
        </x-slot>
        <option value="{{ $country->id }}" {{ old('pais_id') === $country->id ? 'selected' : '' }}>
            {{ $country->name }}
        </option>
    </x-auth-select>

    <x-auth-input
        label="Código de acceso"
        id="dep_codigo"
        name="code"
        placeholder="Ingrese su código de acceso"
        minlength="8"
        maxlength="8"
        :required="true"
    >
        <x-slot name="prefix">
            <span class="icon-[material-symbols--pin-rounded] w-6 h-6"></span>
        </x-slot>
    </x-auth-input>

    <div class="flex flex-col gap-2 -mb-2">
        {{-- Contraseña --}}
        <x-auth-password-input
            id="dep_password"
            label="Contraseña"
            name="password"
            placeholder="Contraseña"
            minlength="4"
            maxlength="50"
            required
        >
            <x-slot name="prefix">
                <span class="icon-[material-symbols--lock] w-5 h-5"></span>
            </x-slot>
        </x-auth-password-input>
        <p class="text-xs text-zinc-500 px-1">
            Debe contener mínimo 4 caracteres
        </p>
    </div>

    {{-- Contraseña --}}
    <x-auth-password-input
        id="dep_password_confirmation"
        label="Confirmar contraseña"
        name="password_confirmation"
        placeholder="Contraseña"
        minlength="4"
        maxlength="50"
        required
    >
        <x-slot name="prefix">
            <span class="icon-[material-symbols--lock-outline] w-5 h-5"></span>
        </x-slot>
    </x-auth-password-input>

    <x-auth-select label="Cadena" id="dep_cadena" name="company_id" :required="true">
        <x-slot name="prefix">
            <span class="icon-[material-symbols--corporate-fare] w-5 h-5"></span>
        </x-slot>
        @foreach ($companies as $company)
            <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                {{ $company->name }}
            </option>
        @endforeach
    </x-auth-select>

    <x-auth-input
        label="Sucursal"
        id="dep_sucursal"
        name="branch"
        placeholder="Ingrese su sucursal"
        minlength="3"
        maxlength="255"
        :required="true"
    >
        <x-slot name="prefix">
            <span class="icon-[material-symbols--store] w-5 h-5"></span>
        </x-slot>
    </x-auth-input>

    {{-- Submit --}}
    <div class="mt-2 md:col-span-2">
        <button
            type="button"
            class="btn-crear-cuenta w-full bg-primary text-light rounded-full px-6 py-3 hover:brightness-110 focus:ring-3 focus:ring-dark flex items-center justify-center gap-2"
        >
            <span class="icon-[material-symbols--person-add] w-6 h-6"></span>
            Crear Cuenta
        </button>
    </div>
</form>
