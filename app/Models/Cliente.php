<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'endereco'.
        'user_id'
    ];

    public $timestamps = false;

    public function reserva()
    {
        return $this->hasMany(Reserva::class, 'cliente_id');
    }

    public function pedido()
    {
        return $this->hasMany(Pedido::class, 'cliente_id');
    }
}
