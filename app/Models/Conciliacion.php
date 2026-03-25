<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conciliacion extends Model
{
    protected $table = 'conciliaciones';

    protected $fillable = [
        'codigo',
        'aliado_id',
        'nombre_caso',
        'tipo_caso',
        'fecha_registro',
        'fecha_actualizacion',
        'tarifa_aplicada',
        'estado',
        'comentario_interno',
    ];

    protected $casts = [
        'fecha_registro' => 'date',
        'fecha_actualizacion' => 'datetime',
        'tarifa_aplicada' => 'decimal:2',
    ];

    public function aliado(): BelongsTo
    {
        return $this->belongsTo(Aliado::class);
    }

    public function scopeSearch($query, ?string $value)
    {
        if (!$value) {
            return $query;
        }

        return $query->where(function ($q) use ($value) {
            $q->where('codigo', 'like', "%{$value}%")
              ->orWhere('nombre_caso', 'like', "%{$value}%")
              ->orWhereHas('aliado', function ($sub) use ($value) {
                  $sub->where('nombre', 'like', "%{$value}%");
              });
        });
    }
}