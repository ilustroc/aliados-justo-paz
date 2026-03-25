@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-[#2B2B2B]">Dashboard</h1>
        <p class="text-sm text-slate-500">Resumen general de la campaña 2026</p>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="jp-card p-6">
            <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-[#4A7c44] text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div class="text-3xl font-bold text-[#2B2B2B]">{{ $stats['total_conciliaciones'] }}</div>
            <div class="text-sm text-slate-400">Total conciliaciones</div>
        </div>

        <div class="jp-card p-6">
            <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-[#4A7c44] text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div class="text-3xl font-bold text-[#2B2B2B]">{{ $stats['aliados_activos'] }}</div>
            <div class="text-sm text-slate-400">Aliados activos</div>
        </div>

        <div class="jp-card p-6">
            <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-[#4A7c44] text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>
            <div class="text-3xl font-bold text-[#2B2B2B]">{{ $stats['total_aliados'] }}</div>
            <div class="text-sm text-slate-400">Total aliados</div>
        </div>

        <div class="jp-card p-6">
            <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-[#4A7c44] text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
            </div>
            <div class="text-3xl font-bold text-[#2B2B2B]">{{ $stats['premium'] }}</div>
            <div class="text-sm text-slate-400">En tramo Premium</div>
        </div>
    </div>

    <div class="jp-card p-8">
        <h2 class="text-base font-bold text-[#2B2B2B]">Distribución por tramo</h2>

        <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-4">
            @foreach($distribucion as $tramo => $cantidad)
                <div class="jp-card-soft p-6 text-center">
                    <div class="text-2xl font-bold text-[#2B2B2B]">{{ $cantidad }}</div>
                    <div class="text-xs text-slate-500 font-medium">{{ $tramo }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="rounded-2xl border border-[#F2E8CF] bg-[#FFFBEB] p-6">
        <div class="flex items-center gap-2 mb-4">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B45309]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <h2 class="text-sm font-bold text-[#92400E]">Aliados próximos al siguiente nivel</h2>
        </div>

        <div class="space-y-3">
            @forelse($alertas as $aliado)
                <div class="rounded-xl bg-white/60 px-5 py-4 border border-white/40">
                    <div class="flex flex-col gap-1 md:flex-row md:items-center md:justify-between">
                        <div>
                            <div class="text-sm font-bold text-slate-800">{{ $aliado->nombre }}</div>
                            <div class="text-xs text-slate-500">{{ $aliado->empresa }}</div>
                        </div>
                        <div class="text-xs font-bold text-[#B45309]">
                            {{ $aliado->conciliaciones_acumuladas }} conciliaciones — falta 1 para subir
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-sm text-slate-500 italic">No hay alertas.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection