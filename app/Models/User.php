<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * After installing Filament (composer install), implement panel access:
 *
 * use Filament\Models\Contracts\FilamentUser;
 * use Filament\Panel;
 * class User extends Authenticatable implements FilamentUser
 * {
 *     public function canAccessPanel(Panel $panel): bool
 *     {
 *         return true; // tighten: e.g. only admin emails
 *     }
 * }
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
