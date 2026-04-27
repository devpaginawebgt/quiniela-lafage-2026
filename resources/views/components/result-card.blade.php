@props(['registro'])

@php
    $partido    = $registro->partido;
    $equipoUno  = $registro->equipoUno;
    $equipoDos  = $registro->equipoDos;
    $resultado  = $registro->resultado;
    $prediccion = $registro->prediccion;
    $puntos     = $registro->puntos ?? 0;
    $mensaje    = $registro->mensaje ?? 'No has realizado una predicción.';

    $tienePrediccion = !empty($prediccion);
    $tieneResultado  = !empty($resultado);
@endphp

<li class="bg-light border border-complementary-dark rounded-3xl flex flex-col overflow-hidden shadow-md shadow-zinc-400 hover:-translate-y-1 hover:shadow-lg transition-all duration-300 ease-in-out"
    data-equipos="{{ strtolower($equipoUno->nombre . ' ' . $equipoDos->nombre) }}">

    <div class="flex flex-col flex-1 pt-6 px-6 gap-6">

        {{-- Equipos VS --}}
        <div class="flex items-center justify-between w-full gap-2">

            <div class="flex flex-col items-center gap-2 flex-1">
                <img
                    src="{{ asset($equipoUno->imagen) }}"
                    alt="{{ $equipoUno->nombre }}"
                    class="w-full max-w-20 lg:max-w-24 aspect-6/4 object-cover rounded-xl shadow-md"
                >
                <p class="font-semibold text-sm text-center leading-tight">{{ $equipoUno->nombre }}</p>
            </div>

            <span class="font-bold text-2xl shrink-0">VS</span>

            <div class="flex flex-col items-center gap-2 flex-1">
                <img
                    src="{{ asset($equipoDos->imagen) }}"
                    alt="{{ $equipoDos->nombre }}"
                    class="w-full max-w-20 lg:max-w-24 aspect-6/4 object-cover rounded-xl shadow-md"
                >
                <p class="font-semibold text-sm text-center leading-tight">{{ $equipoDos->nombre }}</p>
            </div>

        </div>

        {{-- Badge puntos --}}
        <div class="flex justify-center">
            <span class="w-full text-center font-bold text-base py-2 px-6 rounded-full bg-primary text-light">
                {{ $mensaje }}
            </span>
        </div>

        {{-- Mostrar Detalles --}}
        <div>
            <hr class="border-complementary-dark mb-4">

            <button
                type="button"
                aria-expanded="false"
                class="result-card-toggle flex items-center justify-between w-full text-dark font-semibold pt-4 pb-6 px-4 cursor-pointer"
            >
                <span>Mostrar Detalles</span>
                <svg class="w-4 h-4 shrink-0 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </button>

            <div class="result-card-details overflow-hidden max-h-0 transition-[max-height] duration-500 ease-in-out mt-0">
                <div class="flex flex-col gap-4 text-center pb-6">

                    {{-- Resultado Final --}}
                    <div class="flex flex-col gap-2 text-dark">
                        <p class="font-bold text-base">Resultado Final</p>
                        @if($tieneResultado)
                            <div class="flex items-center justify-center gap-8">
                                <span class="font-bold text-3xl">{{ $resultado->goles_equipo_1 }}</span>
                                <span class="font-bold text-2xl">-</span>
                                <span class="font-bold text-3xl">{{ $resultado->goles_equipo_2 }}</span>
                            </div>
                        @else
                            <p class="text-complementary-light text-sm">Sin resultado</p>
                        @endif
                    </div>

                    <hr class="border-complementary-dark">

                    {{-- Tu Pronóstico --}}
                    <div class="flex flex-col gap-2">
                        <p class="font-bold text-base">Tu Pronóstico</p>
                        @if($tienePrediccion)
                            <div class="flex items-center justify-center gap-8">
                                <span class="font-bold text-3xl">{{ $prediccion->goles_equipo_1 }}</span>
                                <span class="font-bold text-2xl">-</span>
                                <span class="font-bold text-3xl">{{ $prediccion->goles_equipo_2 }}</span>
                            </div>
                        @else
                            <p class="text-complementary-dark text-sm">Sin pronóstico</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- Header: Brand --}}
    @if(!empty($partido->brand))
        {{-- Separador --}}
        <hr class="border-complementary-dark">

        <div class="w-full flex justify-center items-center p-4">
            <img
                src="{{ asset($partido->brand->image) }}"
                alt="{{ $partido->brand->name }}"
                class="w-full max-w-56 aspect-4/1 object-contain"
            >
        </div>
    @endif

</li>
