<x-app-layout>
    <div class="py-6 sm:px-4 lg:px-8 bg-secondary-light rounded-t-4xl flex flex-col h-[calc(100dvh-9rem)]">
        <div class="w-full max-w-xl mx-auto px-6 pb-6 flex flex-col flex-1 min-h-0">

            <h1 class="text-3xl 2xl:text-4xl text-center text-dark font-bold mt-2 mb-6 shrink-0">Reglas del juego</h1>

            <div class="swiper reglas-swiper flex-1 min-h-0 w-full">
                <div class="swiper-wrapper">

                    {{-- Slide 1: Pronósticos --}}
                    <div class="swiper-slide">
                        <div class="flex flex-col gap-6 pb-4">
                            <div class="flex justify-center items-center gap-4">
                                <img
                                    src="{{ asset('images/decoracion/step1.png') }}"
                                    alt="Pronósticos"
                                    class="w-28 h-28 object-contain shrink-0"
                                >
                                <h2 class="text-2xl font-bold text-dark">Pronósticos</h2>
                            </div>

                            <div class="flex flex-col">
                                <div class="flex items-center gap-4 py-4">
                                    <span class="icon-[material-symbols--sports-soccer] w-8 h-8 text-dark shrink-0"></span>
                                    <div class="flex-1">
                                        <p class="font-bold text-dark">Ambos marcadores exactos</p>
                                        <p class="text-sm text-zinc-600">Acierta el marcador de ambos equipos</p>
                                    </div>
                                    <span class="text-primary font-bold text-2xl shrink-0">+5</span>
                                </div>

                                <hr class="border-complementary-dark/20">

                                <div class="flex items-center gap-4 py-4">
                                    <span class="icon-[material-symbols--sports-soccer] w-8 h-8 text-dark shrink-0"></span>
                                    <div class="flex-1">
                                        <p class="font-bold text-dark">Equipo ganador</p>
                                        <p class="text-sm text-zinc-600">Acierta el ganador sin marcador exacto</p>
                                    </div>
                                    <span class="text-primary font-bold text-2xl shrink-0">+3</span>
                                </div>

                                <hr class="border-complementary-dark/20">

                                <div class="flex items-center gap-4 py-4">
                                    <span class="icon-[material-symbols--sports-soccer] w-8 h-8 text-dark shrink-0"></span>
                                    <div class="flex-1">
                                        <p class="font-bold text-dark">Empate</p>
                                        <p class="text-sm text-zinc-600">Acierta el empate sin marcador exacto</p>
                                    </div>
                                    <span class="text-primary font-bold text-2xl shrink-0">+1</span>
                                </div>

                                <hr class="border-complementary-dark/20">

                                <div class="flex items-center gap-4 py-4">
                                    <span class="icon-[material-symbols--sports-soccer] w-8 h-8 text-dark shrink-0"></span>
                                    <div class="flex-1">
                                        <p class="font-bold text-dark">Otro resultado</p>
                                        <p class="text-sm text-zinc-600">Cualquier otro resultado</p>
                                    </div>
                                    <span class="text-primary font-bold text-2xl shrink-0">+0</span>
                                </div>
                            </div>

                            <p class="text-center text-dark">
                                ¡Mientras más aciertos tengas, más subirás en el ranking!
                            </p>

                            <div class="flex justify-center items-center gap-3">
                                <span class="icon-[material-symbols--warning-rounded] w-7 h-7 text-yellow-500 shrink-0"></span>
                                <span class="font-bold text-dark">Los puntos no son acumulables</span>
                            </div>
                        </div>
                    </div>

                    {{-- Slide 2: Tiempo límite --}}
                    <div class="swiper-slide">
                        <div class="flex flex-col gap-6 pb-4">
                            <div class="flex justify-center items-center gap-4">
                                <img
                                    src="{{ asset('images/decoracion/step2.png') }}"
                                    alt="Tiempo límite"
                                    class="w-28 h-28 object-contain shrink-0"
                                >
                                <h2 class="text-2xl font-bold text-dark leading-tight">Pronóstico hasta 1 minuto antes</h2>
                            </div>

                            <p class="text-dark">
                                Puedes realizar todos tus pronósticos desde el inicio de la jornada o completarlos poco a poco antes de cada partido.
                            </p>

                            <hr class="border-complementary-dark/20">

                            <div>
                                <p class="text-dark mb-3">Una vez iniciado:</p>

                                <div class="flex items-start gap-3 py-2">
                                    <span class="icon-[material-symbols--cancel-outline] w-6 h-6 text-red-500 shrink-0"></span>
                                    <span class="text-dark">No podrás modificar resultados</span>
                                </div>

                                <div class="flex items-start gap-3 py-2">
                                    <span class="icon-[material-symbols--cancel-outline] w-6 h-6 text-red-500 shrink-0"></span>
                                    <span class="text-dark">No podrás ingresar nuevas predicciones</span>
                                </div>
                            </div>

                            <div>
                                <p class="font-bold text-dark mb-2">Predicciones ocultas</p>
                                <div class="flex items-start gap-3">
                                    <span class="icon-[material-symbols--lock-outline] w-6 h-6 text-dark shrink-0"></span>
                                    <span class="text-dark">Las predicciones de otros usuarios se mantienen ocultas hasta que el partido finalice.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Slide 3: Juego justo --}}
                    <div class="swiper-slide">
                        <div class="flex flex-col gap-6 pb-4">
                            <div class="flex justify-center items-center gap-4">
                                <img
                                    src="{{ asset('images/decoracion/step3.png') }}"
                                    alt="Juego justo"
                                    class="w-28 h-28 object-contain shrink-0"
                                >
                                <h2 class="text-2xl font-bold text-dark">Juego justo</h2>
                            </div>

                            <div>
                                <p class="font-bold text-dark mb-3">No se permite:</p>

                                <div class="flex items-start gap-3 py-2">
                                    <span class="icon-[material-symbols--cancel-outline] w-6 h-6 text-red-500 shrink-0"></span>
                                    <span class="text-dark">Crear múltiples cuentas</span>
                                </div>

                                <div class="flex items-start gap-3 py-2">
                                    <span class="icon-[material-symbols--cancel-outline] w-6 h-6 text-red-500 shrink-0"></span>
                                    <span class="text-dark">Alterar resultados</span>
                                </div>

                                <div class="flex items-start gap-3 py-2">
                                    <span class="icon-[material-symbols--cancel-outline] w-6 h-6 text-red-500 shrink-0"></span>
                                    <span class="text-dark">Utilizar automatizaciones</span>
                                </div>
                            </div>

                            <div>
                                <p class="font-bold text-dark mb-2">Cuentas sospechosas</p>
                                <div class="flex items-start gap-3">
                                    <span class="icon-[material-symbols--info-outline] w-6 h-6 text-dark shrink-0"></span>
                                    <span class="text-dark">Las cuentas sospechosas podrán ser suspendidas.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Pagination + CTA --}}
            <div class="mt-4 flex flex-col items-center gap-4 shrink-0">
                <div class="swiper-pagination reglas-pagination !static !w-auto flex items-center gap-2"></div>

                <button
                    type="button"
                    id="btn-reglas-next"
                    class="w-full bg-red-500 text-light font-bold rounded-lg px-6 py-3 hover:brightness-110 focus:ring-3 focus:ring-dark flex items-center justify-center gap-2 transition-all duration-200"
                >
                    <span class="icon-[material-symbols--arrow-forward-rounded] w-6 h-6"></span>
                    Siguiente
                </button>

                <button
                    type="button"
                    id="btn-reglas-done"
                    class="hidden w-full bg-red-500 text-light font-bold rounded-lg px-6 py-3 hover:brightness-110 focus:ring-3 focus:ring-dark flex items-center justify-center gap-2 transition-all duration-200"
                    data-url-home="{{ route('web.proximos-partidos') }}"
                >
                    <span class="icon-[material-symbols--check-rounded] w-6 h-6"></span>
                    ¡Entendido, a pronosticar!
                </button>
            </div>
        </div>
    </div>

    <style>
        .reglas-swiper .swiper-slide {
            overflow-y: auto;
            overscroll-behavior: contain;
        }
        .reglas-pagination .swiper-pagination-bullet {
            background-color: var(--color-complementary-dark);
            opacity: 0.35;
            width: 28px;
            height: 6px;
            border-radius: 9999px;
            margin: 0 !important;
            transition: background-color 0.2s, opacity 0.2s;
        }
        .reglas-pagination .swiper-pagination-bullet-active {
            background-color: var(--color-primary);
            opacity: 1;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btnNext = document.getElementById('btn-reglas-next');
            const btnDone = document.getElementById('btn-reglas-done');

            const swiper = new Swiper('.reglas-swiper', {
                spaceBetween: 24,
                allowTouchMove: true,
                pagination: {
                    el: '.reglas-pagination',
                    clickable: true,
                },
                on: {
                    slideChange() {
                        const isLast = this.isEnd;
                        btnNext.classList.toggle('hidden', isLast);
                        btnDone.classList.toggle('hidden', !isLast);
                    },
                },
            });

            btnNext.addEventListener('click', () => swiper.slideNext());

            btnDone.addEventListener('click', () => {
                window.location.href = btnDone.dataset.urlHome;
            });
        });
    </script>
</x-app-layout>
