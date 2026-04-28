<x-app-layout>
    <h1 class="text-3xl 2xl:text-4xl text-center text-light font-bold mt-2 mb-8">Mi Cuenta</h1>

    <div class="py-6 sm:px-4 lg:px-8 bg-secondary-light rounded-t-4xl h-full flex-1">
        <div class="overflow-hidden xl:max-w-5xl 2xl:max-w-440 w-full mx-auto">
            <div class="px-6 pb-6">
                {{-- Avatar --}}
                <div class="flex justify-center mb-3">
                    <div class="w-20 h-20 rounded-full bg-dark flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-light" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                </div>

                {{-- User Name --}}
                <p class="text-xl font-bold text-dark text-center mb-4">{{ $user->nombres }} {{ $user->apellidos }}</p>

                <p class="text-light mx-auto w-max bg-primary px-3 py-1 rounded-full mb-8">{{ $user->line->name }}</p>

                {{-- Preferencias --}}
                <div class="w-full max-w-lg mx-auto">
                    {{-- País --}}
                    <div class="w-full flex items-center justify-between pb-2 mb-2 pointer-events-none">
                        <div class="flex items-center gap-3">
                            <img
                                src="{{ asset($user->country->image) }}"
                                alt="{{ $user->country->name }}"
                                class="w-full max-w-10 aspect-6/3 object-cover"
                            >
                            <span class="tracking-wide">{{ $user->country->name }}</span>
                        </div>
                    </div>

                    {{-- Términos y condiciones --}}
                    <button
                        type="button"
                        id="btn-open-terms"
                        class="w-full flex items-center gap-3 py-3 text-dark hover:text-complementary-secondary transition-colors duration-150 cursor-pointer">
                        <span class="icon-[material-symbols--info] w-7 h-7"></span>
                        <span class="flex-1 text-left">Términos y condiciones</span>
                        <span class="icon-[material-symbols--chevron-right-rounded] w-6 h-6"></span>
                    </button>

                    {{-- Cerrar sesión --}}
                    <button
                        type="button"
                        id="btn-logout"
                        class="w-full flex items-center gap-2 py-3 text-dark hover:text-red-400 transition-colors duration-150 cursor-pointer">
                        <span class="text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24"><path fill="currentColor" d="m17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5M4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4z"/></svg>
                        </span>
                        Salir
                    </button>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Términos y Condiciones --}}
    <x-terms-view-modal :terms="$terms" />

    {{-- Modal Cerrar Sesión --}}
    <div id="modal-logout" class="pointer-events-none fixed inset-0 z-50 flex items-center justify-center p-4">

        {{-- Backdrop --}}
        <div id="modal-logout-backdrop" class="absolute inset-0 bg-black/70 opacity-0 transition-opacity duration-200"></div>

        {{-- Panel --}}
        <div id="modal-logout-panel" class="relative bg-light rounded-2xl shadow-xl w-full max-w-md scale-90 opacity-0 transition-[transform,opacity] duration-200 ease-out">
            <div class="p-6">
                <h3 class="text-2xl text-dark text-left mb-4">Cerrar sesión</h3>
                <p class="text-dark text-left text-sm mb-6">¿Deseas cerrar tu sesión actual?</p>

                <div class="flex items-center justify-end gap-4">
                    <button
                        type="button"
                        id="modal-logout-cancel"
                        class="text-blue-600 hover:text-blue-500 transition-colors cursor-pointer">
                        Cancelar
                    </button>

                    <form method="POST" action="{{ route('web.logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="text-red-600 hover:text-red-500 transition-colors cursor-pointer">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal    = document.getElementById('modal-logout');
            const backdrop = document.getElementById('modal-logout-backdrop');
            const panel    = document.getElementById('modal-logout-panel');
            const trigger  = document.getElementById('btn-logout');
            const cancel   = document.getElementById('modal-logout-cancel');

            const open = () => {
                modal.classList.remove('pointer-events-none');
                backdrop.classList.remove('opacity-0');
                panel.classList.remove('scale-90', 'opacity-0');
                document.body.style.overflow = 'hidden';
            };

            const close = () => {
                backdrop.classList.add('opacity-0');
                panel.classList.add('scale-90', 'opacity-0');
                document.body.style.overflow = '';
                panel.addEventListener('transitionend', () => {
                    modal.classList.add('pointer-events-none');
                }, { once: true });
            };

            trigger.addEventListener('click', open);
            cancel.addEventListener('click', close);
            backdrop.addEventListener('click', close);

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !modal.classList.contains('pointer-events-none')) close();
            });

            // Modal Términos y Condiciones (solo lectura)
            const termsModal    = document.getElementById('modal-terms-view');
            const termsBackdrop = document.getElementById('modal-terms-view-backdrop');
            const termsPanel    = document.getElementById('modal-terms-view-panel');
            const termsTrigger  = document.getElementById('btn-open-terms');
            const termsClose    = document.getElementById('btn-cerrar-terms-view');

            const openTerms = () => {
                termsModal.classList.remove('pointer-events-none');
                termsBackdrop.classList.remove('opacity-0');
                termsPanel.classList.remove('translate-y-full', 'opacity-0');
                document.body.style.overflow = 'hidden';
            };

            const closeTerms = () => {
                termsBackdrop.classList.add('opacity-0');
                termsPanel.classList.add('translate-y-full', 'opacity-0');
                document.body.style.overflow = '';
                termsPanel.addEventListener('transitionend', () => {
                    termsModal.classList.add('pointer-events-none');
                }, { once: true });
            };

            termsTrigger.addEventListener('click', openTerms);
            termsClose.addEventListener('click', closeTerms);
            termsBackdrop.addEventListener('click', closeTerms);

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !termsModal.classList.contains('pointer-events-none')) closeTerms();
            });
        });
    </script>
</x-app-layout>
