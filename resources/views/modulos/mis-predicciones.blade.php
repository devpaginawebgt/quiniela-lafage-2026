<x-app-layout>
    <h1 class="text-3xl 2xl:text-4xl text-light text-center font-bold mt-2 mb-8">Mis Pronósticos</h1>

    <div class="py-6 sm:px-4 lg:px-8 bg-secondary-light h-full flex-1">
        <div class="overflow-hidden 2xl:max-w-440 mx-auto w-full">

            <div class="px-6 pb-6">
                <div class="w-full max-w-lg mx-auto mb-4">
                    <x-search-input id="buscar-partidos" name="buscar_partidos" placeholder="Buscar partido" />
                </div>

                <form id="form-mis-predicciones" action="{{ route('web.mis-predicciones') }}" method="GET" class="w-full max-w-lg mx-auto mb-6">
                    <x-form-select id="select-mis-predicciones" name="jornada" label="Jornada:">
                        @foreach($jornadas as $jornada)
                            <option value="{{ $jornada->id }}" {{ $jornada->id === $jornada_activa ? 'selected' : '' }}>
                                {{ $jornada->name }}
                            </option>
                        @endforeach
                    </x-form-select>
                </form>

                @if(isset($resultados) && $resultados->isNotEmpty())

                    <ul id="partidos-jornada-general" class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 2xl:gap-12 gap-4 lg:gap-8 items-start min-h-80">
                        @foreach($resultados as $registro)
                            <x-result-card :registro="$registro" />
                        @endforeach
                    </ul>

                @else

                    <p class="text-2xl text-complementary-dark w-full text-center py-12">
                        No hay partidos finalizados en esta jornada
                    </p>

                @endif
            </div>
        </div>
    </div>
</x-app-layout>
