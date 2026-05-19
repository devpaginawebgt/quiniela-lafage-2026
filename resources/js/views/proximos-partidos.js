import { initMarcadorButtons } from '../components/marcador.js';
import { showToastErrors } from '../components/toast-errors.js';

initMarcadorButtons();

document.addEventListener('DOMContentLoaded', () => {

    // Logica para cambiar de jornada 

    const select = document.getElementById('select-proximos-partidos');

    if (!select) return;

    select.addEventListener('change', () => {
        document.getElementById('form-proximos-partidos').submit();
    });

    // Logica para filtrar los registros de predicciones en la vista

    const buscar = document.getElementById('buscar-partidos');
    const lista  = document.getElementById('partidos-jornada-general');

    if (buscar && lista) {
        buscar.addEventListener('input', function () {
            const term = this.value.toLowerCase().trim();
            lista.querySelectorAll('li[data-equipos]').forEach(card => {
                card.style.display = (card.dataset.equipos ?? '').includes(term) ? '' : 'none';
            });
        });
    }

    // Logica para guardar predicciones via AJAX (por card)

    const prediccionesContainer = document.querySelector('[data-url-predicciones]');

    if (prediccionesContainer) {

        const urlPredicciones = prediccionesContainer.dataset.urlPredicciones;

        const parseMarcador = (input) => {
            if (!input || input.value === '') return null;
            const parsed = parseInt(input.value, 10);
            if (isNaN(parsed) || parsed < 0 || parsed > 25) return null;
            return parsed;
        };

        const refreshCardButton = (card) => {
            const btn = card.querySelector('.btn-guardar-prediccion');
            if (!btn) return;

            const inputEquipo1 = card.querySelector('.marcador-equipo-1');
            const inputEquipo2 = card.querySelector('.marcador-equipo-2');

            const valido = parseMarcador(inputEquipo1) !== null && parseMarcador(inputEquipo2) !== null;
            btn.disabled = !valido;
        };

        const setCardPronosticado = (card) => {
            card.dataset.pronosticado = '1';

            const banner = card.querySelector('[data-banner-pronostico]');
            if (banner) {
                banner.innerHTML = `
                    <div class="flex items-center gap-3 bg-green-100 text-green-600 rounded-2xl px-4 py-3">
                        <span class="icon-[material-symbols--check-circle] w-6 h-6 shrink-0"></span>
                        <span class="text-sm font-bold">Pronóstico registrado.</span>
                    </div>
                `;
            }

            const btn = card.querySelector('.btn-guardar-prediccion');
            if (btn) {
                btn.querySelector('[data-icon-guardar]')?.classList.add('hidden');
                btn.querySelector('[data-text-guardar]')?.classList.add('hidden');
                btn.querySelector('[data-icon-actualizar]')?.classList.remove('hidden');
                btn.querySelector('[data-text-actualizar]')?.classList.remove('hidden');
            }
        };

        const setBtnLoading = (btn, loading) => {
            btn.disabled = loading;
            btn.classList.toggle('opacity-70', loading);
            btn.classList.toggle('pointer-events-none', loading);
        };

        // Estado inicial de los botones
        document.querySelectorAll('[data-partido-id]').forEach(refreshCardButton);

        // Recalcular validez al editar marcador
        document.addEventListener('input', (e) => {
            if (!e.target.classList.contains('marcador-equipo')) return;
            const card = e.target.closest('[data-partido-id]');
            if (card) refreshCardButton(card);
        });

        // Click en guardar/actualizar
        document.addEventListener('click', (e) => {

            const btn = e.target.closest('.btn-guardar-prediccion');

            if (!btn || btn.disabled) return;

            console.log(btn);

            const card = btn.closest('[data-partido-id]');

            console.log(card);

            if (!card) return;

            const idPartido = parseInt(card.dataset.partidoId, 10);
            const prediccionEquipoUno = parseMarcador(card.querySelector('.marcador-equipo-1'));
            const prediccionEquipoDos = parseMarcador(card.querySelector('.marcador-equipo-2'));

            if (isNaN(idPartido) || prediccionEquipoUno === null || prediccionEquipoDos === null) return;

            setBtnLoading(btn, true);

            axios.post(urlPredicciones, {
                predicciones: [{ idPartido, prediccionEquipoUno, prediccionEquipoDos }],
            })
                .then(response => {
                    const data = response.data.data;
                    const procesadas = data.prediccionesProcesadas || [];
                    const rechazadas = data.prediccionesRechazadas || [];

                    if (procesadas.length > 0) {
                        setCardPronosticado(card);
                    }

                    openModalResultado(procesadas, rechazadas);
                })
                .catch(error => {
                    if (error.response?.status === 422) {
                        const errors = error.response.data.errors;
                        const messages = Object.values(errors).flat();
                        showToastErrors(messages);
                        return;
                    }

                    showToastErrors(['Ocurrió un error inesperado. Intenta de nuevo.']);
                })
                .finally(() => {
                    setBtnLoading(btn, false);
                    refreshCardButton(card);
                });
        });
    }

    // Modal resultado de predicciones

    const modal = document.getElementById('modal-resultado-predicciones');
    const backdrop = document.getElementById('modal-resultado-backdrop');
    const panel = document.getElementById('modal-resultado-panel');
    const cardsContainer = document.getElementById('modal-resultado-cards');
    const btnClose = document.getElementById('modal-resultado-close');

    function createResultCard(prediccion, tipo) {
        const isAceptada = tipo === 'aceptada';
        const borderColor = 'border-complementary-dark';
        const badgeBg = isAceptada ? 'bg-green-600' : 'bg-red-600';
        const badgeIcon = isAceptada
            ? '<span class="icon-[material-symbols--check-circle] w-4 h-4"></span>'
            : '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 640 640"><path fill="currentColor" d="M320 576c141.4 0 256-114.6 256-256S461.4 64 320 64S64 178.6 64 320s114.6 256 256 256m-89-345c9.4-9.4 24.6-9.4 33.9 0l55 55l55-55c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-55 55l55 55c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-55-55l-55 55c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l55-55l-55-55c-9.4-9.4-9.4-24.6 0-33.9"/></svg>';
        const badgeText = isAceptada ? 'Aceptada' : 'Rechazada';
        const msgBg = 'bg-primary text-light';

        let brandHTML = '';
        if (prediccion.marca) {
            brandHTML = `
                <hr class="border-complementary-dark">

                <div class="w-full flex justify-center items-center p-4">
                    <img
                        src="${prediccion.marca.image}"
                        alt="${prediccion.marca.name}"
                        class="w-full max-w-56 aspect-4/1 object-contain"
                    >
                </div>`;
        }

        return `
            <div class="bg-light border ${borderColor} rounded-3xl flex flex-col overflow-hidden shadow-md shadow-zinc-400 hover:-translate-y-1 hover:shadow-lg transition-all duration-300 ease-in-out">
                <div class="flex flex-col p-5 gap-4">
                    <div class="flex justify-end">
                        <span class="flex items-center gap-1 ${badgeBg} text-white text-sm font-semibold px-3 py-1.5 rounded-full">
                            ${badgeIcon}
                            ${badgeText}
                        </span>
                    </div>

                    <div class="flex items-center justify-between gap-2">
                        <div class="flex flex-col items-center gap-2 flex-1">
                            <img src="${prediccion.equipoUno.imagen}" alt="${prediccion.equipoUno.nombre}" class="w-full max-w-20 aspect-6/4 object-cover rounded-xl shadow-md">
                            <p class="font-semibold text-sm text-center text-dark leading-tight">${prediccion.equipoUno.nombre}</p>
                        </div>
                        <span class="font-bold text-2xl text-dark shrink-0">VS</span>
                        <div class="flex flex-col items-center gap-2 flex-1">
                            <img src="${prediccion.equipoDos.imagen}" alt="${prediccion.equipoDos.nombre}" class="w-full max-w-20 aspect-6/4 object-cover rounded-xl shadow-md">
                            <p class="font-semibold text-sm text-center text-dark leading-tight">${prediccion.equipoDos.nombre}</p>
                        </div>
                    </div>

                    <hr class="border-complementary-dark">

                    <div class="${msgBg} rounded-full p-2 text-center font-semibold text-sm">
                        ${prediccion.message}
                    </div>
                </div>
                ${brandHTML}
            </div>`;
    }

    function openModalResultado(procesadas, rechazadas) {
        cardsContainer.innerHTML = '';

        (procesadas || []).forEach(p => {
            cardsContainer.insertAdjacentHTML('beforeend', createResultCard(p, 'aceptada'));
        });

        (rechazadas || []).forEach(p => {
            cardsContainer.insertAdjacentHTML('beforeend', createResultCard(p, 'rechazada'));
        });

        document.body.classList.add('overflow-hidden');
        modal.style.display = '';
        modal.classList.remove('pointer-events-none');

        requestAnimationFrame(() => {
            backdrop.classList.remove('opacity-0');
            panel.classList.remove('opacity-0');
        });
    }

    function closeModalResultado() {
        backdrop.classList.add('opacity-0');
        panel.classList.add('opacity-0');

        setTimeout(() => {
            modal.style.display = 'none';
            modal.classList.add('pointer-events-none');
            document.body.classList.remove('overflow-hidden');
        }, 300);
    }

    if (btnClose) {
        btnClose.addEventListener('click', closeModalResultado);
    }

    if (backdrop) {
        backdrop.addEventListener('click', closeModalResultado);
    }
});
