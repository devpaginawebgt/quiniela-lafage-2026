import { initTeamGroupCardAccordion, buildTeamGroupCard } from '../components/team-group-card.js';
import { renderMatchCard } from '../components/match-card.js';

document.addEventListener('DOMContentLoaded', () => {

    initTeamGroupCardAccordion();

    // ============================================================
    // GRUPOS — equipos del grupo seleccionado
    // ============================================================

    const listaEquipos       = document.getElementById('equipos-grupo-list');
    const tituloGrupo        = document.getElementById('titulo-grupo');
    const spinnerGrupos      = document.getElementById('grupos-spinner');
    const inputBuscarEquipos = document.getElementById('buscar-equipos');

    /** Muestra/oculta las cards de equipos según el término de búsqueda */
    const filtrarEquipos = (term) => {
        document.querySelectorAll('.team-group-card').forEach(card => {
            card.style.display = card.dataset.nombre.toLowerCase().includes(term) ? '' : 'none';
        });
    };

    /** Pide los equipos del grupo al backend y los renderiza en la grilla */
    const cargarEquiposGrupo = async (grupoId, grupoNombre) => {
        spinnerGrupos?.classList.remove('hidden');
        listaEquipos.innerHTML = '';
        tituloGrupo.textContent = `Grupo ${grupoNombre}`;

        try {
            const res     = await window.axios.get(`/grupos/${grupoId}/equipos`);
            const equipos = res.data.data.equipos;

            listaEquipos.innerHTML = equipos.map(buildTeamGroupCard).join('');
            initTeamGroupCardAccordion(listaEquipos);

            if (inputBuscarEquipos?.value.trim()) {
                filtrarEquipos(inputBuscarEquipos.value.toLowerCase().trim());
            }
        } catch (e) {
            console.error(e);
        } finally {
            spinnerGrupos?.classList.add('hidden');
        }
    };

    if (inputBuscarEquipos) {
        inputBuscarEquipos.addEventListener('input', function () {
            filtrarEquipos(this.value.toLowerCase().trim());
        });
    }

    // ============================================================
    // JORNADAS — partidos del grupo seleccionado
    // ============================================================

    const tituloJornadas      = document.getElementById('titulo-jornadas-grupo');
    const listaJornadas       = document.getElementById('jornadas-partidos-list');
    const spinnerJornadas     = document.getElementById('jornadas-spinner');
    const inputBuscarPartidos = document.getElementById('buscar-partidos-grupo');

    /** Muestra/oculta las match-cards según el término de búsqueda */
    const filtrarPartidos = (query) => {
        const term = query.toLowerCase().trim();
        listaJornadas.querySelectorAll('.match-card').forEach(card => {
            const equipos = card.getAttribute('data-equipos') ?? '';
            card.style.display = equipos.includes(term) ? '' : 'none';
        });
    };

    /** Renderiza el listado de jornadas con sus partidos */
    const renderJornadas = (jornadas) => {
        listaJornadas.innerHTML = jornadas.map(jornada => `
            <div class="mb-12">
                <h6 class="text-xl font-semibold text-center mb-4">Jornada ${jornada.value}</h6>
                <ul class="flex flex-wrap justify-center gap-4">
                    ${jornada.partidos.map(renderMatchCard).join('')}
                </ul>
            </div>
        `).join('');

        if (inputBuscarPartidos?.value.trim()) {
            filtrarPartidos(inputBuscarPartidos.value.trim());
        }
    };

    /** Pide las jornadas del grupo al backend y las renderiza */
    const cargarJornadasGrupo = async (grupoId, grupoNombre) => {
        if (tituloJornadas) {
            tituloJornadas.textContent = `Partidos del Grupo ${grupoNombre}`;
        }
        spinnerJornadas?.classList.remove('hidden');

        try {
            const res      = await window.axios.get(`/grupos/${grupoId}/jornadas`);
            const jornadas = res.data.data;
            renderJornadas(jornadas);
        } catch (e) {
            console.error(e);
        } finally {
            spinnerJornadas?.classList.add('hidden');
        }
    };

    if (inputBuscarPartidos) {
        inputBuscarPartidos.addEventListener('input', function () {
            filtrarPartidos(this.value);
        });
    }

    // ============================================================
    // Selector de grupo + carga inicial (grupo con is_current)
    // ============================================================

    const selectorGrupo = document.getElementById('selector-grupo');

    if (selectorGrupo) {
        selectorGrupo.addEventListener('change', async function () {
            const grupoId     = this.value;
            const grupoNombre = this.options[this.selectedIndex].text;

            await cargarEquiposGrupo(grupoId, grupoNombre);
            await cargarJornadasGrupo(grupoId, grupoNombre);
        });

        const grupoId     = selectorGrupo.value;
        const grupoNombre = selectorGrupo.options[selectorGrupo.selectedIndex].text;
        cargarEquiposGrupo(grupoId, grupoNombre);
        cargarJornadasGrupo(grupoId, grupoNombre);
    }

});
