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
        Schema::create('warehouse_classification', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('type', ["Kitchen","Beds","Leaves","CowDung","ChickenManure","PigManure","Other"]);
            $table->enum('movement_type', ['entry', 'exit']); // entrada o salida
            $table->decimal('weight', 10, 2);
            $table->text('notes')->nullable();
            $table->string('processed_by', 100); // quien procesó el movimiento
            $table->string('img')->nullable(); // Imagen opcional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_classification');
    }
};
