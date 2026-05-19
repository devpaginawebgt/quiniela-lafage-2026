<input type="hidden" id="user_id" value="{{ Auth::user()->id }}">

@php
$items = [
    [
        'route' => 'web.proximos-partidos',
        'match' => 'web.proximos-partidos',
        'icon' => 'icon-[material-symbols--sports-soccer]',
        'label' => 'Próximos',
        'show' => true,
    ],
    [
        'route' => 'web.mis-predicciones',
        'match' => 'web.mis-predicciones',
        'icon' => 'icon-[material-symbols--fact-check-outline]',
        'label' => 'Resultados',
        'show' => true,
    ],
    [
        'route' => 'web.partidos',
        'match' => 'web.partidos',
        'icon' => 'icon-[material-symbols--scoreboard-outline]',
        'label' => 'Partidos',
        'show' => true,
    ],
    [
        'route' => 'web.users.ranking',
        'match' => 'web.users.ranking',
        'icon' => 'icon-[material-symbols--leaderboard-outline]',
        'label' => 'Ranking',
        'show' => true,
    ],
    [
        'route' => 'web.admin.reports.users.index',
        'match' => 'web.admin.*',
        'icon' => 'icon-[material-symbols--admin-panel-settings-outline]',
        'label' => 'Admin',
        'show' => Auth::user()->hasRole('admin'),
    ],
    [
        'route' => 'web.users.perfil',
        'match' => 'web.users.perfil',
        'icon' => 'icon-[material-symbols--person-outline]',
        'label' => 'Perfil',
        'show' => true,
    ],
];
@endphp

{{-- Bottom Navigation Bar --}}
<nav class="fixed bottom-0 left-0 right-0 z-40 bg-light border-t border-dark">
    <div class="flex justify-around items-center h-16 max-w-lg mx-auto px-4">

        @foreach($items as $item)
        @continue(! $item['show'])

        @php $active = request()->routeIs($item['match']); @endphp

        <a href="{{ route($item['route']) }}"
            @class([ 'flex flex-col items-center gap-1 text-xs font-medium transition-colors duration-150 text-dark' , 'hover:text-primary gap-2'=> !$active,
            ])>
            <span @class([ 'flex items-center rounded-full transition-colors' , 'bg-secondary text-light px-3 py-1'=> $active,
                ])>
                <span class="{{ $item['icon'] }} w-5 h-5 lg:w-6 lg:h-6"></span>
            </span>
            <span>{{ $item['label'] }}</span>
        </a>
        @endforeach

    </div>
</nav>