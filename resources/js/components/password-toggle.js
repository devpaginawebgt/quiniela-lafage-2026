export function initPasswordToggle() {
    document.addEventListener('click', (event) => {
        const button = event.target.closest('[data-toggle-password]');
        if (!button) return;

        const inputId = button.getAttribute('data-toggle-password');
        const input = document.getElementById(inputId);
        if (!input) return;

        const showIcon = button.querySelector('[data-icon-show]');
        const hideIcon = button.querySelector('[data-icon-hide]');
        const isPassword = input.type === 'password';

        input.type = isPassword ? 'text' : 'password';

        showIcon?.classList.toggle('hidden', !isPassword);
        showIcon?.classList.toggle('block', isPassword);
        hideIcon?.classList.toggle('hidden', isPassword);
        hideIcon?.classList.toggle('block', !isPassword);
    });
}
