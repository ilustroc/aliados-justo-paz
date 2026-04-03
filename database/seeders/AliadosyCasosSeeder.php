<?php

namespace Database\Seeders;

use App\Models\Aliado;
use App\Models\Conciliacion;
use App\Models\User;
use App\Services\AliadoNivelService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AliadosyCasosSeeder extends Seeder
{
    public function run(): void
    {
        $nivel = app(AliadoNivelService::class);

        $aliados = [
            ['nombre' => 'Carlos Mendoza', 'empresa' => 'Estudios Mendoza & Asociados', 'email' => 'carlos@demo.com', 'telefono' => '999111222', 'estado' => 'activo'],
            ['nombre' => 'Lucía Torres', 'empresa' => 'Torres Consultoría Legal', 'email' => 'lucia@demo.com', 'telefono' => '999111223', 'estado' => 'activo'],
            ['nombre' => 'Roberto Salas', 'empresa' => 'Salas & Cía. Abogados', 'email' => 'roberto@demo.com', 'telefono' => '999111224', 'estado' => 'activo'],
            ['nombre' => 'Ana Flores', 'empresa' => 'Flores Mediación', 'email' => 'ana@demo.com', 'telefono' => '999111225', 'estado' => 'activo'],
            ['nombre' => 'Marco Quispe', 'empresa' => 'Quispe Asociados', 'email' => 'marco@demo.com', 'telefono' => '999111226', 'estado' => 'inactivo'],
        ];

        foreach ($aliados as $item) {
            $user = User::create([
                'name' => $item['nombre'],
                'email' => $item['email'],
                'password' => Hash::make('password123'),
                'role' => 'usuario',
                'email_verified_at' => now(),
            ]);

            Aliado::create([
                ...$item,
                'user_id' => $user->id,
                'fecha_registro' => now()->toDateString(),
            ]);
        }

        $casos = [
            [1, 'Conflicto laboral ex empleado', 'Otro', '2026-03-24', 'En proceso'],
            [1, 'Incumplimiento obra civil', 'Incumplimiento', '2026-03-24', 'En proceso'],
            [1, 'Disputa contractual Empresa Norte', 'Contractual', '2026-03-23', 'En proceso'],
            [1, 'Deuda arrendamiento local comercial', 'Deuda', '2026-03-23', 'Cerrada'],
            [1, 'Cobro pendiente proveedor regional', 'Deuda', '2026-03-22', 'En proceso'],
            [1, 'Cierre conciliado caso logística', 'Otro', '2026-03-21', 'Cerrada'],

            [2, 'Deuda cliente corporativo', 'Deuda', '2026-03-24', 'En proceso'],
            [2, 'Controversia de servicio', 'Contractual', '2026-03-22', 'Cerrada'],
            [2, 'Cobro de honorarios', 'Deuda', '2026-03-20', 'En proceso'],

            [3, 'Deuda impaga distribuidor regional', 'Deuda', '2026-03-24', 'En proceso'],
            [3, 'Incumplimiento contrato publicitario', 'Incumplimiento', '2026-03-23', 'En proceso'],
            [3, 'Disputa comercial mayorista', 'Contractual', '2026-03-21', 'Cerrada'],
            [3, 'Proceso de conciliación financiera', 'Deuda', '2026-03-20', 'En proceso'],
            [3, 'Recuperación de deuda civil', 'Deuda', '2026-03-19', 'En proceso'],

            [4, 'Caso inicial de cobranza', 'Deuda', '2026-03-24', 'En proceso'],
        ];

        foreach ($casos as $index => $row) {
            [$aliadoId, $nombreCaso, $tipoCaso, $fecha, $estado] = $row;

            $aliado = Aliado::find($aliadoId);
            $proximo = $nivel->dataByCount($aliado->conciliaciones_acumuladas + 1);

            $conciliacion = Conciliacion::create([
                'codigo' => 'TEMP-' . $index,
                'aliado_id' => $aliadoId,
                'nombre_caso' => $nombreCaso,
                'tipo_caso' => $tipoCaso,
                'fecha_registro' => $fecha,
                'fecha_actualizacion' => now(),
                'tarifa_aplicada' => $proximo['tarifa'],
                'estado' => $estado,
            ]);

            $conciliacion->update([
                'codigo' => 'JP-' . str_pad((string) $conciliacion->id, 3, '0', STR_PAD_LEFT),
            ]);

            $nivel->refresh($aliado->fresh());
        }
    }
}