<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id', 'product_id', 'qty', 'unit_price', 'line_discount'
    ];

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}