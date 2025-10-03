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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->date('birth_date')->nullable()->after('phone');
            $table->string('nationality', 3)->default('PER')->after('birth_date'); // Código ISO
            $table->string('document_type')->default('DNI')->after('nationality'); // DNI, Passport, etc.
            $table->string('document_number')->nullable()->after('document_type');
            $table->enum('user_type', ['tourist', 'company_admin', 'admin'])->default('tourist')->after('document_number');
            $table->json('preferences')->nullable()->after('user_type'); // Preferencias de turismo
            $table->string('avatar')->nullable()->after('preferences');
            $table->string('language', 2)->default('es')->after('avatar'); // es, en
            $table->boolean('newsletter_subscription')->default(true)->after('language');
            $table->timestamp('last_activity')->nullable()->after('newsletter_subscription');
            
            // Índices
            $table->index('user_type');
            $table->index(['document_type', 'document_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'birth_date', 'nationality', 'document_type', 
                'document_number', 'user_type', 'preferences', 'avatar', 
                'language', 'newsletter_subscription', 'last_activity'
            ]);
        });
    }
};
