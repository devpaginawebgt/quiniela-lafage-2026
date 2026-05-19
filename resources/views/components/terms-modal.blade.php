@props(['terms'])

<div id="modal-terms" class="pointer-events-none fixed inset-0 z-50 flex items-end sm:items-center justify-center p-0 sm:p-4">

    {{-- Backdrop --}}
    <div id="modal-terms-backdrop" class="absolute inset-0 bg-black/70 opacity-0 transition-opacity duration-300"></div>

    {{-- Panel --}}
    <div id="modal-terms-panel" class="relative bg-light rounded-t-3xl sm:rounded-3xl overflow-hidden w-full sm:max-w-3xl max-h-[90dvh] flex flex-col translate-y-full opacity-0 transition-[transform,opacity] duration-300 ease-out">

        {{-- Header --}}
        <div class="shrink-0 pt-4 pb-4 px-6">
            {{-- Pill decorativa --}}
            <img
                src="{{ asset('images/logos/logo-dark.png') }}"
                class="w-full max-w-20 2xl:max-w-32 mx-auto mb-2"
                alt="{{ config('app.name', 'Quiniela') }}"
            >
            <div class="w-full h-0.5 bg-complementary-dark mb-3"></div>
            {{-- <h2 class="text-xl font-bold text-center">Términos y Condiciones</h2> --}}
        </div>

        {{-- Scrollable content --}}
        <div class="overflow-y-auto flex-1 px-6 pb-4 mb-4">
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

        {{-- Footer --}}
        <div class="shrink-0 px-6 py-4 border-t border-complementary-dark">
            <label class="flex items-start gap-3 mb-4 cursor-pointer w-max">
                <input
                    type="checkbox"
                    id="terms-checkbox"
                    class="mt-0.5 w-5 h-5 rounded border-complementary-dark text-primary focus:ring-dark focus:ring-2 shrink-0"
                >
                <span class="text-sm text-dark mt-0.5">He leído y acepto los términos y condiciones</span>
            </label>

            <button
                type="button"
                id="btn-confirmar-terms"
                disabled
                class="w-full bg-primary text-light font-bold rounded-full px-6 py-3 flex items-center justify-center gap-2 disabled:bg-zinc-400 disabled:opacity-40 disabled:cursor-not-allowed hover:brightness-[1.1] focus:ring-3 focus:ring-white transition-opacity"
            >
                Confirmar y Crear Cuenta
            </button>
        </div>

    </div>

    {{-- Versión de los términos (valor usado por JS) --}}
    <input type="hidden" id="terms-version-value" value="{{ $terms->version }}">
</div>
