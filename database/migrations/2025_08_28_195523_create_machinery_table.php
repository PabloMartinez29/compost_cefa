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
        Schema::create('machinery', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('location', 150);
            $table->string('brand', 100);
            $table->string('model', 100);
            $table->string('serial', 100);
            $table->date('start_func');
            $table->string('maint_freq', 100);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machinery');
    }
};
