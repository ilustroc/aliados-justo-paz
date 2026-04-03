<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aliado;
use App\Models\Conciliacion;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        if ($user->role === 'administrador') {
            $stats = [
                'total_conciliaciones' => Conciliacion::count(),
                'aliados_activos' => Aliado::where('estado', 'activo')->count(),
                'total_aliados' => Aliado::count(),
                'premium' => Aliado::where('tramo_actual', 'Premium')->count(),
            ];

            $distribucion = [
                'Inicial' => Aliado::where('tramo_actual', 'Inicial')->count(),
                'Preferencial' => Aliado::where('tramo_actual', 'Preferencial')->count(),
                'Avanzado' => Aliado::where('tramo_actual', 'Avanzado')->count(),
                'Premium' => Aliado::where('tramo_actual', 'Premium')->count(),
            ];

            $alertas = Aliado::query()
                ->where('estado', 'activo')
                ->where('conciliaciones_para_siguiente_tramo', 1)
                ->where('tramo_actual', '!=', 'Premium')
                ->orderBy('conciliaciones_acumuladas', 'desc')
                ->get();

            $ultimasConciliaciones = Conciliacion::query()
                ->with('aliado')
                ->latest('fecha_registro')
                ->take(8)
                ->get()
                ->map(function ($item) {
                    return (object) [
                        'nombre' => $item->nombre_caso,
                        'aliado' => $item->aliado?->nombre ?? '—',
                        'codigo' => $item->codigo,
                        'estado' => $item->estado,
                    ];
                });

            return view('admin.dashboard', compact('stats', 'distribucion', 'alertas', 'ultimasConciliaciones'));
        }

        $aliado = $user->aliado;

        if (!$aliado) {
            $stats = [
                'total_conciliaciones' => 0,
                'aliados_activos' => 0,
                'total_aliados' => 0,
                'premium' => 0,
            ];

            $distribucion = [
                'Inicial' => 0,
                'Preferencial' => 0,
                'Avanzado' => 0,
                'Premium' => 0,
            ];

            $alertas = collect();
            $ultimasConciliaciones = collect();

            return view('admin.dashboard', compact('stats', 'distribucion', 'alertas', 'ultimasConciliaciones', 'aliado'));
        }

        $totalConciliacionesAliado = Conciliacion::where('aliado_id', $aliado->id)->count();

        $stats = [
            'total_conciliaciones' => $totalConciliacionesAliado,
            'aliados_activos' => $aliado->estado === 'activo' ? 1 : 0,
            'total_aliados' => 1,
            'premium' => $aliado->tramo_actual === 'Premium' ? 1 : 0,
        ];

        $distribucion = [
            'Inicial' => $aliado->tramo_actual === 'Inicial' ? 1 : 0,
            'Preferencial' => $aliado->tramo_actual === 'Preferencial' ? 1 : 0,
            'Avanzado' => $aliado->tramo_actual === 'Avanzado' ? 1 : 0,
            'Premium' => $aliado->tramo_actual === 'Premium' ? 1 : 0,
        ];

        $alertas = collect();
        if (
            $aliado->estado === 'activo' &&
            $aliado->conciliaciones_para_siguiente_tramo == 1 &&
            $aliado->tramo_actual !== 'Premium'
        ) {
            $alertas = collect([$aliado]);
        }

        $ultimasConciliaciones = Conciliacion::query()
            ->with('aliado')
            ->where('aliado_id', $aliado->id)
            ->latest('fecha_registro')
            ->take(8)
            ->get()
            ->map(function ($item) {
                return (object) [
                    'nombre' => $item->nombre_caso,
                    'aliado' => $item->aliado?->nombre ?? '—',
                    'codigo' => $item->codigo,
                    'estado' => $item->estado,
                ];
            });

        return view('admin.dashboard', compact('stats', 'distribucion', 'alertas', 'ultimasConciliaciones', 'aliado'));
    }
}