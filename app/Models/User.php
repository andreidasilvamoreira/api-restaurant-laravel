<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    public const ROLE_SUPER_ADMIN = 'SUPER_ADMIN';
    public const ROLE_OWNER = 'OWNER';
    public const ROLE_CLIENTE = 'CLIENTE';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hasRole(string $role, int $restauranteId): bool
    {
        return $this->restaurantes()->where('restaurante_id', $restauranteId)->wherePivot('role', $role)->exists();
    }

    public function isActiveInRestaurant(int $restauranteId): bool
    {
        return $this->restaurantes()->where('restaurante_id', $restauranteId)->wherePivot('ativo', true)->exists();
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }

    public function restaurantes()
    {
        return $this->belongsToMany(Restaurante::class, 'restaurante_users')->using(RestauranteUser::class)->withPivot(['role', 'ativo'])->withTimestamps();
    }
}
