document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.btn-edit-aliado');
    const editModal = document.getElementById('modalEditAliado');
    const editForm = document.getElementById('formEditAliado');

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
});