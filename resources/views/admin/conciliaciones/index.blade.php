@extends('layouts.app')

@section('title', 'Conciliaciones')

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

    <form method="GET" action="{{ route('admin.conciliaciones.index') }}" class="search-container">
        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <input type="text" name="q" value="{{ $q }}" 
               class="search-input-alt !py-3" 
               placeholder="Buscar por caso, aliado o código...">
    </form>

    <div class="jp-table-wrap border-none shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
        <table class="jp-table">
            <thead>
                <tr class="bg-[#F1F3EB]">
                    <th class="text-[11px] font-bold uppercase text-slate-500">Código</th>
                    <th class="text-[11px] font-bold uppercase text-slate-500">Caso</th>
                    <th class="text-[11px] font-bold uppercase text-slate-500">Aliado</th>
                    <th class="text-[11px] font-bold uppercase text-slate-500">Tipo</th>
                    <th class="text-[11px] font-bold uppercase text-slate-500">Fecha</th>
                    <th class="text-[11px] font-bold uppercase text-slate-500 text-right">Tarifa</th>
                    <th class="text-[11px] font-bold uppercase text-slate-500 text-center">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($conciliaciones as $item)
                    <tr class="hover:bg-slate-50/50 transition-colors border-b border-slate-50 last:border-0">
                        <td class="py-3 px-6 font-sm text-slate-700 whitespace-nowrap">
                            {{ $item->codigo }}
                        </td>

                        <td class="py-3 px-6 font-semibold text-slate-700 min-w-[300px]">
                            {{ $item->nombre_caso }}
                        </td>

                        <td class="py-3 px-6 text-slate-700 text-semibold whitespace-nowrap">
                            {{ $item->aliado?->nombre }}
                        </td>

                        <td class="py-3 px-6 text-slate-700 text-semibold">
                            {{ $item->tipo_caso }}
                        </td>

                        <td class="py-3 px-6 text-slate-700 text-semibold whitespace-nowrap">
                            {{ optional($item->fecha_registro)->format('d/m/Y') }}
                        </td>

                        <td class="py-3 px-6 text-slate-800 text-semibold whitespace-nowrap">
                            S/ {{ number_format($item->tarifa_aplicada, 0) }}
                        </td>

                        <td class="py-3 px-6 text-center whitespace-nowrap">
                            @if($item->estado === 'En proceso')
                                <span class="inline-block bg-[#FFF9E5] text-[#D9A321] text-[11px] font-bold px-3 py-1 rounded-full lowercase">
                                    en proceso
                                </span>
                            @elseif($item->estado === 'Cerrada')
                                <span class="inline-block bg-[#F0FDF4] text-[#166534] text-[11px] font-bold px-3 py-1 rounded-full lowercase">
                                    cerrada
                                </span>
                            @else
                                <span class="inline-block bg-slate-100 text-slate-500 text-[11px] font-bold px-3 py-1 rounded-full lowercase">
                                    no concretada
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-slate-400 italic">No hay registros para esta búsqueda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-8 flex flex-col items-center justify-between gap-4 md:flex-row border-t border-slate-100 pt-6">
        <div class="text-xs text-slate-400">
            Mostrando <span class="font-bold text-slate-600">{{ $conciliaciones->firstItem() ?? 0 }}</span> a 
            <span class="font-bold text-slate-600">{{ $conciliaciones->lastItem() ?? 0 }}</span> de 
            <span class="font-bold text-slate-600">{{ $conciliaciones->total() }}</span> resultados
        </div>
        
        <div class="pagination-container">
            {{ $conciliaciones->appends(['q' => $q])->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection