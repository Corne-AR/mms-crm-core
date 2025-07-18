<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealerRegion extends Model
{
    use HasFactory;

    protected $fillable = ['region_name'];

    public function users() {
        return $this->hasMany(User::class);
    }
}