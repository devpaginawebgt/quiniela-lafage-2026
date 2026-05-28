import { setButtonLoading } from '../utils/button-loading';

document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form.formulario-auth');
    if (!form) return;

    form.addEventListener('submit', () => {
        const btn = form.querySelector('button[type="submit"]');
        setButtonLoading(btn, 'Iniciando sesión...');
    });
});
