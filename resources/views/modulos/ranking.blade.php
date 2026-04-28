<x-app-layout>
    {{-- Pill tabs: ranking / premios --}}
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
                    id="tab-ranking-btn"
                    data-tabs-target="#tab-ranking"
                    type="button"
                    role="tab"
                    aria-controls="tab-ranking"
                    aria-selected="true"
                >
                    <span class="icon-[material-symbols--leaderboard] w-5 h-5"></span>
                    Ranking
                </button>
            </li>
            <li class="flex-1" role="presentation">
                <button
                    class="w-full inline-flex items-center justify-center gap-2 p-3 rounded-lg transition-colors"
                    id="tab-premios-btn"
                    data-tabs-target="#tab-premios"
                    type="button"
                    role="tab"
                    aria-controls="tab-premios"
                    aria-selected="false"
                >
                    <span class="icon-[material-symbols--trophy] w-5 h-5"></span>
                    Premios
                </button>
            </li>
        </ul>
    </div>

    {{-- Tab content --}}
    <div id="navegacion-tabs-content" class="flex-1 flex flex-col">
        <div id="tab-ranking" role="tabpanel" aria-labelledby="tab-ranking-btn" class="flex-1 flex flex-col">
            @include('components.ranking')
        </div>

        <div id="tab-premios" role="tabpanel" aria-labelledby="tab-premios-btn" class="flex flex-1 flex-col">
            @include('components.premios')
        </div>
    </div>
</x-app-layout>
