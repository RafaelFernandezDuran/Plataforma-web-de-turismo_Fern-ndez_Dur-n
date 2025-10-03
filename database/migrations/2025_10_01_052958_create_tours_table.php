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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('itinerary')->nullable(); // Itinerario detallado
            $table->json('included_services'); // Servicios incluidos
            $table->json('excluded_services')->nullable(); // Servicios no incluidos
            $table->decimal('price', 10, 2); // Precio base por persona
            $table->decimal('child_price', 10, 2)->nullable(); // Precio para niños
            $table->integer('duration_days'); // Duración en días
            $table->integer('duration_hours')->nullable(); // Horas adicionales
            $table->integer('min_participants')->default(1);
            $table->integer('max_participants');
            $table->string('difficulty_level'); // fácil, moderado, difícil, extremo
            $table->json('gallery'); // Galería de imágenes
            $table->string('main_image'); // Imagen principal
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->json('meeting_points')->nullable(); // Puntos de encuentro
            $table->json('pickup_locations')->nullable(); // Puntos de recojo
            $table->enum('status', ['active', 'inactive', 'draft'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->integer('total_bookings')->default(0);
            $table->json('available_dates')->nullable(); // Fechas disponibles
            $table->json('tags')->nullable(); // Tags para búsqueda
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('tour_category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Índices para optimizar búsquedas
            $table->index(['status', 'is_featured', 'rating']);
            $table->index(['company_id', 'status']);
            $table->index(['tour_category_id', 'status']);
            $table->index(['price', 'status']);
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
