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
        Schema::create('supplier', function (Blueprint $table) {
            $table->id();
            $table->foreignId('machinery_id')->constrained('machinery')->onDelete('cascade');
            $table->string('maker', 150);
            $table->string('origin', 150);
            $table->date('purchase_date');
            $table->string('supplier', 150);
            $table->string('phone', 50);
            $table->string('email', 150);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier');
    }
};
