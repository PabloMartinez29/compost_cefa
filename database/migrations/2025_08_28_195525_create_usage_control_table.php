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
        Schema::create('usage_control', function (Blueprint $table) {
            $table->id();
            $table->foreignId('machinery_id')->constrained('machinery')->onDelete('cascade');
            $table->date('date');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('hours');
            $table->string('responsible', 150);
            $table->text('description')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usage_control');
    }
};
