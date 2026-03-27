document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.btn-edit-aliado');
    const editModal = document.getElementById('modalEditAliado');
    const editForm = document.getElementById('formEditAliado');
    const selects = document.querySelectorAll('[data-select]');

    if (editButtons.length > 0) {
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const aliado = JSON.parse(this.dataset.aliado);
                const action = this.dataset.action;

                editForm.action = action;
                document.getElementById('edit_nombre').value = aliado.nombre;
                document.getElementById('edit_empresa').value = aliado.empresa || '';
                document.getElementById('edit_email').value = aliado.email;
                document.getElementById('edit_estado').value = aliado.estado;

                editModal.classList.remove('hidden');
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

            menu.classList.toggle('hidden');
            icon?.classList.toggle('rotate-180');
        });

        options.forEach((option) => {
            option.addEventListener('click', () => {
                const value = option.dataset.value ?? '';
                const text = option.dataset.label ?? '';

                input.value = value;
                label.textContent = text;

                options.forEach((item) => {
                    item.querySelector('[data-check]')?.classList.add('hidden');
                });

                option.querySelector('[data-check]')?.classList.remove('hidden');

                menu.classList.add('hidden');
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
});