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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address');
            $table->string('ruc', 11)->unique();
            $table->string('logo')->nullable();
            $table->json('gallery')->nullable(); // Galería de imágenes
            $table->decimal('commission_rate', 5, 2)->default(8.00); // Tasa de comisión
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending');
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Usuario administrador
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
            
            // Índices
            $table->index(['status', 'rating']);
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
