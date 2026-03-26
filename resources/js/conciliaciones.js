document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('.row-conciliacion');
    const editModal = document.getElementById('modalEditConciliacion');
    const editForm = document.getElementById('formEditConciliacion');

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
});