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
        $user = $request->user();

        $query = Conciliacion::query()
            ->with('aliado')
            ->search($q);

        if ($user->role !== 'administrador') {
            $aliado = $user->aliado;

            if (!$aliado) {
                $conciliaciones = Conciliacion::query()
                    ->whereRaw('1 = 0')
                    ->paginate(10)
                    ->withQueryString();

                $aliados = collect();

                return view('admin.conciliaciones.index', compact('conciliaciones', 'aliados', 'q'));
            }

            $query->where('aliado_id', $aliado->id);
        }

        $conciliaciones = $query
            ->latest('fecha_registro')
            ->paginate(10)
            ->withQueryString();

        $aliados = $user->role === 'administrador'
            ? Aliado::where('estado', 'activo')->orderBy('nombre')->get()
            : collect();

        return view('admin.conciliaciones.index', compact('conciliaciones', 'aliados', 'q'));
    }

    public function store(Request $request, AliadoNivelService $nivelService)
    {
        if ($request->user()->role !== 'administrador') {
            abort(403, 'No tienes permiso para registrar conciliaciones.');
        }

        $data = $request->validate([
            'aliado_id' => ['required', 'exists:aliados,id'],
            'nombre_caso' => ['required', 'string', 'max:180'],
            'tipo_caso' => ['required', 'in:Deuda,Incumplimiento,Contractual,Otro'],
            'fecha_registro' => ['required', 'date'],
            'estado' => ['required', 'in:En proceso,Cerrada,No concretada'],
        ]);

        DB::transaction(function () use ($data, $nivelService) {
            $aliado = Aliado::findOrFail($data['aliado_id']);

            $configuracionSiguiente = $nivelService->dataByCount($aliado->conciliaciones_acumuladas + 1);

            $conciliacion = Conciliacion::create([
                ...$data,
                'codigo' => 'TEMP',
                'tarifa_aplicada' => $configuracionSiguiente['tarifa'],
                'fecha_actualizacion' => now(),
            ]);

            $conciliacion->update([
                'codigo' => 'JP-' . str_pad((string) $conciliacion->id, 3, '0', STR_PAD_LEFT),
            ]);

            $nivelService->refresh($aliado->fresh());
        });

        return redirect()->route('admin.conciliaciones.index')->with('ok', 'Conciliación registrada correctamente.');
    }

    public function update(Request $request, Conciliacion $conciliacion)
    {

        if ($request->user()->role !== 'administrador') {
            abort(403, 'No tienes permiso para editar conciliaciones.');
        }
        
        $data = $request->validate([
            'nombre_caso' => ['required', 'string', 'max:180'],
            'tipo_caso' => ['required', 'in:Deuda,Incumplimiento,Contractual,Otro'],
            'fecha_registro' => ['required', 'date'],
            'estado' => ['required', 'in:En proceso,Cerrada,No concretada'],
        ]);

        $conciliacion->update($data);

        return redirect()->route('admin.conciliaciones.index')->with('ok', 'Conciliación actualizada correctamente.');
    }
}