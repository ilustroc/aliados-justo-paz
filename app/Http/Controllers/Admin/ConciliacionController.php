<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aliado;
use App\Models\Conciliacion;
use App\Services\AliadoNivelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConciliacionController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->q);

        $conciliaciones = Conciliacion::query()
            ->with('aliado')
            ->search($q)
            ->latest('fecha_registro')
            ->paginate(10)
            ->withQueryString();

        $aliados = Aliado::where('estado', 'activo')->orderBy('nombre')->get();

        return view('admin.conciliaciones.index', compact('conciliaciones', 'aliados', 'q'));
    }

    public function store(Request $request, AliadoNivelService $nivelService)
    {
        $data = $request->validate([
            'aliado_id' => ['required', 'exists:aliados,id'],
            'nombre_caso' => ['required', 'string', 'max:180'],
            'tipo_caso' => ['required', 'in:Deuda,Incumplimiento,Contractual,Otro'],
            'fecha_registro' => ['required', 'date'],
            'estado' => ['required', 'in:En proceso,Cerrada,No concretada'],
        ]);

        DB::transaction(function () use ($data, $nivelService) {
            $aliado = Aliado::findOrFail($data['aliado_id']);

            $proximo = $nivelService->dataByCount($aliado->conciliaciones_acumuladas + 1);

            $conciliacion = Conciliacion::create([
                ...$data,
                'codigo' => 'TEMP',
                'tarifa_aplicada' => $proximo['tarifa'],
                'fecha_actualizacion' => now(),
            ]);

            $conciliacion->update([
                'codigo' => 'JP-' . str_pad((string) $conciliacion->id, 3, '0', STR_PAD_LEFT),
            ]);

            $nivelService->refresh($aliado->fresh());
        });

        return redirect()->route('admin.conciliaciones.index')->with('ok', 'Conciliación registrada correctamente.');
    }
}