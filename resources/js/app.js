import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.flash').forEach((el) => {
        setTimeout(() => el.remove(), 5500);
    });
});
