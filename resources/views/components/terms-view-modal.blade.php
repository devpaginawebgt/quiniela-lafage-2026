@props(['terms'])

<div id="modal-terms-view" class="pointer-events-none fixed inset-0 z-50 flex items-end sm:items-center justify-center p-0 sm:p-4">

    {{-- Backdrop --}}
    <div id="modal-terms-view-backdrop" class="absolute inset-0 bg-black/70 opacity-0 transition-opacity duration-300"></div>

    {{-- Panel --}}
    <div id="modal-terms-view-panel" class="relative bg-light rounded-t-3xl sm:rounded-3xl overflow-hidden w-full sm:max-w-3xl max-h-[90dvh] flex flex-col translate-y-full opacity-0 transition-[transform,opacity] duration-300 ease-out p-4">

        {{-- Header --}}
        <div class="shrink-0 pt-4 pb-4 px-6 relative">
            {{-- Botón cerrar --}}
            <button
                type="button"
                id="btn-cerrar-terms-view"
                class="absolute top-2 right-2 w-9 h-9 inline-flex items-center justify-center rounded-full text-dark hover:bg-complementary-light/40 transition-colors cursor-pointer"
                aria-label="Cerrar"
            >
                <span class="icon-[material-symbols--close-rounded] w-6 h-6"></span>
            </button>

            <img
                src="{{ asset('images/logos/logo-dark.png') }}"
                class="w-full max-w-20 2xl:max-w-32 mx-auto mb-2"
                alt="{{ config('app.name', 'Quiniela') }}"
            >
            <div class="w-full h-0.5 bg-complementary-dark mb-3"></div>
        </div>

        {{-- Scrollable content --}}
        <div class="overflow-y-auto flex-1 px-6 pb-4">
            <div class="prose prose-invert prose-sm max-w-none
                prose-headings:text-dark prose-headings:font-bold
                prose-p:text-dark prose-p:leading-relaxed
                prose-a:text-primary prose-a:no-underline hover:prose-a:underline
                prose-strong:text-dark
                prose-li:text-dark
            ">
                {!! Str::markdown($terms->content) !!}
            </div>
        </div>

    </div>
</div>
