<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'slug',
        'type',
        'description',
        'address',
        'city',
        'region',
        'price_per_night',
        'amenities',
        'main_image',
        'gallery',
        'rating',
        'total_reviews',
        'status',
    ];

    protected $casts = [
        'amenities' => 'array',
        'gallery' => 'array',
        'price_per_night' => 'decimal:2',
        'rating' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $accommodation) {
            if (empty($accommodation->slug)) {
                $accommodation->slug = Str::slug($accommodation->name);
            }
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function requests(): HasMany
    {
        return $this->hasMany(AccommodationRequest::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
