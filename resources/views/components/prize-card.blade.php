@props(['premio'])

@php
    $trophyColor = match((int) $premio->posicion) {
        1 => '#EFBF04',
        2 => '#C4C4C4',
        3 => '#CE8946',
        default => '#FFFFFF',
    };
@endphp

<div
    class="prize-card bg-light border border-complementary-dark rounded-2xl overflow-hidden cursor-pointer hover:scale-[1.02] transition-transform duration-200 px-4 pb-4 shadow-md shadow-zinc-400"
    data-nombre="{{ $premio->nombre }}"
    data-imagen="{{ asset($premio->imagen) }}"
    data-posicion="{{ $premio->posicion }}"
>
    {{-- Description hidden — used by JS for the modal --}}
    <span class="prize-card-descripcion hidden">{{ $premio->descripcion }}</span>

    <h3 class="font-semibold text-center pt-2 mb-2">{{ $premio->titulo_posicion }}</h3>

    <div class="flex items-center gap-4">
        {{-- Position & Trophy --}}
        <div class="flex items-center gap-1 shrink-0 min-w-14">
            <span class="text-2xl font-bold">{{ $premio->posicion }}°</span>
            <span class="icon-[material-symbols--trophy] w-8 h-8" style="color: {{ $trophyColor }}"></span>
        </div>

        {{-- Info --}}
        <div class="flex-1 min-w-0">
            <p class="font-semibold leading-tight">{{ $premio->nombre }}</p>
            <p class="text-complementary-dark text-sm line-clamp-2 mt-0.5">{{ $premio->descripcion }}</p>
        </div>

        {{-- Arrow --}}
        <span class="flex items-center gap-1 shrink-0 font-semibold text-sm ml-2">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </span>
    </div>
</div>
