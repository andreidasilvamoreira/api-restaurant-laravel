<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;

    protected $table = 'mesas';

    protected $fillable = [
        'numero',
        'capacidade',
        'status',
        'restaurante_id',
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'mesa_id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class,'mesa_id');
    }

    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class);
    }
}
