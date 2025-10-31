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

    /**
     * Get the full URL for the main image.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->main_image) {
            return null;
        }

        if (filter_var($this->main_image, FILTER_VALIDATE_URL)) {
            return $this->main_image;
        }

        $normalizedPath = ltrim($this->main_image, '/');

        if (str_starts_with($normalizedPath, 'images/')) {
            return asset($normalizedPath);
        }

        return asset('storage/' . $normalizedPath);
    }

    /**
     * Get an optimized image URL when possible.
     */
    public function getOptimizedImageAttribute(): ?string
    {
        $imageUrl = $this->image_url;

        if (!$imageUrl) {
            return null;
        }

        if (str_contains($imageUrl, 'unsplash.com')) {
            $separator = str_contains($imageUrl, '?') ? '&' : '?';
            return $imageUrl . $separator . 'auto=format&fit=crop&w=900&q=80';
        }

        return $imageUrl;
    }

    /**
     * Resolve gallery image URLs.
     */
    public function getGalleryUrlsAttribute(): array
    {
        if (!is_array($this->gallery) || empty($this->gallery)) {
            return [];
        }

        return collect($this->gallery)
            ->filter()
            ->map(function ($image) {
                if (filter_var($image, FILTER_VALIDATE_URL)) {
                    return $image;
                }

                $normalizedPath = ltrim($image, '/');

                if (str_starts_with($normalizedPath, 'images/')) {
                    return asset($normalizedPath);
                }

                return asset('storage/' . $normalizedPath);
            })
            ->values()
            ->all();
    }
}
