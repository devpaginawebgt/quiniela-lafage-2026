<x-app-layout>
    <div id="toast-container"
         class="fixed top-4 left-1/2 -translate-x-1/2 z-50 flex-col items-center gap-3 w-full max-w-sm px-4"
         style="display: none;"
         aria-live="polite">
    </div>

    <x-carousel-home-banners :banners="$banners" />

    <div class="py-6 sm:px-4 lg:px-8 bg-secondary-light h-full flex-1" id="selecciones-container">
        <div class="overflow-hidden xl:max-w-5xl 2xl:max-w-440 w-full mx-auto">

            <div class="px-6 pb-6">
                <h1 class="text-3xl 2xl:text-4xl text-center text-dark font-bold mt-2 mb-8">Próximos Partidos</h1>

                <div class="w-full max-w-lg mx-auto mb-4">
                    <x-search-input id="buscar-partidos" name="buscar_partidos" placeholder="Buscar Partidos" />
                </div>

                <form id="form-proximos-partidos" action="{{ route('web.proximos-partidos') }}" method="GET" class="w-full max-w-lg mx-auto mb-4">
                    <x-form-select id="select-proximos-partidos" name="jornada" label="Jornada:">
                        @foreach($jornadas as $jornada)
                            <option value="{{ $jornada->id }}" {{ $jornada->id === $jornada_activa ? 'selected' : '' }}>
                                {{ $jornada->name }}
                            </option>
                        @endforeach
                    </x-form-select>
                </form>

                <div data-url-predicciones="{{ route('web.save-predicciones') }}">
                    @if (isset($partidosJornada) && $partidosJornada->isNotEmpty())

                        <ul id="partidos-jornada-general" class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 2xl:gap-12 gap-4 lg:gap-8 items-center min-h-96">

                            @foreach ($partidosJornada as $registro)
                                <x-prediction-card :registro="$registro" />
                            @endforeach

                        </ul>

                    @else

                        <p class="text-2xl text-complementary-dark w-full text-center py-12">
                            No hay predicciones disponibles para esta jornada
                        </p>

                    @endif
                </div>
            </div>

        </div>
    </div>

    {{-- Modal Resultado de Predicciones --}}
    <div id="modal-resultado-predicciones" class="pointer-events-none fixed inset-0 z-50 flex items-end lg:items-center justify-center p-0 lg:p-4" style="display: none;">

        {{-- Backdrop --}}
        <div id="modal-resultado-backdrop" class="absolute inset-0 bg-black/70 opacity-0 transition-opacity duration-300"></div>

        {{-- Panel --}}
        <div id="modal-resultado-panel" class="relative bg-secondary-light lg:rounded-3xl overflow-hidden w-full lg:max-w-lg h-full lg:h-auto lg:max-h-[90dvh] flex flex-col opacity-0 transition-opacity duration-300 ease-out">

            {{-- Header --}}
            <div class="shrink-0 pt-6 pb-4 px-6 flex items-start justify-between gap-4">
                <h2 class="text-xl lg:text-2xl font-bold text-dark leading-tight">Resultado del registro de predicciones</h2>
                <button type="button" id="modal-resultado-close" class="shrink-0 text-complementary-dark hover:text-dark transition-colors mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"><path fill="currentColor" d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12z"/></svg>
                </button>
            </div>

            {{-- Scrollable cards container --}}
            <div class="overflow-y-auto flex-1 px-6 py-4 pb-6">
                <div id="modal-resultado-cards" class="grid grid-cols-1 gap-4"></div>
            </div>

        </div>
    </div>
</x-app-layout>
