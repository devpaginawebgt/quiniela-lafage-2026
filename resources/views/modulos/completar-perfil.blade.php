<x-app-layout>
    <div class="py-6 sm:px-4 lg:px-8 bg-secondary-light rounded-t-4xl h-full flex-1">
        <div class="w-full max-w-xl mx-auto px-6 pb-6">
            
            <h1 class="text-3xl 2xl:text-4xl text-center text-dark font-bold mt-2 mb-8">Completa tu perfil</h1>

            <x-toast-errors :errors="$errors" :message-error="$message_error ?? null" />

            <p class="text-center text-dark text-sm mb-6">
                Necesitas completar tu información si deseas participar en el ranking, ver los premios o registrar tus pronósticos.
            </p>

            <form
                method="POST"
                action="{{ route('web.users.perfil.completar.store') }}"
                class="flex flex-col gap-6 w-full"
            >
                @csrf

                {{-- DPI / Número de documento (ambos tipos) --}}
                <x-auth-input
                    label="{{ $user->country->document_name ?? 'Número de documento' }}"
                    id="numero_documento"
                    name="numero_documento"
                    placeholder="Ingrese su {{ $user->country->document_name ?? 'Número de documento' }}"
                    minlength="6"
                    maxlength="20"
                    pattern="{{ $user->country->document_regex }}"
                    title="{{ $user->country->document_regex_message }}"
                    :required="true"
                >
                    <x-slot name="prefix">
                        <span class="icon-[material-symbols--badge-rounded] w-5 h-5"></span>
                    </x-slot>
                </x-auth-input>

                @if ((int) $user->user_type_id === 1)
                    {{-- Dependiente --}}
                    <x-auth-select label="Cadena" id="company_id" name="company_id" :required="true">
                        <x-slot name="prefix">
                            <span class="icon-[material-symbols--corporate-fare] w-5 h-5"></span>
                        </x-slot>
                        <option value="" disabled selected>Seleccione una cadena</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                {{ $company->name }}
                            </option>
                        @endforeach
                    </x-auth-select>

                    <x-auth-input
                        label="Sucursal"
                        id="branch"
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
                @elseif ((int) $user->user_type_id === 2)
                    {{-- Doctor --}}
                    <x-auth-select label="Línea" id="line_id" name="line_id" :required="true">
                        <x-slot name="prefix">
                            <span class="icon-[material-symbols--medication] w-5 h-5"></span>
                        </x-slot>
                        <option value="" disabled selected>Seleccione una línea</option>
                        @foreach ($lines as $line)
                            <option value="{{ $line->id }}" {{ old('line_id') == $line->id ? 'selected' : '' }}>
                                {{ $line->name }}
                            </option>
                        @endforeach
                    </x-auth-select>

                    <x-auth-input
                        label="Número de colegiado"
                        id="colegiado"
                        name="colegiado"
                        placeholder="Ingrese su colegiado"
                        minlength="2"
                        maxlength="20"
                        :required="true"
                    >
                        <x-slot name="prefix">
                            <span class="icon-[material-symbols--medical-information] w-5 h-5"></span>
                        </x-slot>
                    </x-auth-input>
                @endif

                <button
                    type="submit"
                    class="w-full bg-primary text-light rounded-full px-6 py-3 hover:brightness-110 focus:ring-3 focus:ring-dark flex items-center justify-center gap-2 mt-2"
                >
                    <span class="icon-[material-symbols--check-circle-outline] w-6 h-6"></span>
                    Guardar y continuar
                </button>

                <div class="text-center">
                    <a
                        href="{{ route('web.users.perfil') }}"
                        class="text-primary font-bold text-base hover:text-secondary transition-color duration-300 ease-in-out"
                    >
                        Omitir por ahora
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
