@props(['avatars', 'user'])

<div id="modal-avatar-edit" class="pointer-events-none fixed inset-0 z-50 flex items-end sm:items-center justify-center p-0 sm:p-4">

    {{-- Backdrop --}}
    <div id="modal-avatar-edit-backdrop" class="absolute inset-0 bg-black/70 opacity-0 transition-opacity duration-300"></div>

    {{-- Panel --}}
    <div
        id="modal-avatar-edit-panel"
        class="relative bg-light rounded-t-3xl sm:rounded-3xl w-full sm:max-w-md lg:max-w-3xl flex flex-col translate-y-full opacity-0 transition-[transform,opacity] duration-300 ease-out"
        data-current-avatar-id="{{ $user->avatar_id }}"
    >
        {{-- Drag handle --}}
        {{-- <div class="pt-3 pb-1 flex justify-center">
            <div class="w-12 h-1.5 bg-zinc-400 rounded-full"></div>
        </div> --}}

        {{-- Header --}}
        <div class="px-6 py-4 flex items-center justify-between">
            <h3 class="font-bold text-dark text-lg">Elige tu avatar</h3>
            <button
                type="button"
                id="modal-avatar-edit-cancel"
                class="text-primary font-bold cursor-pointer hover:text-secondary transition-colors"
            >
                Cancelar
            </button>
        </div>

        {{-- Swiper --}}
        <div class="px-6 lg:px-8 py-4 relative">
            <div class="swiper avatar-edit-swiper">
                <div class="swiper-wrapper">
                    @foreach($avatars as $avatar)
                        <div class="swiper-slide !w-auto">
                            <button
                                type="button"
                                class="avatar-option flex flex-col items-center gap-2 cursor-pointer focus:outline-none"
                                data-avatar-id="{{ $avatar->id }}"
                                data-avatar-url="{{ asset($avatar->url) }}"
                                data-avatar-name="{{ $avatar->name }}"
                            >
                                <div class="avatar-option-img w-28 h-28 p-1 rounded-full overflow-hidden border-4 transition-colors {{ (int) $user->avatar_id === (int) $avatar->id ? 'border-primary' : 'border-transparent' }}">
                                    <img src="{{ asset($avatar->url) }}" alt="{{ $avatar->name }}" class="w-full h-full object-cover rounded-full">
                                </div>
                                <span class="font-bold text-dark capitalize">{{ $avatar->name }}</span>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Navigation arrows (solo lg+) --}}
            <button
                type="button"
                class="avatar-edit-swiper-prev hidden lg:flex absolute left-1 top-1/2 -translate-y-1/2 z-10 w-10 h-10 items-center justify-center rounded-full bg-primary text-light hover:bg-secondary hover:text-dark transition-colors cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed"
                aria-label="Anterior"
            >
                <span class="icon-[material-symbols--chevron-left-rounded] w-7 h-7"></span>
            </button>
            <button
                type="button"
                class="avatar-edit-swiper-next hidden lg:flex absolute right-1 top-1/2 -translate-y-1/2 z-10 w-10 h-10 items-center justify-center rounded-full bg-primary text-light hover:bg-secondary hover:text-dark transition-colors cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed"
                aria-label="Siguiente"
            >
                <span class="icon-[material-symbols--chevron-right-rounded] w-7 h-7"></span>
            </button>
        </div>

        {{-- Hint (oculto en lg+) --}}
        <div class="px-6 py-2 flex lg:hidden items-center justify-center gap-2 text-primary font-bold">
            <span class="icon-[material-symbols--arrow-back-rounded] w-5 h-5"></span>
            Desliza para explorar
            <span class="icon-[material-symbols--arrow-forward-rounded] w-5 h-5"></span>
        </div>

        {{-- Confirm button --}}
        <div class="px-6 py-4">
            <button
                type="button"
                id="modal-avatar-edit-confirm"
                class="w-full bg-primary text-light rounded-full px-6 py-3 hover:brightness-110 focus:ring-3 focus:ring-dark disabled:bg-zinc-400 disabled:cursor-not-allowed disabled:hover:brightness-100 flex items-center justify-center gap-2 transition-all duration-200"
                disabled
            >
                <span class="icon-[material-symbols--check-circle-outline] w-6 h-6"></span>
                Confirmar avatar
            </button>
        </div>
    </div>
</div>
