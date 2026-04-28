<h1 class="text-3xl 2xl:text-4xl text-center text-light font-bold mt-2 mb-4">{{ $line->name }}</h1>
<h2 class="text-lg lg:text-xl text-center text-light font-semibold mb-8">Posiciones del mundial 2026</h2>

<div class="py-6 px-4 lg:px-8 bg-secondary-light h-full flex-1">
    <div class="overflow-hidden xl:max-w-5xl 2xl:max-w-440 w-full mx-auto">

        <x-brands-slider :brands="$brands" />

        <div class="w-full max-w-lg mx-auto my-8">
            <x-search-input id="buscar-participante" name="buscar_participante" placeholder="Buscar participante" />
        </div>

        <div class="max-h-[60vh] max-w-148 mx-auto overflow-y-auto px-1">
            <div id="ranking-list" class="flex flex-col md:items-center gap-3 py-2"></div>

            {{-- Loader --}}
            <div id="ranking-loader" class="flex justify-center py-8">
                <svg class="animate-spin h-8 w-8 text-secondary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
            </div>

            {{-- Empty state --}}
            <p id="ranking-empty" class="text-center text-complementary-dark py-4 hidden">
                No hay participantes para mostrar
            </p>

            {{-- Load more --}}
            <div class="flex justify-center mt-4 mb-6">
                <button id="btn-cargar-mas"
                    class="hidden bg-secondary text-dark font-semibold px-6 py-2.5 rounded-full hover:bg-secondary/80 transition-colors">
                    Cargar más
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rankingList = document.getElementById('ranking-list');
        const loader = document.getElementById('ranking-loader');
        const emptyState = document.getElementById('ranking-empty');
        const btnCargarMas = document.getElementById('btn-cargar-mas');

        let currentPage = 1;
        let loading = false;

        const PODIUM_COLORS = {
            1: '#FFBF00',
            2: '#BEBEBE',
            3: '#A0522D',
        };

        function buildCard(p) {
            const accentColor = PODIUM_COLORS[p.posicion] || 'transparent';

            const flag = (p.pais && p.pais.image)
                ? '<img src="' + p.pais.image + '" alt="' + p.pais.name + '" class="w-6 aspect-6/3 object-cover shrink-0">'
                : '';

            const country = (p.pais && p.pais.name) ? p.pais.name : '';

            return '<div class="flex items-center bg-light rounded-2xl shadow-md shadow-zinc-400 w-full max-w-140 pl-2 pr-4 py-3 border-l-8 hover:-translate-y-0.5 transition-all ease-in-out duration-300" style="border-left-color: ' + accentColor + '">'
                + '<span class="text-sm lg:text-base font-bold text-dark min-w-9 text-center lg:mr-2">' + p.posicion + '°</span>'
                + '<div class="w-10 h-10 rounded-full overflow-hidden bg-complementary-primary shrink-0 mr-2 lg:mr-3">'
                +     '<img src="' + p.image + '" alt="' + p.nombres + '" class="w-full h-full object-cover">'
                + '</div>'
                + '<div class="flex-1 min-w-0">'
                +     '<p class="text-xs lg:text-base font-semibold text-dark truncate">' + p.nombres + ' ' + p.apellidos + '</p>'
                +     '<p class="text-xs lg:text-sm text-complementary-dark flex items-center gap-1.5 truncate">'
                +         flag
                +         '<span class="truncate">' + country + '</span>'
                +     '</p>'
                + '</div>'
                + '<span class="text-dark text-sm lg:text-base font-semibold shrink-0">' + p.puntos + ' pts</span>'
                + '</div>';
        }

        function renderList(participantes) {
            const html = participantes.map(buildCard).join('');
            rankingList.insertAdjacentHTML('beforeend', html);
        }

        function fetchRanking(page) {
            if (loading) return;
            loading = true;

            loader.classList.remove('hidden');
            btnCargarMas.classList.add('hidden');

            axios.get('{{ route("web.users.ranking.data") }}', {
                params: { page: page }
            })
            .then(function (response) {
                const data = response.data.data.users;
                const hasMore = response.data.data.has_more;

                if (data.length === 0 && page === 1) {
                    emptyState.classList.remove('hidden');
                    return;
                }

                renderList(data);

                if (hasMore) {
                    btnCargarMas.classList.remove('hidden');
                }

                currentPage = page;
            })
            .catch(function (error) {
                console.error('Error cargando ranking:', error);
            })
            .finally(function () {
                loading = false;
                loader.classList.add('hidden');
            });
        }

        btnCargarMas.addEventListener('click', function () {
            fetchRanking(currentPage + 1);
        });

        fetchRanking(1);
    });
</script>