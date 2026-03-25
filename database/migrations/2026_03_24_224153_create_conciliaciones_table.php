<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('conciliaciones', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->foreignId('aliado_id')->constrained('aliados')->cascadeOnDelete();
            $table->string('nombre_caso');
            $table->enum('tipo_caso', ['Deuda', 'Incumplimiento', 'Contractual', 'Otro'])->default('Deuda');
            $table->date('fecha_registro');
            $table->timestamp('fecha_actualizacion')->nullable();
            $table->decimal('tarifa_aplicada', 10, 2);
            $table->enum('estado', ['En proceso', 'Cerrada', 'No concretada'])->default('En proceso');
            $table->text('comentario_interno')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conciliaciones');
    }
};