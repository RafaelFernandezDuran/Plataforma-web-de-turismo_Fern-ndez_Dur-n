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
        Schema::table('companies', function (Blueprint $table) {
            // Información de registro y documentación
            $table->string('legal_name')->nullable()->after('name');
            $table->string('registration_number')->nullable()->after('ruc');
            $table->string('tax_id')->nullable()->after('registration_number');
            
            // Documentos legales
            $table->json('documents')->nullable()->after('gallery');
            $table->string('business_license')->nullable()->after('documents');
            $table->string('tourism_license')->nullable()->after('business_license');
            $table->string('insurance_certificate')->nullable()->after('tourism_license');
            
            // Información de contacto expandida
            $table->string('website')->nullable()->after('phone');
            $table->json('social_media')->nullable()->after('website');
            $table->string('contact_person')->nullable()->after('social_media');
            $table->string('contact_position')->nullable()->after('contact_person');
            $table->string('emergency_phone')->nullable()->after('contact_position');
            
            // Información geográfica
            $table->decimal('latitude', 10, 8)->nullable()->after('address');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            $table->string('city')->nullable()->after('longitude');
            $table->string('region')->nullable()->after('city');
            $table->string('postal_code')->nullable()->after('region');
            
            // Información comercial
            $table->text('specialties')->nullable()->after('description');
            $table->json('services')->nullable()->after('specialties');
            $table->json('languages')->nullable()->after('services');
            $table->integer('founded_year')->nullable()->after('languages');
            $table->integer('employee_count')->nullable()->after('founded_year');
            $table->decimal('min_group_size', 3, 0)->default(1)->after('employee_count');
            $table->decimal('max_group_size', 3, 0)->default(50)->after('min_group_size');
            
            // Certificaciones y awards
            $table->json('certifications')->nullable()->after('max_group_size');
            $table->json('awards')->nullable()->after('certifications');
            
            // Estados del registro
            $table->enum('registration_status', ['pending', 'under_review', 'approved', 'rejected', 'suspended'])
                  ->default('pending')->after('status');
            $table->text('rejection_reason')->nullable()->after('registration_status');
            $table->timestamp('submitted_at')->nullable()->after('rejection_reason');
            $table->timestamp('reviewed_at')->nullable()->after('submitted_at');
            $table->unsignedBigInteger('reviewed_by')->nullable()->after('reviewed_at');
            
            // Configuración de notificaciones
            $table->json('notification_preferences')->nullable()->after('reviewed_by');
            
            // Términos y condiciones
            $table->boolean('terms_accepted')->default(false)->after('notification_preferences');
            $table->timestamp('terms_accepted_at')->nullable()->after('terms_accepted');
            
            // Foreign key para reviewer
            $table->foreign('reviewed_by')->references('id')->on('users');
            
            // Índices para mejorar performance
            $table->index(['registration_status']);
            $table->index(['city', 'region']);
            $table->index(['submitted_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['reviewed_by']);
            $table->dropIndex(['registration_status']);
            $table->dropIndex(['city', 'region']);
            $table->dropIndex(['submitted_at']);
            
            $table->dropColumn([
                'legal_name',
                'registration_number',
                'tax_id',
                'documents',
                'business_license',
                'tourism_license',
                'insurance_certificate',
                'website',
                'social_media',
                'contact_person',
                'contact_position',
                'emergency_phone',
                'latitude',
                'longitude',
                'city',
                'region',
                'postal_code',
                'specialties',
                'services',
                'languages',
                'founded_year',
                'employee_count',
                'min_group_size',
                'max_group_size',
                'certifications',
                'awards',
                'registration_status',
                'rejection_reason',
                'submitted_at',
                'reviewed_at',
                'reviewed_by',
                'notification_preferences',
                'terms_accepted',
                'terms_accepted_at'
            ]);
        });
    }
};
