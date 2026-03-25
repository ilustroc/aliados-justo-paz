<div id="modalAliado" class="hidden" data-modal>
    <div class="jp-modal-backdrop" data-modal-close></div>
    <div class="jp-modal-panel max-w-xl p-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-[#2B2B2B]">Nuevo aliado</h2>
            <p class="text-sm text-slate-500">Registra un nuevo colaborador estratégico para el programa 2026.</p>
        </div>
        <form method="POST" action="{{ route('admin.aliados.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @csrf
            <div class="md:col-span-2">
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Nombre Completo *</label>
                <input type="text" name="nombre" class="jp-input" placeholder="Ej: Alejandra García" required>
            </div>
            <div class="md:col-span-2">
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Empresa / Estudio Jurídico</label>
                <input type="text" name="empresa" class="jp-input" placeholder="Ej: Estudios Mendoza & Asociados">
            </div>
            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Email de acceso *</label>
                <input type="email" name="email" class="jp-input" placeholder="correo@estudio.com" required>
            </div>
            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Teléfono</label>
                <input type="text" name="telefono" class="jp-input" placeholder="+51 999...">
            </div>
            <div class="md:col-span-2 flex justify-end gap-3 mt-4">
                <button type="button" class="jp-btn-secondary px-8" data-modal-close>Cancelar</button>
                <button type="submit" class="jp-btn-primary px-10">Guardar Aliado</button>
            </div>
        </form>
    </div>
</div>

<div id="modalConciliacion" class="hidden" data-modal>
    <div class="jp-modal-backdrop" data-modal-close></div>
    <div class="jp-modal-panel max-w-xl p-8">
        <div class="mb-6 text-left">
            <h2 class="text-2xl font-bold text-[#2B2B2B]">Nueva conciliación</h2>
            <p class="text-sm text-slate-500">Registra un nuevo caso para un aliado activo.</p>
        </div>
        </div>
</div>