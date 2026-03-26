<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aliado;
use App\Services\AliadoNivelService;
use Illuminate\Http\Request;

class AliadoController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->q);
        $tramo = $request->tramo;
        $estado = $request->estado;

        $aliados = Aliado::query()
            ->search($q)
            ->when($tramo, fn ($query) => $query->where('tramo_actual', $tramo))
            ->when($estado, fn ($query) => $query->where('estado', $estado))
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        $aliados_list = Aliado::where('estado', 'activo')->orderBy('nombre')->get();

        return view('admin.aliados.index', compact('aliados', 'q', 'tramo', 'estado', 'aliados_list'));
    }

    public function store(Request $request, AliadoNivelService $nivelService)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:120'],
            'empresa' => ['nullable', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150', 'unique:aliados,email'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'estado' => ['required', 'in:activo,inactivo'],
        ]);

        $aliado = Aliado::create([
            ...$data,
            'fecha_registro' => now()->toDateString(),
        ]);

        $nivelService->refresh($aliado);

        return redirect()->route('admin.aliados.index')->with('ok', 'Aliado creado correctamente.');
    }

    public function update(Request $request, Aliado $aliado, AliadoNivelService $nivelService)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:120'],
            'empresa' => ['nullable', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150', 'unique:aliados,email,' . $aliado->id],
            'estado' => ['required', 'in:activo,inactivo'],
        ]);

        $aliado->update($data);
        $nivelService->refresh($aliado);

        return back()->with('ok', 'Aliado actualizado correctamente.');
    }
}