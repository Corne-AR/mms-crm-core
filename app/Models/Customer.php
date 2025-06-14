<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dealer;
use App\Models\Quote;
use App\Models\Invoice;
use App\Models\CustomerNote;
use App\Models\CustomerContact;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'contact_person',
        'email',
        'phone',
        'vat_number',
        'vendor_number',
        'catagory',
        'type',
        'language',
        'currency',
        'address',
    ];

    // Relationships
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function notes()
    {
        return $this->hasMany(CustomerNote::class);
    }

    public function contacts()
    {
        return $this->hasMany(CustomerContact::class);
    }

    public function dealers()
    {
        return $this->belongsToMany(Dealer::class, 'customer_sub_dealer_links');
    }
}
