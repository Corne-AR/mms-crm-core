<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Customer;
use App\Models\QuoteItem;
use App\Models\QuoteKit;
use App\Models\QuoteStatus;
use App\Models\TermsCondition;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_number',
        'subdealer_id',
        'customer_id',
        'user_id',
        'quote_date',
        'status',
        'terms',
        'subtotal',
        'vat_amount',
        'total_amount',
        'currency',
        'is_pdf_generated',
    ];

    protected $casts = [
        'quote_date' => 'date',
        'terms' => 'array',
        'is_pdf_generated' => 'boolean',
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function subdealer()
    {
        return $this->belongsTo(User::class, 'subdealer_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(QuoteItem::class);
    }

    public function kits()
    {
        return $this->hasMany(QuoteKit::class);
    }

    public function status()
    {
        return $this->belongsTo(QuoteStatus::class, 'status', 'name');
    }

    public function termsConditions()
    {
        return $this->belongsToMany(TermsCondition::class, 'quote_terms_link');
    }
}
