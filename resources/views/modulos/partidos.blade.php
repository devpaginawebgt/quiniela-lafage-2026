<x-app-layout>
    {{-- Pill tabs: Calendario / Grupos / Jornadas --}}
    <div class="px-4 mt-2 mb-4 max-w-lg w-full mx-auto">
        <ul
            class="flex text-sm font-semibold text-center bg-secondary/30 backdrop-blur-sm rounded-lg"
            id="navegacion-tabs"
            data-tabs-toggle="#navegacion-tabs-content"
            data-tabs-type="pills"
            data-tabs-active-classes="bg-secondary text-light shadow"
            data-tabs-inactive-classes="text-light/80 hover:text-light"
            role="tablist"
        >
            <li class="flex-1" role="presentation">
                <button
                    class="w-full inline-flex items-center justify-center gap-2 p-3 rounded-lg transition-colors"
                    id="tab-calendario-btn"
                    data-tabs-target="#tab-calendario"
                    type="button"
                    role="tab"
                    aria-controls="tab-calendario"
                    aria-selected="true"
                >
                    <span class="icon-[material-symbols--calendar-month] w-5 h-5"></span>
                    Calendario
                </button>
            </li>
            <li class="flex-1" role="presentation">
                <button
                    class="w-full inline-flex items-center justify-center gap-2 p-3 rounded-lg transition-colors"
                    id="tab-grupos-btn"
                    data-tabs-target="#tab-grupos"
                    type="button"
                    role="tab"
                    aria-controls="tab-grupos"
                    aria-selected="false"
                >
                    <span class="icon-[material-symbols--groups] w-5 h-5"></span>
                    Grupos
                </button>
            </li>
            <li class="flex-1" role="presentation">
                <button
                    class="w-full inline-flex items-center justify-center gap-2 p-3 rounded-lg transition-colors"
                    id="tab-jornadas-btn"
                    data-tabs-target="#tab-jornadas"
                    type="button"
                    role="tab"
                    aria-controls="tab-jornadas"
                    aria-selected="false"
                >
                    <span class="icon-[material-symbols--sports-soccer] w-5 h-5"></span>
                    Jornadas
                </button>
            </li>
        </ul>
    </div>

    {{-- Tab content --}}
    <div id="navegacion-tabs-content" class="flex-1 flex flex-col">

        <div id="tab-calendario" role="tabpanel" aria-labelledby="tab-calendario-btn" class="flex-1 flex flex-col">
            @include('components.calendario')
        </div>

        <div id="tab-grupos" role="tabpanel" aria-labelledby="tab-grupos-btn" class="flex flex-1 flex-col">
            @include('components.grupos')
        </div>

        <div id="tab-jornadas" role="tabpanel" aria-labelledby="tab-jornadas-btn" class="flex flex-1 flex-col">
            @include('components.jornadas')
        </div>

    </div>
</x-app-layout>
