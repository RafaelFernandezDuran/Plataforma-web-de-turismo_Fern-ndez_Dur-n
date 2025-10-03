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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique(); // Número de reserva
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('tour_id')->constrained()->onDelete('cascade');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->date('tour_date'); // Fecha del tour
            $table->integer('adult_participants');
            $table->integer('child_participants')->default(0);
            $table->decimal('adult_price', 10, 2); // Precio por adulto al momento de la reserva
            $table->decimal('child_price', 10, 2)->default(0); // Precio por niño
            $table->decimal('subtotal', 10, 2); // Subtotal sin comisiones
            $table->decimal('commission', 10, 2); // Comisión de la plataforma
            $table->decimal('total_amount', 10, 2); // Total a pagar
            $table->enum('status', ['pending', 'confirmed', 'paid', 'cancelled', 'completed', 'refunded'])->default('pending');
            $table->enum('payment_status', ['pending', 'partial', 'paid', 'failed', 'refunded'])->default('pending');
            $table->string('payment_method')->nullable(); // stripe, culqi, transfer, etc.
            $table->string('payment_reference')->nullable(); // Referencia del pago
            $table->json('participant_details'); // Detalles de los participantes
            $table->json('special_requests')->nullable(); // Solicitudes especiales
            $table->text('notes')->nullable(); // Notas adicionales
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->string('cancellation_reason')->nullable();
            $table->timestamps();
            
            // Índices
            $table->index(['user_id', 'status']);
            $table->index(['company_id', 'status']);
            $table->index(['tour_date', 'status']);
            $table->index('booking_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
