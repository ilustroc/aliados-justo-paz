<div id="modalConciliacion" class="hidden" data-modal>
    <div class="jp-modal-backdrop" data-modal-close></div>
    <div class="jp-modal-panel max-w-lg p-0 overflow-hidden rounded-3xl">
        <div class="p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-[#2B2B2B]">Nueva conciliación</h2>
                <button type="button" class="text-slate-400 hover:text-slate-600 transition-colors" data-modal-close>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.conciliaciones.store') }}" class="space-y-5">
                @csrf
                
                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Aliado *</label>
                    <select name="aliado_id" class="jp-select !py-3 border-slate-200" required>
                        <option value="">Seleccionar aliado</option>
                        @foreach($aliados as $aliado)
                            <option value="{{ $aliado->id }}">{{ $aliado->nombre }} ({{ $aliado->empresa }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Código</label>
                    <input type="text" class="jp-input !py-3 bg-slate-50 border-slate-200 text-slate-400" value="Se genera automáticamente" disabled>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Nombre del caso *</label>
                    <input type="text" name="nombre_caso" class="jp-input !py-3 border-slate-200" placeholder="Ej: Incumplimiento contractual Empresa SAC" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Tipo de caso</label>
                        <select name="tipo_caso" class="jp-select !py-3 border-slate-200">
                            <option value="Deuda">Deuda</option>
                            <option value="Incumplimiento">Incumplimiento</option>
                            <option value="Contractual">Contractual</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Fecha</label>
                        <input type="date" name="fecha_registro" class="jp-input !py-3 border-slate-200" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Estado</label>
                    <select name="estado" class="jp-select !py-3 border-slate-200">
                        <option value="En proceso">En proceso</option>
                        <option value="Cerrada">Cerrada</option>
                        <option value="No concretada">No concretada</option>
                    </select>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8">
                    <button type="button" class="px-6 py-2.5 rounded-xl border border-slate-200 text-sm font-bold text-slate-500 hover:bg-slate-50 transition-colors" data-modal-close>
                        Cancelar
                    </button>
                    <button type="submit" class="px-8 py-2.5 rounded-xl bg-[#4A7c44] text-sm font-bold text-white shadow-lg shadow-[#4A7c44]/20 hover:bg-[#3d6638] transition-all">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>