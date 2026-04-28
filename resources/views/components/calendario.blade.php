<h1 class="text-3xl 2xl:text-4xl text-center text-light font-bold mt-2 mb-8">Calendario de Partidos</h1>

<div class="py-6 sm:px-4 lg:px-8 bg-secondary-light rounded-t-4xl h-full flex-1">
    <div class="overflow-hidden xl:max-w-5xl 2xl:max-w-440 w-full mx-auto">
        <div class="px-6 pb-6">
            <div class="w-full max-w-lg mx-auto mb-4">
                <x-search-input id="buscar-partidos" name="buscar_partidos" placeholder="Buscar Partidos" />
            </div>

            <div class="w-full max-w-lg mx-auto mb-6">
                <x-form-select id="jornadas" name="jornada" label="Jornada:">
                    @foreach($jornadas as $jornada)
                        <option value="{{ $jornada->id }}" {{ $jornada->is_current === true ? 'selected' : '' }}>
                            {{ $jornada->name }}
                        </option>
                    @endforeach
                </x-form-select>
            </div>

            <ul id="partidos-jornada-general" class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 2xl:gap-12 gap-4 lg:gap-8 items-center min-h-96">
                <li class="md:col-span-2 2xl:col-span-3 flex justify-center py-8">
                    <svg class="animate-spin w-8 h-8 text-secondary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                </li>
            </ul>
        </div>
    </div>
</div>
