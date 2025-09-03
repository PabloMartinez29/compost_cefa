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
        Schema::create('fertilizers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('composting_id');
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

            $table->foreign('composting_id')->references('id')->on('compostings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fertilizers');
    }
};