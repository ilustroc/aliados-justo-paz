<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aliado extends Model
{
    protected $table = 'aliados';

    protected $fillable = [
        'user_id',
        'nombre',
        'empresa',
        'tipo_aliado',
        'email',
        'telefono',
        'estado',
        'fecha_registro',
        'conciliaciones_acumuladas',
        'tramo_actual',
        'tarifa_actual',
        'conciliaciones_para_siguiente_tramo',
        'califica_incentivo_anual',
        'observaciones_internas',
        'ultimo_acceso',
    ];

    protected $casts = [
        'fecha_registro' => 'date',
        'ultimo_acceso' => 'datetime',
        'califica_incentivo_anual' => 'boolean',
        'tarifa_actual' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function conciliaciones(): HasMany
    {
        return $this->hasMany(Conciliacion::class);
    }

    public function scopeSearch($query, ?string $value)
    {
        if (!$value) {
            return $query;
        }

        return $query->where(function ($q) use ($value) {
            $q->where('nombre', 'like', "%{$value}%")
              ->orWhere('empresa', 'like', "%{$value}%")
              ->orWhere('email', 'like', "%{$value}%")
              ->orWhere('telefono', 'like', "%{$value}%");
        });
    }
}