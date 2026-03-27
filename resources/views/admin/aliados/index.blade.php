@extends('layouts.app')

@section('title', 'Aliados')

@vite(['resources/js/aliados.js'])

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-[#2B2B2B]">Aliados</h1>
            <p class="mt-1 text-sm text-slate-500">{{ $aliados->total() }} aliados registrados</p>
        </div>

        <button type="button" class="jp-btn-primary gap-2 shrink-0" data-modal-open="modalAliado">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Nuevo aliado
        </button>
    </div>

    <form method="GET" action="{{ route('admin.aliados.index') }}"
          class="rounded-3xl border border-slate-200 bg-white p-4 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
        <div class="flex flex-col gap-3 xl:flex-row xl:items-center">
            <div class="min-w-0 flex-1">
                <input
                    type="text"
                    name="q"
                    value="{{ $q }}"
                    class="h-11 w-full rounded-2xl border border-slate-200 bg-[#F8F8F6] px-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-slate-300 focus:bg-white"
                    placeholder="Buscar por nombre, empresa o email..."
                >
            </div>

            <div class="xl:w-[210px]">
                <div class="relative jp-custom-select" data-select>
                    <input type="hidden" name="tramo" value="{{ $tramo }}">

                    <button
                        type="button"
                        data-select-trigger
                        class="flex h-11 w-full items-center justify-between rounded-2xl border border-slate-200 bg-[#F8F8F6] px-4 text-sm text-slate-700 shadow-sm transition hover:border-slate-300"
                    >
                        <span data-select-label>
                            {{ $tramo ?: 'Todos los tramos' }}
                        </span>

                        <svg class="h-4 w-4 text-slate-400 transition" data-select-icon fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                        </svg>
                    </button>

                    <div
                        data-select-menu
                        class="absolute left-0 top-full z-50 mt-2 hidden w-full overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl"
                    >
                        <button type="button"
                            class="flex w-full items-center justify-between px-4 py-3 text-left text-sm text-slate-700 transition hover:bg-slate-50"
                            data-value=""
                            data-label="Todos los tramos">
                            <span>Todos los tramos</span>
                            <svg class="h-4 w-4 text-slate-700 {{ $tramo === '' ? '' : 'hidden' }}" data-check fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </button>

                        @foreach(['Inicio', 'Preferencial', 'Avanzado', 'Premium'] as $t)
                            <button type="button"
                                class="flex w-full items-center justify-between px-4 py-3 text-left text-sm text-slate-700 transition hover:bg-slate-50"
                                data-value="{{ $t }}"
                                data-label="{{ $t }}">
                                <span>{{ $t }}</span>
                                <svg class="h-4 w-4 text-slate-700 {{ $tramo === $t ? '' : 'hidden' }}" data-check fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="xl:w-[210px]">
                <div class="relative jp-custom-select" data-select>
                    <input type="hidden" name="estado" value="{{ $estado }}">

                    <button
                        type="button"
                        data-select-trigger
                        class="flex h-11 w-full items-center justify-between rounded-2xl border border-slate-200 bg-[#F8F8F6] px-4 text-sm text-slate-700 shadow-sm transition hover:border-slate-300"
                    >
                        <span data-select-label>
                            {{ $estado === 'activo' ? 'Activo' : ($estado === 'inactivo' ? 'Inactivo' : 'Todos los estados') }}
                        </span>

                        <svg class="h-4 w-4 text-slate-400 transition" data-select-icon fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                        </svg>
                    </button>

                    <div
                        data-select-menu
                        class="absolute left-0 top-full z-50 mt-2 hidden w-full overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl"
                    >
                        <button type="button"
                            class="flex w-full items-center justify-between px-4 py-3 text-left text-sm text-slate-700 transition hover:bg-slate-50"
                            data-value=""
                            data-label="Todos los estados">
                            <span>Todos los estados</span>
                            <svg class="h-4 w-4 text-slate-700 {{ $estado === '' ? '' : 'hidden' }}" data-check fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </button>

                        <button type="button"
                            class="flex w-full items-center justify-between px-4 py-3 text-left text-sm text-slate-700 transition hover:bg-slate-50"
                            data-value="activo"
                            data-label="Activo">
                            <span>Activo</span>
                            <svg class="h-4 w-4 text-slate-700 {{ $estado === 'activo' ? '' : 'hidden' }}" data-check fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </button>

                        <button type="button"
                            class="flex w-full items-center justify-between px-4 py-3 text-left text-sm text-slate-700 transition hover:bg-slate-50"
                            data-value="inactivo"
                            data-label="Inactivo">
                            <span>Inactivo</span>
                            <svg class="h-4 w-4 text-slate-700 {{ $estado === 'inactivo' ? '' : 'hidden' }}" data-check fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <button type="submit" class="jp-btn-primary h-11 px-8 xl:shrink-0">
                Buscar
            </button>
        </div>
    </form>

    <div class="overflow-x-auto rounded-3xl border border-slate-200 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
        <table class="jp-table min-w-full">
            <thead>
                <tr class="bg-[#F1F3EB]">
                    <th class="py-4 text-[11px] font-bold uppercase text-slate-500">Nombre</th>
                    <th class="py-4 text-[11px] font-bold uppercase text-slate-500">Empresa</th>
                    <th class="py-4 text-[11px] font-bold uppercase text-slate-500">Email</th>
                    <th class="py-4 text-center text-[11px] font-bold uppercase text-slate-500">Casos</th>
                    <th class="py-4 text-[11px] font-bold uppercase text-slate-500">Tarifa</th>
                    <th class="py-4 text-[11px] font-bold uppercase text-slate-500">Tramo</th>
                    <th class="py-4 text-center text-[11px] font-bold uppercase text-slate-500">Estado</th>
                    <th class="w-10"></th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                @forelse($aliados as $aliado)
                    <tr class="transition hover:bg-slate-50/60">
                        <td class="px-6 py-4 font-semibold text-slate-900">{{ $aliado->nombre }}</td>
                        <td class="px-6 py-4 text-sm text-slate-700">{{ $aliado->empresa ?: '-' }}</td>
                        <td class="px-6 py-4 text-sm text-slate-700 whitespace-nowrap">{{ $aliado->email }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-base font-semibold text-[#4A7c44]">{{ $aliado->conciliaciones_acumuladas }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold whitespace-nowrap text-slate-900">
                            S/ {{ number_format($aliado->tarifa_actual, 0) }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $aliado->tramo_actual }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if($aliado->estado === 'activo')
                                <span class="inline-flex rounded-full bg-[#F0FDF4] px-3 py-1 text-[11px] font-bold lowercase text-[#166534]">
                                    activo
                                </span>
                            @else
                                <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-[11px] font-bold lowercase text-slate-500">
                                    inactivo
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <button type="button"
                                class="btn-edit-aliado text-slate-300 transition-colors hover:text-slate-500"
                                data-aliado="{{ json_encode($aliado) }}"
                                data-action="{{ route('admin.aliados.update', $aliado) }}">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-12 text-center italic text-slate-400">
                            No hay aliados registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex flex-col items-center justify-between gap-4 md:flex-row">
        <div class="text-xs italic text-slate-400">
            Mostrando {{ $aliados->firstItem() ?? 0 }} a {{ $aliados->lastItem() ?? 0 }} de {{ $aliados->total() }} resultados
        </div>
        <div>{{ $aliados->links() }}</div>
    </div>
</div>

@include('admin.modals.create-aliado')
@include('admin.modals.edit-aliado')

@endsection