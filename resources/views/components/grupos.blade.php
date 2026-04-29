<h1 class="text-3xl 2xl:text-4xl text-center text-light font-bold mt-2 mb-8">Grupos Conformados</h1>

<div class="py-6 sm:px-4 lg:px-8 bg-secondary-light rounded-t-4xl h-full flex-1">
    <div class="overflow-hidden 2xl:max-w-440 w-full mx-auto">
        <div class="px-4 pb-6">
            {{-- Search --}}
            <div class="w-full max-w-lg mx-auto mb-4">
                <x-search-input id="buscar-equipos" name="buscar_equipos" placeholder="Buscar Equipo" />
            </div>

            {{-- Group selector --}}
            <div class="max-w-lg mx-auto mb-6">
                <x-form-select id="selector-grupo" name="selector_grupo" label="Grupo:">
                    @foreach($grupos as $grupo)
                    <option
                        value="{{ $grupo->id }}"
                        class="bg-complementary-primary"
                        {{ $grupo->is_current === true ? 'selected' : '' }}
                    >
                        {{ $grupo->name }}
                    </option>
                    @endforeach
                </x-form-select>
            </div>

            {{-- Group title --}}
            <h6 id="titulo-grupo" class="text-2xl font-bold text-center mb-4">
                Grupo {{ ($grupos->firstWhere('is_current', true))->name }}
            </h6>

            {{-- Loading spinner --}}
            <div id="grupos-spinner" class="hidden">
                <div class="flex justify-center py-8">
                    <svg class="animate-spin w-8 h-8 text-secondary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                </div>
            </div>

            {{-- Team cards grid --}}
            <div id="equipos-grupo-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-4 w-full mx-auto items-start min-h-60"></div>
        </div>
    </div>
</div>
