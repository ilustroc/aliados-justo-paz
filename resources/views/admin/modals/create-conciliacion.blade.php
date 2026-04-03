<div id="modalConciliacion" class="hidden" data-modal>
    <div class="jp-modal-backdrop" data-modal-close></div>

    <div class="jp-modal-panel max-w-lg rounded-3xl p-0">
        <div class="p-8">
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-2xl font-bold text-[#2B2B2B]">Nueva conciliación</h2>

                <button type="button" class="text-slate-400 transition-colors hover:text-slate-600" data-modal-close>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.conciliaciones.store') }}" class="space-y-5">
                @csrf

                @if(($aliados ?? collect())->isEmpty())
                    <div class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
                        No hay aliados disponibles para registrar una conciliación.
                    </div>
                @endif

                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">
                        Aliado *
                    </label>

                    <div class="relative" data-select>
                        <input type="hidden" name="aliado_id" value="" required>

                        <button
                            type="button"
                            data-select-trigger
                            class="flex h-12 w-full items-center justify-between rounded-2xl border border-slate-200 bg-[#F8F8F6] px-4 text-sm text-slate-700 shadow-sm transition hover:border-slate-300"
                        >
                            <span data-select-label>Seleccionar aliado</span>

                            <svg class="h-4 w-4 text-slate-400 transition" data-select-icon fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                            </svg>
                        </button>

                        <div
                            data-select-menu
                            class="absolute left-0 top-full z-50 mt-2 hidden max-h-64 w-full overflow-y-auto rounded-2xl border border-slate-200 bg-white shadow-xl"
                        >
                            <button type="button"
                                class="flex w-full items-center justify-between px-4 py-3 text-left text-sm text-slate-700 transition hover:bg-slate-50"
                                data-value=""
                                data-label="Seleccionar aliado">
                                <span>Seleccionar aliado</span>
                                <svg class="hidden h-4 w-4 text-slate-700" data-check fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </button>

                            @foreach($aliados as $aliado)
                                <button type="button"
                                    class="flex w-full items-center justify-between px-4 py-3 text-left text-sm text-slate-700 transition hover:bg-slate-50"
                                    data-value="{{ $aliado->id }}"
                                    data-label="{{ $aliado->nombre }}{{ $aliado->empresa ? ' (' . $aliado->empresa . ')' : '' }}">
                                    <span>{{ $aliado->nombre }}{{ $aliado->empresa ? ' (' . $aliado->empresa . ')' : '' }}</span>
                                    <svg class="hidden h-4 w-4 text-slate-700" data-check fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Código</label>
                    <input
                        type="text"
                        class="jp-input !py-3 border-slate-200 bg-slate-50 text-slate-400"
                        value="Se genera automáticamente"
                        disabled
                    >
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">
                        Nombre del caso *
                    </label>
                    <input
                        type="text"
                        name="nombre_caso"
                        class="jp-input !py-3 border-slate-200"
                        placeholder="Ej: Incumplimiento contractual Empresa SAC"
                        required
                    >
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">
                            Tipo de caso *
                        </label>

                        <div class="relative" data-select>
                            <input type="hidden" name="tipo_caso" value="Deuda" required>

                            <button
                                type="button"
                                data-select-trigger
                                class="flex h-12 w-full items-center justify-between rounded-2xl border border-slate-200 bg-[#F8F8F6] px-4 text-sm text-slate-700 shadow-sm transition hover:border-slate-300"
                            >
                                <span data-select-label>Deuda</span>

                                <svg class="h-4 w-4 text-slate-400 transition" data-select-icon fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                                </svg>
                            </button>

                            <div
                                data-select-menu
                                class="absolute left-0 top-full z-50 mt-2 hidden w-full overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl"
                            >
                                @foreach(['Deuda', 'Incumplimiento', 'Contractual', 'Otro'] as $tipo)
                                    <button type="button"
                                        class="flex w-full items-center justify-between px-4 py-3 text-left text-sm text-slate-700 transition hover:bg-slate-50"
                                        data-value="{{ $tipo }}"
                                        data-label="{{ $tipo }}">
                                        <span>{{ $tipo }}</span>
                                        <svg class="h-4 w-4 text-slate-700 {{ $tipo === 'Deuda' ? '' : 'hidden' }}" data-check fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">
                            Fecha *
                        </label>
                        <input
                            type="date"
                            name="fecha_registro"
                            class="jp-input !py-3 border-slate-200"
                            value="{{ date('Y-m-d') }}"
                            required
                        >
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">
                        Estado *
                    </label>

                    <div class="relative" data-select>
                        <input type="hidden" name="estado" value="En proceso" required>

                        <button
                            type="button"
                            data-select-trigger
                            class="flex h-12 w-full items-center justify-between rounded-2xl border border-slate-200 bg-[#F8F8F6] px-4 text-sm text-slate-700 shadow-sm transition hover:border-slate-300"
                        >
                            <span data-select-label>En proceso</span>

                            <svg class="h-4 w-4 text-slate-400 transition" data-select-icon fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                            </svg>
                        </button>

                        <div
                            data-select-menu
                            class="absolute left-0 top-full z-50 mt-2 hidden max-h-60 w-full overflow-y-auto rounded-2xl border border-slate-200 bg-white shadow-xl"
                        >
                            @foreach(['En proceso', 'Cerrada', 'No concretada'] as $item)
                                <button type="button"
                                    class="flex w-full items-center justify-between px-4 py-3 text-left text-sm text-slate-700 transition hover:bg-slate-50"
                                    data-value="{{ $item }}"
                                    data-label="{{ $item }}">
                                    <span>{{ $item }}</span>
                                    <svg class="h-4 w-4 text-slate-700 {{ $item === 'En proceso' ? '' : 'hidden' }}" data-check fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-3">
                    <button
                        type="button"
                        class="rounded-xl border border-slate-200 px-6 py-2.5 text-sm font-bold text-slate-500 transition-colors hover:bg-slate-50"
                        data-modal-close
                    >
                        Cancelar
                    </button>

                    <button
                        type="submit"
                        class="rounded-xl bg-[#4A7c44] px-8 py-2.5 text-sm font-bold text-white shadow-lg shadow-[#4A7c44]/20 transition-all hover:bg-[#3d6638] disabled:cursor-not-allowed disabled:opacity-50"
                        {{ ($aliados ?? collect())->isEmpty() ? 'disabled' : '' }}
                    >
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>