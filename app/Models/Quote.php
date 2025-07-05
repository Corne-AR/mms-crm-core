<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_number',
        'dealer_id',
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

    /**
     * Dealer who owns this quote.
     */
    public function dealer()
    {
        return $this->belongsTo(Dealer::class, 'dealer_id');
    }

    /**
     * User who created the quote.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Customer for this quote.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Items in this quote.
     */
    public function items()
    {
        return $this->hasMany(QuoteItem::class);
    }
}
