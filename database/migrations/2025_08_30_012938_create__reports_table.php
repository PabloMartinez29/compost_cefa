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
        Schema::create('Reports', function (Blueprint $table) {
            $table->id();
            $table->enum('module', ['organics','compostings','trackings','fertilizers','machineries','usage_Controls']);
            $table->unsignedBigInteger('ref_id');
            $table->date('date');
            $table->text('description')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
