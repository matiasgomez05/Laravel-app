<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'paises';
    protected $primaryKey = 'id_pais';
    public $timestamps = false;
    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paises', function (Blueprint $table) {
            $table->id('id_pais');
            $table->string('nombre');
            $table->string('codigo');
            $table->string('capital');
            $table->string('moneda');
            $table->integer('numero_de_telefono');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paises');
    }
};
