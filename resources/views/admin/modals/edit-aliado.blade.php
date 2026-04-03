<div id="modalEditAliado" class="hidden" data-modal>
    <div class="jp-modal-backdrop" data-modal-close></div>
    <div class="jp-modal-panel max-w-xl p-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-[#2B2B2B]">Editar aliado</h2>
            <p class="text-sm text-slate-500">Actualiza la información del aliado seleccionado.</p>
        </div>

        <form id="formEditAliado" method="POST" action="" class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @csrf
            @method('PUT')

            <div class="md:col-span-2">
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Nombre Completo *</label>
                <input type="text" name="nombre" id="edit_nombre" class="jp-input" required>
            </div>

            <div class="md:col-span-2">
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Empresa</label>
                <input type="text" name="empresa" id="edit_empresa" class="jp-input">
            </div>

            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Email *</label>
                <input type="email" name="email" id="edit_email" class="jp-input" required>
            </div>

            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Teléfono</label>
                <input type="text" name="telefono" id="edit_telefono" class="jp-input">
            </div>

            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Estado *</label>
                <select name="estado" id="edit_estado" class="jp-select" required>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>

            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Rol *</label>
                <select name="role" id="edit_role" class="jp-select" required>
                    <option value="usuario">Usuario</option>
                    <option value="administrador">Administrador</option>
                </select>
            </div>

            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Nueva contraseña</label>
                <input type="password" name="password" class="jp-input" placeholder="Déjalo vacío si no cambia" autocomplete="new-password">            
            </div>

            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" class="jp-input" placeholder="Repite la nueva contraseña" autocomplete="new-password">
            </div>

            <div class="md:col-span-2">
                <p class="text-xs text-slate-400">
                    Déjalo vacío si no deseas cambiar la contraseña.
                </p>
            </div>

            <div class="md:col-span-2 flex justify-between gap-3 mt-4">
                <button type="button" class="jp-btn-secondary px-8" data-modal-close>Cancelar</button>
                <button type="submit" class="jp-btn-primary px-10">Actualizar</button>
            </div>
        </form>
    </div>
</div>