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
        'endereco',
        'ativo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categorias()
    {
        return $this->hasMany(Categoria::class, 'restaurante_id');
    }

    public function mesas()
    {
        return $this->hasMany(Mesa::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
