<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('aliados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('empresa')->nullable();
            $table->string('tipo_aliado')->nullable();
            $table->string('email')->unique();
            $table->string('telefono')->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->date('fecha_registro')->nullable();
            $table->unsignedInteger('conciliaciones_acumuladas')->default(0);
            $table->string('tramo_actual')->default('Sin tramo');
            $table->decimal('tarifa_actual', 10, 2)->default(350);
            $table->unsignedInteger('conciliaciones_para_siguiente_tramo')->default(1);
            $table->boolean('califica_incentivo_anual')->default(false);
            $table->text('observaciones_internas')->nullable();
            $table->timestamp('ultimo_acceso')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aliados');
    }
};