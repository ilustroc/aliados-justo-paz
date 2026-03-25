<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aliado;
use App\Models\Conciliacion;

class DashboardController extends Controller
{
    public function __invoke()
    {
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

        return view('admin.dashboard', compact('stats', 'distribucion', 'alertas'));
    }
}