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
        Schema::create('Suppliers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('machinery_id');
            $table->string('maker', 150);
            $table->string('origin', 150);
            $table->date('purchase_date');
            $table->string('supplier', 150);
            $table->string('phone', 50);
            $table->string('email', 150);
            $table->timestamps();

            $table->foreign('machinery_id')->references('id')->on('machineries')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
