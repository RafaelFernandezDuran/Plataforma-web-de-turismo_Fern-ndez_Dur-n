<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('companies', 'reviewed_by')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->dropForeign(['reviewed_by']);
            });
        }

        Schema::table('companies', function (Blueprint $table) {
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
                'contact_position',
                'emergency_phone',
                'latitude',
                'longitude',
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
                'rejection_reason',
                'reviewed_at',
                'reviewed_by',
                'notification_preferences',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('legal_name')->nullable()->after('name');
            $table->string('registration_number')->nullable()->after('ruc');
            $table->string('tax_id')->nullable()->after('registration_number');
            $table->json('documents')->nullable()->after('gallery');
            $table->string('business_license')->nullable()->after('documents');
            $table->string('tourism_license')->nullable()->after('business_license');
            $table->string('insurance_certificate')->nullable()->after('tourism_license');
            $table->string('website')->nullable()->after('phone');
            $table->json('social_media')->nullable()->after('website');
            $table->string('contact_position')->nullable()->after('contact_person');
            $table->string('emergency_phone')->nullable()->after('contact_position');
            $table->decimal('latitude', 10, 8)->nullable()->after('address');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            $table->string('postal_code')->nullable()->after('region');
            $table->text('specialties')->nullable()->after('description');
            $table->json('services')->nullable()->after('specialties');
            $table->json('languages')->nullable()->after('services');
            $table->integer('founded_year')->nullable()->after('languages');
            $table->integer('employee_count')->nullable()->after('founded_year');
            $table->decimal('min_group_size', 3, 0)->default(1)->after('employee_count');
            $table->decimal('max_group_size', 3, 0)->default(50)->after('min_group_size');
            $table->json('certifications')->nullable()->after('max_group_size');
            $table->json('awards')->nullable()->after('certifications');
            $table->text('rejection_reason')->nullable()->after('registration_status');
            $table->timestamp('reviewed_at')->nullable()->after('submitted_at');
            $table->unsignedBigInteger('reviewed_by')->nullable()->after('reviewed_at');
            $table->json('notification_preferences')->nullable()->after('reviewed_by');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->foreign('reviewed_by')->references('id')->on('users');
        });
    }
};
