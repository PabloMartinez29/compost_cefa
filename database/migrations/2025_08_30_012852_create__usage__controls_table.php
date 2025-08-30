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
        Schema::create('usage_Controls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('machinery_id');
            $table->date('date');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('hours');
            $table->string('responsible', 150);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('machinery_id')->references('id')->on('machineries')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usage__controls');
    }
};
