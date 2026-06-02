<x-admin-layout>
    <div class="w-full h-full mx-auto flex-1 flex justify-center items-center">
        @can('admin.enviar-notificaciones-push')
            @include('modulos.admin.partials.notification-form', ['notification' => $notification])
        @endcan
    </div>
</x-admin-layout>
