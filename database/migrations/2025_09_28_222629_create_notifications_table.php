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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Usuario que recibe la notificación (admin)
            $table->unsignedBigInteger('from_user_id'); // Usuario que envía la solicitud (aprendiz)
            $table->unsignedBigInteger('organic_id'); // Registro relacionado
            $table->enum('type', ['delete_request', 'edit_request']); // Tipo de solicitud
            $table->enum('status', ['pending', 'approved', 'rejected', 'processed'])->default('pending'); // Estado de la solicitud
            $table->text('message')->nullable(); // Mensaje adicional
            $table->timestamp('read_at')->nullable(); // Cuando fue leída
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('from_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('organic_id')->references('id')->on('organics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
