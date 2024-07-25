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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->longText('descripcion', 400);
            $table->foreignId('marca_id')->nullable()->constrained('marcas')->cascadeOnUpdate()->nullOnDelete();
            $table->string('modelo', 30)->nullable();
            $table->string('serie', 50)->nullable();
            $table->string('serietec', 50)->unique();
            $table->tinyInteger('estado');
            $table->string('observaciones', 150)->nullable();
            $table->foreignId('persona_id')->nullable()->constrained('personas')->cascadeOnUpdate()->nullOnDelete();
            $table->string('slug', 50)->unique();
            $table->timestamps();

            /*
             $table->string('titulo');
            $table->string('slug');
            $table->longText('body');
            $table->string('image');
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            
            
            */ 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
