document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('.row-conciliacion');
    const editModal = document.getElementById('modalEditConciliacion');
    const editForm = document.getElementById('formEditConciliacion');
    const selects = document.querySelectorAll('[data-select]');

    rows.forEach(row => {
        row.addEventListener('click', function() {
            const item = JSON.parse(this.dataset.item);
            const aliadoNombre = this.dataset.aliado;
            const action = this.dataset.action;

            editForm.action = action;
            document.getElementById('edit_aliado_nombre').value = aliadoNombre;
            document.getElementById('edit_codigo').value = item.codigo;
            document.getElementById('edit_nombre_caso').value = item.nombre_caso;
            document.getElementById('edit_tipo_caso').value = item.tipo_caso;
            document.getElementById('edit_estado').value = item.estado;
            
            if(item.fecha_registro) {
                const date = new Date(item.fecha_registro);
                document.getElementById('edit_fecha_registro').value = date.toISOString().split('T')[0];
            }

            editModal.classList.remove('hidden');
        });
    });

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