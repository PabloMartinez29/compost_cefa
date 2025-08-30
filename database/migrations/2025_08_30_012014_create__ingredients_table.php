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
       Schema::create('Ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('composting_id');
            $table->unsignedBigInteger('organic_id');
            $table->decimal('amount', 10, 2);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('composting_id')->references('id')->on('compostings')->onDelete('cascade');
            $table->foreign('organic_id')->references('id')->on('organics')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
