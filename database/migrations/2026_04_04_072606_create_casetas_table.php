<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('casetas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_calle');
            $table->string('numero');
            $table->decimal('lat', 9, 7);
            $table->decimal('lon', 9, 7);
            $table->string('tipo')->comment('municipal, servicio, privada, informacion');
            $table->string('descripcion')->nullable();
            $table->string('distrito')->nullable();
            $table->year('anio_feria')->default(2026);
            $table->timestamps();
            $table->index(['nombre_calle', 'numero']);
        });
    }

    public function down(): void { Schema::dropIfExists('casetas'); }
};