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
        'description',
        'email',
        'phone',
        'address',
        'city',
        'region',
        'ruc',
        'logo',
        'gallery',
        'contact_person',
        'commission_rate',
        'status',
        'registration_status',
        'rating',
        'total_reviews',
        'user_id',
        'verified_at',
        'submitted_at',
        'terms_accepted',
        'terms_accepted_at',
    ];

    protected $casts = [
        'gallery' => 'array',
        'commission_rate' => 'decimal:2',
        'rating' => 'decimal:2',
        'terms_accepted' => 'boolean',
        'verified_at' => 'datetime',
        'submitted_at' => 'datetime',
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
        $parts = array_filter([$this->address, $this->city, $this->region]);
        return implode(', ', $parts);
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
        return !empty($this->logo) &&
               !empty($this->ruc) &&
               !empty($this->address);
    }
}
