@extends('layouts.app')

@section('title', 'Conciliaciones')

@vite(['resources/js/conciliaciones.js'])

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-[#2B2B2B]">Conciliaciones</h1>
            <p class="text-sm text-slate-500">{{ $conciliaciones->total() }} conciliaciones registradas</p>
        </div>
        <button type="button" class="jp-btn-primary gap-2" data-modal-open="modalConciliacion">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Nueva conciliación
        </button>
    </div>

    <div class="jp-table-wrap border-none shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
        <table class="jp-table">
            <thead>
                <tr class="bg-[#F1F3EB]">
                    <th class="text-[11px] font-bold uppercase text-slate-500 py-3">Código</th>
                    <th class="text-[11px] font-bold uppercase text-slate-500 py-3">Caso</th>
                    <th class="text-[11px] font-bold uppercase text-slate-500 py-3">Aliado</th>
                    <th class="text-[11px] font-bold uppercase text-slate-500 py-3">Tipo</th>
                    <th class="text-[11px] font-bold uppercase text-slate-500 py-3">Fecha</th>
                    <th class="text-[11px] font-bold uppercase text-slate-500 py-3 text-right">Tarifa</th>
                    <th class="text-[11px] font-bold uppercase text-slate-500 py-3 text-center">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($conciliaciones as $item)
                    <tr class="row-conciliacion hover:bg-slate-50/50 transition-colors border-b border-slate-50 last:border-0 cursor-pointer"
                        data-item="{{ json_encode($item) }}"
                        data-aliado="{{ $item->aliado?->nombre }}"
                        data-action="{{ route('admin.conciliaciones.update', $item) }}">
                        <td class="py-3 px-6 font-sm text-[11px] text-slate-900 whitespace-nowrap">{{ $item->codigo }}</td>
                        <td class="py-3 px-6 font-semibold text-slate-900 min-w-[300px]">{{ $item->nombre_caso }}</td>
                        <td class="py-3 px-6 text-slate-900 text-sm whitespace-nowrap">{{ $item->aliado?->nombre }}</td>
                        <td class="py-3 px-6 text-slate-900 text-sm">{{ $item->tipo_caso }}</td>
                        <td class="py-3 px-6 text-slate-900 text-sm whitespace-nowrap">{{ optional($item->fecha_registro)->format('d/m/Y') }}</td>
                        <td class="py-3 px-6 font-semibold text-slate-900 text-right whitespace-nowrap">S/ {{ number_format($item->tarifa_aplicada, 0) }}</td>
                        <td class="py-3 px-6 text-center whitespace-nowrap">
                            @php
                                $statusClasses = match($item->estado) {
                                    'En proceso' => 'bg-[#FFF9E5] text-[#D9A321]',
                                    'Cerrada' => 'bg-[#F0FDF4] text-[#166534]',
                                    default => 'bg-slate-100 text-slate-500',
                                };
                            @endphp
                            <span class="inline-block {{ $statusClasses }} text-[10px] font-bold px-3 py-1 rounded-full lowercase">
                                {{ $item->estado }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="py-12 text-center text-slate-400 italic">No hay registros.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    </div>

@include('admin.modals.create-conciliacion')
@include('admin.modals.edit-conciliacion')

@endsection