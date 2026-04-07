<div id="modalAliado" class="hidden" data-modal>
    <div class="jp-modal-backdrop" data-modal-close></div>
    <div class="jp-modal-panel max-w-xl p-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-[#2B2B2B]">Nuevo aliado</h2>
            <p class="text-sm text-slate-500">Registra un nuevo colaborador estratégico para el programa 2026.</p>
        </div>

        @if ($errors->createAliado->any())
            <div class="mb-4 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->createAliado->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.aliados.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @csrf

            <div class="md:col-span-2">
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Nombre Completo *</label>
                <input type="text" name="nombre" class="jp-input" placeholder="Ej: Alejandra García" value="{{ old('nombre') }}" required>
            </div>

            <div class="md:col-span-2">
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Empresa / Estudio Jurídico</label>
                <input type="text" name="empresa" class="jp-input" placeholder="Ej: Estudios Mendoza & Asociados" value="{{ old('empresa') }}">
            </div>

            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Email de acceso *</label>
                <input type="email" name="email" class="jp-input" placeholder="correo@estudio.com" value="{{ old('email') }}" required>
            </div>

            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Teléfono</label>
                <input type="text" name="telefono" class="jp-input" placeholder="+51 999..." value="{{ old('telefono') }}">
            </div>

            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Estado *</label>
                <select name="estado" class="jp-select" required>
                    <option value="activo" {{ old('estado', 'activo') === 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('estado') === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Rol *</label>
                <select name="role" class="jp-select" required>
                    <option value="usuario" {{ old('role', 'usuario') === 'usuario' ? 'selected' : '' }}>Usuario</option>
                    <option value="administrador" {{ old('role') === 'administrador' ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>

            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Contraseña *</label>
                <input type="password" name="password" class="jp-input" placeholder="Mínimo 8 caracteres" required autocomplete="new-password">
            </div>

            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase text-slate-500">Confirmar contraseña *</label>
                <input type="password" name="password_confirmation" class="jp-input" placeholder="Repite la contraseña" required autocomplete="new-password">
            </div>

            <div class="md:col-span-2 flex justify-between gap-3 mt-4">
                <button type="button" class="jp-btn-secondary px-8" data-modal-close>Cancelar</button>
                <button type="submit" class="jp-btn-primary px-10">Guardar Aliado</button>
            </div>
        </form>
    </div>
</div>