document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.btn-edit-aliado');
    const editModal = document.getElementById('modalEditAliado');
    const editForm = document.getElementById('formEditAliado');
    const selects = document.querySelectorAll('[data-select]');

    const openModal = (modal) => {
        if (!modal) return;
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    };

    const closeModal = (modal) => {
        if (!modal) return;
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    };

    document.querySelectorAll('[data-modal-open]').forEach((button) => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-open');
            const modal = document.getElementById(modalId);
            openModal(modal);
        });
    });

    document.querySelectorAll('[data-modal-close]').forEach((button) => {
        button.addEventListener('click', () => {
            const modal = button.closest('[data-modal]');
            closeModal(modal);
        });
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            document.querySelectorAll('[data-modal]').forEach((modal) => {
                closeModal(modal);
            });
        }
    });

    if (editButtons.length > 0 && editModal && editForm) {
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const aliado = JSON.parse(this.dataset.aliado);
                const action = this.dataset.action;

                editForm.action = action;

                const nombre = document.getElementById('edit_nombre');
                const empresa = document.getElementById('edit_empresa');
                const email = document.getElementById('edit_email');
                const estado = document.getElementById('edit_estado');
                const telefono = document.getElementById('edit_telefono');
                const role = document.getElementById('edit_role');
                const password = editForm.querySelector('input[name="password"]');
                const passwordConfirmation = editForm.querySelector('input[name="password_confirmation"]');

                if (password) password.value = '';
                if (passwordConfirmation) passwordConfirmation.value = '';
                if (nombre) nombre.value = aliado.nombre ?? '';
                if (empresa) empresa.value = aliado.empresa ?? '';
                if (email) email.value = aliado.email ?? '';
                if (estado) estado.value = aliado.estado ?? 'activo';
                if (telefono) telefono.value = aliado.telefono ?? '';
                if (role) role.value = aliado.role ?? 'usuario';

                openModal(editModal);
            });
        });
    }

    selects.forEach((select) => {
        const trigger = select.querySelector('[data-select-trigger]');
        const menu = select.querySelector('[data-select-menu]');
        const input = select.querySelector('input[type="hidden"]');
        const label = select.querySelector('[data-select-label]');
        const icon = select.querySelector('[data-select-icon]');
        const options = select.querySelectorAll('[data-value]');

        trigger?.addEventListener('click', (e) => {
            e.stopPropagation();

            document.querySelectorAll('[data-select-menu]').forEach((otherMenu) => {
                if (otherMenu !== menu) {
                    otherMenu.classList.add('hidden');
                    const otherIcon = otherMenu.parentElement.querySelector('[data-select-icon]');
                    otherIcon?.classList.remove('rotate-180');
                }
            });

            menu?.classList.toggle('hidden');
            icon?.classList.toggle('rotate-180');
        });

        options.forEach((option) => {
            option.addEventListener('click', () => {
                const value = option.dataset.value ?? '';
                const text = option.dataset.label ?? '';

                if (input) input.value = value;
                if (label) label.textContent = text;

                options.forEach((item) => {
                    item.querySelector('[data-check]')?.classList.add('hidden');
                });

                option.querySelector('[data-check]')?.classList.remove('hidden');

                menu?.classList.add('hidden');
                icon?.classList.remove('rotate-180');
            });
        });
    });

    document.addEventListener('click', () => {
        document.querySelectorAll('[data-select-menu]').forEach((menu) => {
            menu.classList.add('hidden');
        });

        document.querySelectorAll('[data-select-icon]').forEach((icon) => {
            icon.classList.remove('rotate-180');
        });
    });

    const modalCreateHasErrors = document.querySelector('#modalAliado .border-red-200');
    if (modalCreateHasErrors) {
        const modalAliado = document.getElementById('modalAliado');
        openModal(modalAliado);
    }
});