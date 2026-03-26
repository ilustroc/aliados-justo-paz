@extends('layouts.app')

@section('title', 'Aliados')

@vite(['resources/js/aliados.js'])

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-[#2B2B2B]">Aliados</h1>
            <p class="text-sm text-slate-500">{{ $aliados->total() }} aliados registrados</p>
        </div>

        <button type="button" class="jp-btn-primary gap-2" data-modal-open="modalAliado">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Nuevo aliado
        </button>
    </div>

    <form method="GET" action="{{ route('admin.aliados.index') }}" class="jp-card p-4">
        <div class="flex flex-col lg:flex-row gap-3">
            <div class="flex-1">
                <input type="text" name="q" value="{{ $q }}" 
                       class="jp-input !bg-slate-50 border-slate-200" 
                       placeholder="Buscar por nombre, empresa o email...">
            </div>
            <div class="lg:w-48">
                <select name="tramo" class="jp-select !bg-slate-50 border-slate-200">
                    <option value="">Todos los tramos</option>
                    @foreach(['Inicio', 'Preferencial', 'Avanzado', 'Premium'] as $t)
                        <option value="{{ $t }}" @selected($tramo === $t)>{{ $t }}</option>
                    @endforeach
                </select>
            </div>
            <div class="lg:w-48">
                <select name="estado" class="jp-select !bg-slate-50 border-slate-200">
                    <option value="">Todos los estados</option>
                    <option value="activo" @selected($estado === 'activo')>Activo</option>
                    <option value="inactivo" @selected($estado === 'inactivo')>Inactivo</option>
                </select>
            </div>
            <button class="jp-btn-primary px-8">Buscar</button>
        </div>
    </form>

    <div class="jp-table-wrap border-none shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
        <table class="jp-table">
            <thead>
                <tr class="bg-[#F1F3EB]">
                    <th class="text-[11px] font-bold uppercase text-slate-500 py-3">Nombre</th>
                    <th class="text-[11px] font-bold uppercase text-slate-500 py-3">Empresa</th>
                    <th class="text-[11px] font-bold uppercase text-slate-500 py-3">Email</th>
                    <th class="text-[11px] font-bold uppercase text-slate-500 py-3 text-center">Casos</th>
                    <th class="text-[11px] font-bold uppercase text-slate-500 py-3">Tarifa</th>
                    <th class="text-[11px] font-bold uppercase text-slate-500 py-3">Tramo</th>
                    <th class="text-[11px] font-bold uppercase text-slate-500 py-3 text-center">Estado</th>
                    <th class="w-10"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($aliados as $aliado)
                    <tr class="hover:bg-slate-50/50 transition-colors border-b border-slate-50 last:border-0">
                        <td class="py-3 px-6 font-semibold text-slate-900">{{ $aliado->nombre }}</td>
                        <td class="py-3 px-6 text-slate-900 text-sm">{{ $aliado->empresa ?: '-' }}</td>
                        <td class="py-3 px-6 text-slate-900 text-sm whitespace-nowrap">{{ $aliado->email }}</td>
                        <td class="py-3 px-6 text-center">
                            <span class="text-base font-semibold text-[#4A7c44]">{{ $aliado->conciliaciones_acumuladas }}</span>
                        </td>
                        <td class="py-3 px-6 text-slate-900 text-sm whitespace-nowrap font-semibold">
                            S/ {{ number_format($aliado->tarifa_actual, 0) }}
                        </td>
                        <td class="py-3 px-6 text-slate-900 text-sm font-medium">{{ $aliado->tramo_actual }}</td>
                        <td class="py-3 px-6 text-center whitespace-nowrap">
                            @if($aliado->estado === 'activo')
                                <span class="inline-block bg-[#F0FDF4] text-[#166534] text-[11px] font-bold px-3 py-1 rounded-full lowercase">activo</span>
                            @else
                                <span class="inline-block bg-slate-100 text-slate-500 text-[11px] font-bold px-3 py-1 rounded-full lowercase">inactivo</span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-right whitespace-nowrap">
                            <button type="button" 
                                class="text-slate-300 hover:text-slate-500 transition-colors btn-edit-aliado"
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
                        <td colspan="8" class="py-12 text-center text-slate-400 italic">No hay aliados registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex flex-col items-center justify-between gap-4 md:flex-row">
        <div class="text-xs text-slate-400 italic">
            Mostrando {{ $aliados->firstItem() ?? 0 }} a {{ $aliados->lastItem() ?? 0 }} de {{ $aliados->total() }} resultados
        </div>
        <div>{{ $aliados->links() }}</div>
    </div>
</div>

@include('admin.modals.create-aliado')
@include('admin.modals.edit-aliado')

@endsection