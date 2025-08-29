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
       Schema::create('fertilizer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('composting_id')->constrained('composting')->onDelete('cascade');
            $table->date('date');
            $table->time('time');
            $table->string('requester', 150);
            $table->string('destination', 150);
            $table->string('received_by', 150);
            $table->string('delivered_by', 150);
            $table->enum('type', ["Liquid","Solid"]);
            $table->decimal('amount', 10, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fertilizer');
    }
};
