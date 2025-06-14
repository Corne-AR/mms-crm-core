<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_id', 'invoice_number', 'issue_date', 'due_date',
        'status', 'subtotal', 'vat_amount', 'total_amount', 'currency'
    ];

    public function quote() {
        return $this->belongsTo(Quote::class);
    }

    public function items() {
        return $this->hasMany(InvoiceItem::class);
    }
}
