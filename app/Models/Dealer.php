<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;

    protected $fillable = [
        'dealer_name', 'contact_person', 'email', 'phone',
        'address', 'bank_details', 'type', 'logo'
    ];

    public function customers() {
        return $this->hasMany(Customer::class);
    }
}
