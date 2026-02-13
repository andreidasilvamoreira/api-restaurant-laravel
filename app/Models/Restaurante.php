<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    use HasFactory;

    protected $table = 'restaurantes';

    protected $fillable = [
        'nome',
        'descricao',
        'ativo'
    ];

    public const ROLE_DONO = 'DONO';
    public const ROLE_FUNCIONARIO = 'FUNCIONARIO';
    public const ROLE_ADMIN = 'ADMIN';

    public function users()
    {
        return $this->belongsToMany(User::class, 'restaurante_users')->using(RestauranteUser::class)->withPivot(['role', 'ativo'])->withTimestamps();
    }

    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }

    public function mesas()
    {
        return $this->hasMany(Mesa::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    public function fornecedores()
    {
        return $this->hasMany(Fornecedor::class);
    }

    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }
}
