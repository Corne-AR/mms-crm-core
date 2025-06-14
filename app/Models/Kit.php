<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KitItem;
use App\Models\QuoteKit;

class Kit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'vat_applicable',
        'discount_allowed',
    ];

    public function items()
    {
        return $this->hasMany(KitItem::class);
    }

    public function quoteKits()
    {
        return $this->hasMany(QuoteKit::class);
    }
}
