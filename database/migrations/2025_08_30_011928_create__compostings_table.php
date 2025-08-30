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
       Schema::create('compostings', function (Blueprint $table) {
            $table->id();
            $table->integer('pile_num');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->decimal('total_kg', 10, 2);
            $table->decimal('efficiency', 5, 2)->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compostings');
    }
};
