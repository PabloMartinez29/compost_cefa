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
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('composting_id');
            $table->integer('day');
            $table->date('date');
            $table->text('activity');
            $table->string('work_hours', 50);
            $table->decimal('temp_internal', 5, 2);
            $table->time('temp_time');
            $table->decimal('temp_env', 5, 2);
            $table->decimal('hum_pile', 5, 2);
            $table->decimal('hum_env', 5, 2);
            $table->decimal('ph', 4, 2);
            $table->decimal('water', 10, 2);
            $table->decimal('lime', 10, 2);
            $table->text('others')->nullable();
            $table->timestamps();

            $table->foreign('composting_id')->references('id')->on('compostings')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trackings');
    }
};
