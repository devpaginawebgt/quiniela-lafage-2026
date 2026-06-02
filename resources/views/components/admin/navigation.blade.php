<ul class="space-y-1">
    @can('admin.ver-reportes')
    <li>
        <a href="{{ route('web.admin.power-bi') }}"
            @class([ 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors text-light' , 'bg-secondary font-semibold'=> request()->routeIs('web.admin.power-bi'),
            'hover:bg-complementary-primary/40' => ! request()->routeIs('web.admin.power-bi'),
            ])>
            <span class="icon-[material-symbols--analytics-outline-rounded] w-5 h-5"></span>
            <span>Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('web.admin.reports.users.index') }}"
            @class([ 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors text-light' , 'bg-secondary font-semibold'=> request()->routeIs('web.admin.reports.users.*'),
            'hover:bg-complementary-primary/40' => ! request()->routeIs('web.admin.reports.users.*'),
            ])>
            <span class="icon-[material-symbols--group-outline-rounded] w-5 h-5"></span>
            <span>Usuarios Registrados</span>
        </a>
    </li>
    <li>
        <a href="{{ route('web.admin.reports.predictions.index') }}"
            @class([ 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors text-light' , 'bg-secondary font-semibold'=> request()->routeIs('web.admin.reports.predictions.*'),
            'hover:bg-complementary-primary/40' => ! request()->routeIs('web.admin.reports.predictions.*'),
            ])>
            <span class="icon-[material-symbols--fact-check-outline-rounded] w-5 h-5"></span>
            <span>Pronósticos Registrados</span>
        </a>
    </li>
    @endcan

    @can('admin.enviar-notificaciones-push')
    <li>
        <a href="{{ route('web.admin.notifications.index') }}"
            @class([
                'flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors text-light',
                'bg-secondary font-semibold' => request()->routeIs('web.admin.notifications.*'),
                'hover:bg-complementary-primary/40' => ! request()->routeIs('web.admin.notifications.*'),
            ])>
            <span class="icon-[material-symbols--notifications-active-outline-rounded] w-5 h-5"></span>
            <span>Notificaciones</span>
        </a>
    </li>
    @endcan
</ul>