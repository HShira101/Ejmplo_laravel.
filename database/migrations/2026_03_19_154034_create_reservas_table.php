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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id('codigo');
            $table->unsignedBigInteger('id_habitacion');
            $table->integer('rut_cliente');
            $table->date('fecha_ini')->nullable();
            $table->date('fecha_termino')->nullable();
            $table->unsignedBigInteger('id_agencia')->default(0);
            $table->boolean('check_in')->default(false);
            $table->json('observaciones')->nullable();
            
            // Llaves foráneas
            $table->foreign('rut_cliente')->references('rut')->on('clientes')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
