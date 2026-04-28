<h1 class="text-3xl 2xl:text-4xl text-center text-light font-bold mt-2 mb-4">{{ $line->name }}</h1>
<h2 class="text-lg lg:text-xl text-center text-light font-semibold mb-8">Premios Disponibles</h2>

<div class="py-6 sm:px-4 lg:px-8 bg-secondary-light h-full flex-1">
    <div class="overflow-hidden 2xl:max-w-440 mx-auto w-full px-6 pb-6">
        {{-- Brands Slider --}}
        <div class="w-full max-w-lg mx-auto mb-8">
            <x-brands-slider :brands="$brands" />
        </div>

        <div class="w-full max-w-lg mx-auto mb-6">
            <x-search-input id="buscar-premios" name="buscar_premios" placeholder="Buscar Premios" />
        </div>

        {{-- Prize Cards --}}
        <div class="w-full max-w-lg mx-auto flex flex-col gap-3 pb-4" id="premios-list">
            @foreach($premios as $premio)
                <x-prize-card :premio="$premio" />
            @endforeach
        </div>
    </div>
</div>

{{-- Modal / Drawer Premio --}}
<x-prize-modal />
