<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kit;
use App\Models\Product;

class KitItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'kit_id',
        'product_id',
        'qty',
    ];

    public function kit()
    {
        return $this->belongsTo(Kit::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
