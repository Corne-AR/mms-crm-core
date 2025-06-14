<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'currency'
    ];

    public function quoteItems() {
        return $this->hasMany(QuoteItem::class);
    }

    public function kitItems() {
        return $this->hasMany(KitItem::class);
    }

    public function invoiceItems() {
        return $this->hasMany(InvoiceItem::class);
    }
}