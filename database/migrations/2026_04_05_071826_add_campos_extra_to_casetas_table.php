<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('casetas', function (Blueprint $table) {
            $table->string('nombre_caseta')->nullable()->after('nombre_calle');
            $table->integer('numero_secuencial')->nullable()->after('numero');
        });
    }

    public function down(): void {
        Schema::table('casetas', function (Blueprint $table) {
            $table->dropColumn(['nombre_caseta', 'numero_secuencial']);
        });
    }
};