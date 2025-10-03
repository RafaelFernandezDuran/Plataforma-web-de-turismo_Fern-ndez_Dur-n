<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'legal_name',
        'description',
        'email',
        'phone',
        'emergency_phone',
        'address',
        'city',
        'region',
        'postal_code',
        'latitude',
        'longitude',
        'ruc',
        'registration_number',
        'tax_id',
        'logo',
        'gallery',
        'documents',
        'business_license',
        'tourism_license',
        'insurance_certificate',
        'website',
        'social_media',
        'contact_person',
        'contact_position',
        'specialties',
        'services',
        'languages',
        'founded_year',
        'employee_count',
        'min_group_size',
        'max_group_size',
        'certifications',
        'awards',
        'commission_rate',
        'status',
        'registration_status',
        'rejection_reason',
        'rating',
        'total_reviews',
        'user_id',
        'verified_at',
        'submitted_at',
        'reviewed_at',
        'reviewed_by',
        'notification_preferences',
        'terms_accepted',
        'terms_accepted_at',
    ];

    protected $casts = [
        'gallery' => 'array',
        'documents' => 'array',
        'social_media' => 'array',
        'services' => 'array',
        'languages' => 'array',
        'certifications' => 'array',
        'awards' => 'array',
        'notification_preferences' => 'array',
        'commission_rate' => 'decimal:2',
        'rating' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'terms_accepted' => 'boolean',
        'verified_at' => 'datetime',
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'terms_accepted_at' => 'datetime',
    ];

    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeVerified($query)
    {
        return $query->whereNotNull('verified_at');
    }

    public function scopePendingReview($query)
    {
        return $query->where('registration_status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('registration_status', 'approved');
    }

    public function scopeByRegion($query, $region)
    {
        return $query->where('region', $region);
    }

    public function scopeByServices($query, $services)
    {
        return $query->whereJsonContains('services', $services);
    }

    // Mutators y Accessors
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getIsVerifiedAttribute()
    {
        return !is_null($this->verified_at);
    }

    public function getActiveToursCountAttribute()
    {
        return $this->tours()->where('status', 'active')->count();
    }

    public function getRegistrationStatusColorAttribute()
    {
        return match($this->registration_status) {
            'pending' => 'warning',
            'under_review' => 'info',
            'approved' => 'success',
            'rejected' => 'danger',
            'suspended' => 'danger',
            default => 'secondary'
        };
    }

    public function getRegistrationStatusTextAttribute()
    {
        return match($this->registration_status) {
            'pending' => 'Pendiente de Revisión',
            'under_review' => 'En Revisión',
            'approved' => 'Aprobado',
            'rejected' => 'Rechazado',
            'suspended' => 'Suspendido',
            default => 'Desconocido'
        };
    }

    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/' . $this->logo) : asset('images/company-placeholder.jpg');
    }

    public function getFullAddressAttribute()
    {
        $parts = array_filter([$this->address, $this->city, $this->region, $this->postal_code]);
        return implode(', ', $parts);
    }

    // Relación con reviewer
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // Métodos de utilidad
    public function canBeApproved()
    {
        return in_array($this->registration_status, ['pending', 'under_review']);
    }

    public function canBeRejected()
    {
        return in_array($this->registration_status, ['pending', 'under_review']);
    }

    public function hasRequiredDocuments()
    {
        return !empty($this->business_license) && 
               !empty($this->logo) && 
               !empty($this->ruc);
    }
}
