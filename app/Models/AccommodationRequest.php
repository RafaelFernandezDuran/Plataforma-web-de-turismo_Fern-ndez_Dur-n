<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccommodationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'accommodation_id',
        'name',
        'email',
        'phone',
        'check_in',
        'check_out',
        'guests',
        'message',
        'source',
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
    ];

    public function accommodation(): BelongsTo
    {
        return $this->belongsTo(Accommodation::class);
    }
}
