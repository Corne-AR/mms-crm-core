<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;

    protected $fillable = [
        'dealer_name',
        'type',
        'contact_person',
        'email',
        'phone',
        'address',
        'bank_details',
        'logo',
    ];

    /**
     * Users that belong to this dealer.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'dealer_id');
    }

    /**
     * Quotes created by this dealer.
     */
    public function quotes()
    {
        return $this->hasMany(Quote::class, 'dealer_id');
    }

    /**
     * Get the full public URL to the uploaded logo.
     */
    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? asset('storage/' . $this->logo) : null;
    }
}
