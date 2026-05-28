/**
 * Pone un botón en estado de carga: lo deshabilita y reemplaza su contenido
 * por un spinner + texto. Conserva el HTML original en data-original-content
 * para poder restaurarlo con resetButtonLoading().
 */
export const setButtonLoading = (btn, loadingText = 'Procesando...') => {
    if (!btn || btn.disabled) return;

    if (btn.dataset.originalContent === undefined) {
        btn.dataset.originalContent = btn.innerHTML;
    }

    btn.disabled = true;
    btn.classList.add('cursor-wait', 'opacity-80');
    btn.innerHTML = `
        <span class="icon-[material-symbols--progress-activity] w-5 h-5 animate-spin"></span>
        <span>${loadingText}</span>
    `;
};

export const resetButtonLoading = (btn) => {
    if (!btn) return;

    if (btn.dataset.originalContent !== undefined) {
        btn.innerHTML = btn.dataset.originalContent;
        delete btn.dataset.originalContent;
    }

    btn.disabled = false;
    btn.classList.remove('cursor-wait', 'opacity-80');
};
