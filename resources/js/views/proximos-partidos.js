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

    // Logica para guardar predicciones via AJAX

    const formPredicciones = document.getElementById('formPredicionesWeb');

    if (formPredicciones) {
        
        const btnSubmit = formPredicciones.querySelector('button[type="submit"]');
        const inputsMarcador = formPredicciones.querySelectorAll('.marcador-equipo');

        function setFormDisabled(disabled) {
            if (btnSubmit) {
                btnSubmit.disabled = disabled;
                btnSubmit.classList.toggle('opacity-50', disabled);
                btnSubmit.classList.toggle('pointer-events-none', disabled);
            }

            inputsMarcador.forEach(input => {
                input.disabled = disabled;
                input.classList.toggle('opacity-50', disabled);
            });
        }

        formPredicciones.addEventListener('submit', function (e) {
            e.preventDefault();

            setFormDisabled(true);

            const partidoInputs = document.querySelectorAll('.partido-jornada-quiniela');
            const predicciones = [];

            partidoInputs.forEach(function (input) {
                const parsedId = parseInt(input.value);
                const idPartido = isNaN(parsedId) ? null : parsedId;

                const inputEquipo1 = document.querySelector(`[name="prediccion_equipo1_${input.value}"]`);
                const inputEquipo2 = document.querySelector(`[name="prediccion_equipo2_${input.value}"]`);

                const rawEquipo1 = inputEquipo1 ? parseInt(inputEquipo1.value) : NaN;
                const rawEquipo2 = inputEquipo2 ? parseInt(inputEquipo2.value) : NaN;

                const prediccionEquipoUno = isNaN(rawEquipo1) ? null : rawEquipo1;
                const prediccionEquipoDos = isNaN(rawEquipo2) ? null : rawEquipo2;

                if (idPartido !== null && prediccionEquipoUno !== null && prediccionEquipoDos !== null) {
                    predicciones.push({
                        idPartido,
                        prediccionEquipoUno,
                        prediccionEquipoDos,
                    });
                }
            });

            const url = formPredicciones.dataset.urlPredicciones;

            axios.post(url, { predicciones })
                .then(response => {
                    const data = response.data.data;
                    openModalResultado(data.prediccionesProcesadas, data.prediccionesRechazadas);
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
                .finally(() => setFormDisabled(false));
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
