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
        Schema::create ('movimientos', function (Blueprint $table){
            $table->id();
            
            $table->foreignId('producto_id')
                ->constrained('productos');

            $table->enum('tipo', ['entrada', 'salida', 'ajuste', 'venta', 'anulacion']);
            $table->unsignedInteger('cantidad');
            $table->unsignedInteger('stock_anterior');
            $table->unsignedInteger('stock_nuevo');
            $table->string('motivo', 150);
            $table->text('observacion')->nullable();
            $table->string('estado')->default('activo');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
