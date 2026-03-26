@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@php
    $tramosOrdenados = [
        'Inicial' => $distribucion['Inicial'] ?? 0,
        'Preferencial' => $distribucion['Preferencial'] ?? 0,
        'Avanzado' => $distribucion['Avanzado'] ?? 0,
        'Premium' => $distribucion['Premium'] ?? 0,
    ];

    $ultimasLista = $ultimasConciliaciones ?? $ultimas_conciliaciones ?? $ultimas ?? [];
@endphp

<div class="space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-[#1F2937]">Dashboard</h1>
        <p class="mt-1 text-sm text-slate-500">Resumen general de la campaña 2026</p>
    </div>

    <div class="space-y-6">

        <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
            <div class="rounded-xl border border-slate-200 bg-white p-5">
                <div class="mb-3 w-fit rounded-lg bg-[#4A7C44] p-2 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="text-2xl font-bold text-[#1F2937]">{{ $stats['total_conciliaciones'] ?? 0 }}</p>
                <p class="mt-1 text-xs text-slate-500">Total conciliaciones</p>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-5">
                <div class="mb-3 w-fit rounded-lg bg-[#355E3B] p-2 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <p class="text-2xl font-bold text-[#1F2937]">{{ $stats['aliados_activos'] ?? 0 }}</p>
                <p class="mt-1 text-xs text-slate-500">Aliados activos</p>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-5">
                <div class="mb-3 w-fit rounded-lg bg-[#4A7C44] p-2 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
                <p class="text-2xl font-bold text-[#1F2937]">{{ $stats['total_aliados'] ?? 0 }}</p>
                <p class="mt-1 text-xs text-slate-500">Total aliados</p>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-5">
                <div class="mb-3 w-fit rounded-lg bg-[#355E3B] p-2 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"/>
                        <circle cx="12" cy="8" r="6"/>
                    </svg>
                </div>
                <p class="text-2xl font-bold text-[#1F2937]">{{ $stats['premium'] ?? 0 }}</p>
                <p class="mt-1 text-xs text-slate-500">En tramo Premium</p>
            </div>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6">
            <h3 class="mb-4 text-sm font-semibold text-[#1F2937]">Distribución por tramo</h3>

            <div class="grid grid-cols-2 gap-3 md:grid-cols-4">
                @foreach($tramosOrdenados as $tramo => $cantidad)
                    <div class="rounded-lg bg-[#F1F3ED] p-3 text-center">
                        <p class="text-lg font-bold text-[#1F2937]">{{ $cantidad }}</p>
                        <p class="text-xs text-slate-500">{{ $tramo }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="rounded-xl border border-amber-200 bg-amber-50 p-5">
        <div class="mb-3 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01"/>
            </svg>
            <h3 class="text-sm font-semibold text-amber-800">Aliados próximos al siguiente nivel</h3>
        </div>

        <div class="space-y-2">
            @forelse($alertas as $aliado)
                <div class="flex items-center justify-between rounded-lg bg-white/70 px-4 py-2.5">
                    <div>
                        <p class="text-sm font-medium text-[#1F2937]">{{ $aliado->nombre }}</p>
                        <p class="text-xs text-slate-500">{{ $aliado->empresa }}</p>
                    </div>
                    <p class="text-xs font-medium text-amber-700">
                        {{ $aliado->conciliaciones_acumuladas }} conciliaciones — falta 1 para subir
                    </p>
                </div>
            @empty
                <div class="rounded-lg bg-white/70 px-4 py-2.5 text-sm text-slate-500">
                    No hay alertas.
                </div>
            @endforelse
        </div>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6">
        <h3 class="mb-4 text-sm font-semibold text-[#1F2937]">Últimas conciliaciones</h3>

        <div class="space-y-2">
            @forelse($ultimasLista as $item)
                <div class="flex items-center justify-between border-b border-slate-200 py-2 last:border-0">
                    <div>
                        <p class="text-sm font-medium text-[#1F2937]">
                            {{ $item->titulo ?? $item->asunto ?? $item->nombre ?? 'Conciliación' }}
                        </p>
                        <p class="text-xs text-slate-500">
                            {{ $item->aliado ?? $item->nombre_aliado ?? '—' }}
                            @if(!empty($item->codigo))
                                • {{ $item->codigo }}
                            @elseif(!empty($item->numero))
                                • {{ $item->numero }}
                            @endif
                        </p>
                    </div>

                    <span class="rounded-full bg-yellow-100 px-2 py-1 text-xs text-yellow-700">
                        {{ $item->estado ?? 'en proceso' }}
                    </span>
                </div>
            @empty
                <div class="text-sm text-slate-500">No hay conciliaciones recientes.</div>
            @endforelse
        </div>
    </div>

</div>
@endsection