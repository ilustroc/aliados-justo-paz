<?php

namespace App\Services;

use App\Models\Aliado;

class AliadoNivelService
{
    public function dataByCount(int $count): array
    {
        // Tramo 4 – Premium: 8 o más [cite: 73, 149]
        if ($count >= 8) {
            return [
                'tramo' => 'Premium',
                'tarifa' => 250, // [cite: 73, 154]
                'faltan' => 0,
                'califica' => true, // [cite: 79, 165]
                'siguiente_tramo' => 'Premium',
                'siguiente_tarifa' => 250,
            ];
        }

        // Tramo 3 – Avanzado: 5 a 7 [cite: 72, 148]
        if ($count >= 5) {
            return [
                'tramo' => 'Avanzado',
                'tarifa' => 270, // [cite: 72, 153]
                'faltan' => 8 - $count,
                'califica' => false,
                'siguiente_tramo' => 'Premium',
                'siguiente_tarifa' => 250,
            ];
        }

        // Tramo 2 – Preferencial: 2 a 4 [cite: 71, 147]
        if ($count >= 2) {
            return [
                'tramo' => 'Preferencial',
                'tarifa' => 290, // [cite: 71, 152]
                'faltan' => 5 - $count,
                'califica' => false,
                'siguiente_tramo' => 'Avanzado',
                'siguiente_tarifa' => 270,
            ];
        }

        // Tramo 1 – Inicio: 1 [cite: 70, 146]
        if ($count >= 1) {
            return [
                'tramo' => 'Inicio',
                'tarifa' => 300, // [cite: 70, 151]
                'faltan' => 2 - $count,
                'califica' => false,
                'siguiente_tramo' => 'Preferencial',
                'siguiente_tarifa' => 290,
            ];
        }

        // Cliente no aliado / Sin tramo [cite: 66]
        return [
            'tramo' => 'Sin tramo',
            'tarifa' => 350,
            'faltan' => 1,
            'califica' => false,
            'siguiente_tramo' => 'Inicio',
            'siguiente_tarifa' => 300,
        ];
    }

    public function refresh(Aliado $aliado): void
    {
        $count = $aliado->conciliaciones()->count();
        $data = $this->dataByCount($count);

        $aliado->update([
            'conciliaciones_acumuladas' => $count,
            'tramo_actual' => $data['tramo'],
            'tarifa_actual' => $data['tarifa'],
            'conciliaciones_para_siguiente_tramo' => $data['faltan'],
            'califica_incentivo_anual' => $data['califica'],
        ]);
    }
}