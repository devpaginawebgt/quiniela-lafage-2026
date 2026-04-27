@php $grupoActual = $grupos->firstWhere('is_current', true); @endphp

<h1
    class="text-3xl 2xl:text-4xl text-center text-light font-bold mt-2 mb-8"
    id="titulo-jornadas-grupo">
    Partidos del Grupo {{ $grupoActual->name }}
</h1>

<div class="py-6 sm:px-4 lg:px-8 bg-secondary-light h-full flex-1">
    <div class="overflow-hidden xl:max-w-5xl 2xl:max-w-440 w-full mx-auto px-4 pb-6">
        {{-- Buscador de partidos --}}
        <div class="w-full max-w-lg mx-auto mb-6">
            <x-search-input id="buscar-partidos-grupo" name="buscar_partidos_grupo" placeholder="Buscar Partidos" />
        </div>

        {{-- Spinner jornadas --}}
        <div id="jornadas-spinner" class="hidden">
            <div class="flex justify-center py-8">
                <svg class="animate-spin w-8 h-8 text-secondary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
            </div>
        </div>

        {{-- Contenedor de jornadas con partidos --}}
        <div id="jornadas-partidos-list"></div>
    </div>
</div>
