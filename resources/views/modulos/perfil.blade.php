<x-app-layout>
    <div class="py-6 sm:px-4 lg:px-8 bg-secondary-light rounded-t-4xl h-full flex-1">

        <h1 class="text-3xl 2xl:text-4xl text-center text-dark font-bold mt-2 mb-6">Mi Cuenta</h1>

        <div class="overflow-hidden xl:max-w-2xl 2xl:max-w-3xl w-full mx-auto">
            <div class="px-6 pb-6">

                {{-- Avatar --}}
                <div class="relative w-24 h-24 mx-auto mb-3">
                    <div id="user-avatar-display" class="w-24 h-24 rounded-full border-4 border-primary flex items-center justify-center overflow-hidden p-1">
                        @if(!empty($user->avatar))
                            <img src="{{ asset($user->avatar->url) }}" alt="Avatar" class="w-full h-full object-cover rounded-full">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-light" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        @endif
                    </div>
                    <button
                        type="button"
                        id="btn-edit-avatar"
                        class="absolute bottom-0 right-0 w-8 h-8 rounded-full bg-primary text-light flex items-center justify-center shadow-md hover:brightness-110 transition-all cursor-pointer"
                        aria-label="Editar avatar"
                    >
                        <span class="icon-[material-symbols--edit] w-4 h-4"></span>
                    </button>
                </div>

                {{-- User Name --}}
                <p class="text-xl font-bold text-dark text-center mb-3">{{ $user->nombres }} {{ $user->apellidos }}</p>

                @if (!empty($user->line))
                    <p class="text-light mx-auto w-max bg-primary px-4 py-1.5 rounded-full mb-8 font-semibold text-sm">{{ $user->line->name }}</p>
                @endif

                {{-- Preferencias --}}
                <div class="w-full max-w-lg mx-auto">

                    {{-- País --}}
                    @if (!empty($user->country))
                        <div class="w-full flex items-center gap-3 py-3 mb-2 pointer-events-none">
                            <img
                                src="{{ asset($user->country->image) }}"
                                alt="{{ $user->country->name }}"
                                class="w-10 aspect-6/3 object-cover"
                            >
                            <span class="tracking-wide text-dark">{{ $user->country->name }}</span>
                        </div>
                    @endif

                    {{-- Sección: Juego --}}
                    <h2 class="text-base font-bold text-dark text-center mt-6 mb-2">Juego</h2>

                    <a
                        href="{{ route('web.reglas') }}"
                        class="w-full flex items-center gap-3 py-3 text-dark hover:text-complementary-secondary transition-colors duration-150 cursor-pointer"
                    >
                        <span class="icon-[material-symbols--menu-book] w-7 h-7"></span>
                        <span class="flex-1 text-left">Reglas del juego</span>
                        <span class="icon-[material-symbols--chevron-right-rounded] w-6 h-6"></span>
                    </a>

                    {{-- Sección: Legal --}}
                    <h2 class="text-base font-bold text-dark text-center mt-6 mb-2">Legal</h2>

                    <button
                        type="button"
                        id="btn-open-terms"
                        class="w-full flex items-center gap-3 py-3 text-dark hover:text-complementary-secondary transition-colors duration-150 cursor-pointer"
                    >
                        <span class="icon-[material-symbols--gavel] w-7 h-7"></span>
                        <span class="flex-1 text-left">Términos y condiciones</span>
                        <span class="icon-[material-symbols--chevron-right-rounded] w-6 h-6"></span>
                    </button>

                    <button
                        type="button"
                        id="btn-open-privacy"
                        class="w-full flex items-center gap-3 py-3 text-dark hover:text-complementary-secondary transition-colors duration-150 cursor-pointer"
                    >
                        <span class="icon-[material-symbols--shield] w-7 h-7"></span>
                        <span class="flex-1 text-left">Política de privacidad</span>
                        <span class="icon-[material-symbols--chevron-right-rounded] w-6 h-6"></span>
                    </button>

                    {{-- Cerrar sesión --}}
                    <button
                        type="button"
                        id="btn-logout"
                        class="w-full flex items-center gap-3 py-3 mt-4 text-dark hover:text-red-500 transition-colors duration-150 cursor-pointer"
                    >
                        <span class="icon-[material-symbols--logout] w-7 h-7 text-red-500"></span>
                        <span class="flex-1 text-left">Salir</span>
                    </button>

                    {{-- Separador --}}
                    <hr class="border-complementary-dark/30 my-6">

                    {{-- Zona de peligro --}}
                    <div class="border border-red-500/40 rounded-2xl p-4">
                        <p class="flex items-center gap-2 text-red-600 font-bold uppercase text-sm mb-3">
                            <span class="icon-[material-symbols--warning-rounded] w-5 h-5"></span>
                            Zona de peligro
                        </p>
                        <div class="h-px bg-red-500/30 mb-3"></div>
                        <button
                            type="button"
                            id="btn-delete-account"
                            class="w-full flex items-center gap-3 text-red-600 hover:text-red-500 transition-colors duration-150 cursor-pointer"
                        >
                            <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center shrink-0">
                                <span class="icon-[material-symbols--delete-outline] w-5 h-5"></span>
                            </div>
                            <div class="flex-1 text-left">
                                <p class="font-bold">Eliminar cuenta</p>
                                <p class="text-xs text-zinc-500">Esta acción no se puede deshacer.</p>
                            </div>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Términos y Condiciones --}}
    <x-terms-view-modal :terms="$terms" />

    {{-- Modal Política de Privacidad --}}
    <x-privacy-view-modal :privacy="$privacy" />

    {{-- Modal Editar Avatar --}}
    <x-avatar-edit-modal :avatars="$avatars" :user="$user" />

    {{-- Modal Eliminar Cuenta --}}
    <div id="modal-delete-account" class="pointer-events-none fixed inset-0 z-50 flex items-center justify-center p-4">

        {{-- Backdrop --}}
        <div id="modal-delete-account-backdrop" class="absolute inset-0 bg-black/70 opacity-0 transition-opacity duration-200"></div>

        {{-- Panel --}}
        <div id="modal-delete-account-panel" class="relative bg-light rounded-2xl shadow-xl w-full max-w-md scale-90 opacity-0 transition-[transform,opacity] duration-200 ease-out">
            <div class="p-6">
                <h3 class="text-2xl text-dark text-left mb-4">Eliminar cuenta</h3>
                <p class="text-dark text-left text-sm mb-6">
                    Se eliminarán permanentemente tus pronósticos, ranking y datos personales. Esta acción no se puede deshacer.
                </p>

                <div class="flex items-center justify-end gap-4">
                    <button
                        type="button"
                        id="modal-delete-account-cancel"
                        class="text-dark transition-colors cursor-pointer">
                        Cancelar
                    </button>

                    <button
                        type="button"
                        id="modal-delete-account-confirm"
                        class="text-red-600 hover:text-red-500 transition-colors cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                        Eliminar cuenta
                    </button>
                </div>
            </div>
        </div>
    </div>

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

            // Helper: drawer/modal con backdrop deslizable desde abajo
            const wireDrawer = ({ modalId, backdropId, panelId, triggerId, closeId, hiddenClasses }) => {
                const modal    = document.getElementById(modalId);
                const backdrop = document.getElementById(backdropId);
                const panel    = document.getElementById(panelId);
                const trigger  = document.getElementById(triggerId);
                const closeBtn = closeId ? document.getElementById(closeId) : null;

                if (!modal || !backdrop || !panel || !trigger) return;

                const open = () => {
                    modal.classList.remove('pointer-events-none');
                    backdrop.classList.remove('opacity-0');
                    hiddenClasses.forEach(c => panel.classList.remove(c));
                    document.body.style.overflow = 'hidden';
                };

                const close = () => {
                    backdrop.classList.add('opacity-0');
                    hiddenClasses.forEach(c => panel.classList.add(c));
                    document.body.style.overflow = '';
                    panel.addEventListener('transitionend', () => {
                        modal.classList.add('pointer-events-none');
                    }, { once: true });
                };

                trigger.addEventListener('click', open);
                if (closeBtn) closeBtn.addEventListener('click', close);
                backdrop.addEventListener('click', close);

                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && !modal.classList.contains('pointer-events-none')) close();
                });
            };

            // Logout (modal centrado con escala)
            wireDrawer({
                modalId:    'modal-logout',
                backdropId: 'modal-logout-backdrop',
                panelId:    'modal-logout-panel',
                triggerId:  'btn-logout',
                closeId:    'modal-logout-cancel',
                hiddenClasses: ['scale-90', 'opacity-0'],
            });

            // Términos y condiciones (drawer)
            wireDrawer({
                modalId:    'modal-terms-view',
                backdropId: 'modal-terms-view-backdrop',
                panelId:    'modal-terms-view-panel',
                triggerId:  'btn-open-terms',
                closeId:    'btn-cerrar-terms-view',
                hiddenClasses: ['translate-y-full', 'opacity-0'],
            });

            // Política de privacidad (drawer)
            wireDrawer({
                modalId:    'modal-privacy-view',
                backdropId: 'modal-privacy-view-backdrop',
                panelId:    'modal-privacy-view-panel',
                triggerId:  'btn-open-privacy',
                closeId:    'btn-cerrar-privacy-view',
                hiddenClasses: ['translate-y-full', 'opacity-0'],
            });

            // Eliminar cuenta (modal centrado con escala) + confirmación AJAX
            const deleteModal    = document.getElementById('modal-delete-account');
            const deleteBackdrop = document.getElementById('modal-delete-account-backdrop');
            const deletePanel    = document.getElementById('modal-delete-account-panel');
            const deleteTrigger  = document.getElementById('btn-delete-account');
            const deleteCancel   = document.getElementById('modal-delete-account-cancel');
            const deleteConfirm  = document.getElementById('modal-delete-account-confirm');

            const openDelete = () => {
                deleteModal.classList.remove('pointer-events-none');
                deleteBackdrop.classList.remove('opacity-0');
                deletePanel.classList.remove('scale-90', 'opacity-0');
                document.body.style.overflow = 'hidden';
            };

            const closeDelete = () => {
                deleteBackdrop.classList.add('opacity-0');
                deletePanel.classList.add('scale-90', 'opacity-0');
                document.body.style.overflow = '';
                deletePanel.addEventListener('transitionend', () => {
                    deleteModal.classList.add('pointer-events-none');
                }, { once: true });
            };

            deleteTrigger.addEventListener('click', openDelete);
            deleteCancel.addEventListener('click', closeDelete);
            deleteBackdrop.addEventListener('click', closeDelete);

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !deleteModal.classList.contains('pointer-events-none') && !deleteConfirm.disabled) closeDelete();
            });

            deleteConfirm.addEventListener('click', async () => {
                deleteConfirm.disabled = true;
                deleteCancel.disabled  = true;

                try {
                    await window.axios.delete('{{ route('web.users.perfil.delete') }}');
                    window.location.href = '{{ route('ingresa') }}';
                } catch (error) {
                    deleteConfirm.disabled = false;
                    deleteCancel.disabled  = false;
                    alert('No se pudo eliminar la cuenta. Inténtalo nuevamente.');
                }
            });

            // Editar avatar
            const avatarModal    = document.getElementById('modal-avatar-edit');
            const avatarBackdrop = document.getElementById('modal-avatar-edit-backdrop');
            const avatarPanel    = document.getElementById('modal-avatar-edit-panel');
            const avatarTrigger  = document.getElementById('btn-edit-avatar');
            const avatarCancel   = document.getElementById('modal-avatar-edit-cancel');
            const avatarConfirm  = document.getElementById('modal-avatar-edit-confirm');
            const avatarOptions  = avatarPanel.querySelectorAll('.avatar-option');
            const avatarDisplay  = document.getElementById('user-avatar-display');

            let currentAvatarId  = parseInt(avatarPanel.dataset.currentAvatarId, 10) || null;
            let selectedAvatarId = currentAvatarId;
            let selectedAvatarUrl = null;

            new Swiper('.avatar-edit-swiper', {
                slidesPerView: 'auto',
                spaceBetween: 16,
                centerInsufficientSlides: true,
                navigation: {
                    nextEl: '.avatar-edit-swiper-next',
                    prevEl: '.avatar-edit-swiper-prev',
                },
            });

            const openAvatar = () => {
                avatarModal.classList.remove('pointer-events-none');
                avatarBackdrop.classList.remove('opacity-0');
                avatarPanel.classList.remove('translate-y-full', 'opacity-0');
                document.body.style.overflow = 'hidden';
            };

            const closeAvatar = () => {
                avatarBackdrop.classList.add('opacity-0');
                avatarPanel.classList.add('translate-y-full', 'opacity-0');
                document.body.style.overflow = '';
                avatarPanel.addEventListener('transitionend', () => {
                    avatarModal.classList.add('pointer-events-none');
                }, { once: true });
            };

            const refreshConfirm = () => {
                avatarConfirm.disabled = !selectedAvatarId || selectedAvatarId === currentAvatarId;
            };

            avatarOptions.forEach(btn => {
                btn.addEventListener('click', () => {
                    avatarOptions.forEach(b => b.querySelector('.avatar-option-img').classList.replace('border-primary', 'border-transparent'));
                    btn.querySelector('.avatar-option-img').classList.replace('border-transparent', 'border-primary');
                    selectedAvatarId  = parseInt(btn.dataset.avatarId, 10);
                    selectedAvatarUrl = btn.dataset.avatarUrl;
                    refreshConfirm();
                });
            });

            avatarTrigger.addEventListener('click', openAvatar);
            avatarCancel.addEventListener('click', closeAvatar);
            avatarBackdrop.addEventListener('click', closeAvatar);

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !avatarModal.classList.contains('pointer-events-none')) closeAvatar();
            });

            avatarConfirm.addEventListener('click', async () => {
                if (avatarConfirm.disabled) return;

                avatarConfirm.disabled = true;

                try {
                    const { data } = await window.axios.post(
                        '{{ route('web.users.perfil.avatar.update') }}',
                        { avatar_id: selectedAvatarId }
                    );

                    const newUrl = data?.data?.avatar?.url ?? selectedAvatarUrl;

                    if (newUrl && avatarDisplay) {
                        avatarDisplay.innerHTML = `<img src="${newUrl}" alt="Avatar" class="w-full h-full object-cover">`;
                    }

                    currentAvatarId = selectedAvatarId;
                    avatarPanel.dataset.currentAvatarId = String(currentAvatarId);
                    refreshConfirm();
                    closeAvatar();
                } catch (error) {
                    avatarConfirm.disabled = false;
                    alert('No se pudo actualizar el avatar. Inténtalo nuevamente.');
                }
            });
        });
    </script>
</x-app-layout>
