<form
    method="POST"
    action="{{ route('register.lafage') }}"
    class="formulario-auth grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-2xl mx-auto"
>
    @csrf

    <input type="hidden" name="pais_id" value="{{ $country->id }}">
    <input type="hidden" name="accepted_terms_version" value="">

    <x-auth-input
        label="Nombres"
        id="laf_nombres"
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
        id="laf_apellidos"
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
        id="laf_email"
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

    <x-auth-select label="Línea" id="laf_line_id" name="line_id" :required="true">
        <x-slot name="prefix">
            <span class="icon-[material-symbols--medication] w-5 h-5"></span>
        </x-slot>
        @foreach($lines ?? [] as $line)
            <option value="{{ $line->id }}" {{ old('line_id') == $line->id ? 'selected' : '' }}>
                {{ $line->name }}
            </option>
        @endforeach
    </x-auth-select>

    <div class="flex flex-col gap-2 -mb-2">
        <x-auth-password-input
            id="laf_password"
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

    <x-auth-password-input
        id="laf_password_confirmation"
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
