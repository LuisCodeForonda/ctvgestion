<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalle_mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 30);
            $table->foreignId('componente_id')->nullable()->constrained('componentes')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('mantenimiento_id')->nullable()->constrained('mantenimientos')->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_mantenimientos');
    }
};
