<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'dealer_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ✅ Correct dealer relationship
    public function dealer()
    {
        return $this->belongsTo(Dealer::class, 'dealer_id');
    }

    // 🟡 Optional: if you have roles
    public function role()
    {
        return $this->belongsTo(UserRole::class);
    }

    // 🟡 Optional: if you want to access quotes created by this user
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}