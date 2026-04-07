<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aliado;
use App\Models\User;
use App\Services\AliadoNivelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AliadoController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->q);
        $tramo = $request->tramo;
        $estado = $request->estado;

        $aliados = Aliado::with('user')
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
        $data = $request->validateWithBag('createAliado', [
            'nombre' => ['required', 'string', 'max:120'],
            'empresa' => ['nullable', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150', 'unique:aliados,email', 'unique:users,email'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'estado' => ['required', 'in:activo,inactivo'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['administrador', 'usuario'])],
        ]);

        DB::transaction(function () use ($data, $nivelService) {
            $user = User::create([
                'name' => $data['nombre'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
                'email_verified_at' => now(),
            ]);

            $aliado = Aliado::create([
                'user_id' => $user->id,
                'nombre' => $data['nombre'],
                'empresa' => $data['empresa'] ?? null,
                'email' => $data['email'],
                'telefono' => $data['telefono'] ?? null,
                'estado' => $data['estado'],
                'fecha_registro' => now()->toDateString(),
            ]);

            $nivelService->refresh($aliado);
        });

        return redirect()->route('admin.aliados.index')->with('ok', 'Aliado creado correctamente.');
    }

    public function update(Request $request, Aliado $aliado, AliadoNivelService $nivelService)
    {
        $userId = $aliado->user_id;

        $data = $request->validateWithBag('editAliado', [
            'nombre' => ['required', 'string', 'max:120'],
            'empresa' => ['nullable', 'string', 'max:150'],
            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('aliados', 'email')->ignore($aliado->id),
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'telefono' => ['nullable', 'string', 'max:20'],
            'estado' => ['required', 'in:activo,inactivo'],
            'role' => ['required', Rule::in(['administrador', 'usuario'])],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        DB::transaction(function () use ($data, $aliado, $nivelService) {
            $aliado->update([
                'nombre' => $data['nombre'],
                'empresa' => $data['empresa'] ?? null,
                'email' => $data['email'],
                'telefono' => $data['telefono'] ?? null,
                'estado' => $data['estado'],
            ]);

            if ($aliado->user) {
                $userData = [
                    'name' => $data['nombre'],
                    'email' => $data['email'],
                    'role' => $data['role'],
                ];

                if (!empty($data['password'])) {
                    $userData['password'] = Hash::make($data['password']);
                }

                $aliado->user->update($userData);
            }

            $nivelService->refresh($aliado);
        });

        return back()->with('ok', 'Aliado actualizado correctamente.');
    }
}