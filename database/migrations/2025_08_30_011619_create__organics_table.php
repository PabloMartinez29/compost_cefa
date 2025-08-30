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
      Schema::create('organics', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('type', ["Kitchen","Beds","Leaves","CowDung","ChickenManure","PigManure","Other"]);
            $table->decimal('weight', 10, 2);
            $table->text('notes')->nullable();
            $table->string('delivered_by', 100);
            $table->string('received_by', 100);
            $table->string('img')->nullable(); // Imagen
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organics');
    }
};
