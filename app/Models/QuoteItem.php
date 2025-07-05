<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_id',
        'product_id',
        'kit_id',
        'qty',
        'unit_price',
        'line_discount',
        'line_total',
    ];

    protected $casts = [
        'qty' => 'integer',
        'unit_price' => 'float',
        'line_discount' => 'float',
    ];

    /**
     * The quote this item belongs to.
     */
    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    /**
     * The product this item references.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * The kit this item references.
     */
    public function kit()
    {
        return $this->belongsTo(Kit::class);
    }

    /**
     * Get the total price of this line (qty * unit_price - discount).
     */
    public function getLineTotalAttribute(): float
    {
        return max(0, ($this->qty * $this->unit_price) - $this->line_discount);
    }

    /**
     * Get the display name for the item (product or kit name).
     */
    public function getDisplayNameAttribute()
    {
        if ($this->product) {
            return $this->product->name;
        } elseif ($this->kit) {
            return '[Kit] ' . $this->kit->name;
        } else {
            return 'Unknown Item';
        }
    }
}
