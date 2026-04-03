document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('.row-conciliacion');
    const editModal = document.getElementById('modalEditConciliacion');
    const editForm = document.getElementById('formEditConciliacion');
    const selects = document.querySelectorAll('[data-select]');

    if (rows.length > 0 && editModal && editForm) {
        rows.forEach(row => {
            row.addEventListener('click', function () {
                const action = this.dataset.action;

                if (!action) {
                    return;
                }

                let item = {};

                try {
                    item = JSON.parse(this.dataset.item || '{}');
                } catch (error) {
                    console.error('No se pudo leer data-item de conciliación:', error);
                    return;
                }

                const aliadoNombre = this.dataset.aliado ?? '';

                const aliadoInput = document.getElementById('edit_aliado_nombre');
                const codigoInput = document.getElementById('edit_codigo');
                const nombreCasoInput = document.getElementById('edit_nombre_caso');
                const tipoCasoInput = document.getElementById('edit_tipo_caso');
                const estadoInput = document.getElementById('edit_estado');
                const fechaRegistroInput = document.getElementById('edit_fecha_registro');

                editForm.action = action;

                if (aliadoInput) aliadoInput.value = aliadoNombre;
                if (codigoInput) codigoInput.value = item.codigo ?? '';
                if (nombreCasoInput) nombreCasoInput.value = item.nombre_caso ?? '';
                if (tipoCasoInput) tipoCasoInput.value = item.tipo_caso ?? '';
                if (estadoInput) estadoInput.value = item.estado ?? '';
                if (fechaRegistroInput) fechaRegistroInput.value = item.fecha_registro ?? '';

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
                    otherMenu.parentElement
                        ?.querySelector('[data-select-icon]')
                        ?.classList.remove('rotate-180');
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
});