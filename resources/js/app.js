import './bootstrap';

document.addEventListener('click', function (e) {
    const openBtn = e.target.closest('[data-modal-open]');
    const closeBtn = e.target.closest('[data-modal-close]');

    if (openBtn) {
        const id = openBtn.getAttribute('data-modal-open');
        const modal = document.getElementById(id);
        if (modal) modal.classList.remove('hidden');
    }

    if (closeBtn) {
        const modal = closeBtn.closest('[data-modal]');
        if (modal) modal.classList.add('hidden');
    }
});