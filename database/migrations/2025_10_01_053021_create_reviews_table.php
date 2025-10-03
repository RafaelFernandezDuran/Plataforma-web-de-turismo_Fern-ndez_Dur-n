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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('tour_id')->constrained()->onDelete('cascade');
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->integer('rating'); // 1-5 estrellas
            $table->string('title')->nullable();
            $table->text('comment')->nullable();
            $table->json('photos')->nullable(); // Fotos de la experiencia
            $table->boolean('is_verified')->default(false); // Verificado por haber completado el tour
            $table->boolean('is_approved')->default(true); // Aprobado por moderación
            $table->timestamp('tour_completed_at'); // Fecha en que se completó el tour
            $table->timestamps();
            
            // Índices
            $table->index(['tour_id', 'is_approved', 'rating']);
            $table->index(['company_id', 'is_approved', 'rating']);
            $table->unique(['user_id', 'booking_id']); // Un review por booking
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
