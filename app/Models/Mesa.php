<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'capacidade',
        'status',
        'restaurante_id',
    ];

    public $timestamps = false;

    public function reserva()
    {
        return $this->hasMany(Reserva::class, 'mesa_id');
    }

    public function pedido()
    {
        return $this->hasMany(Pedido::class,'mesa_id');
    }
}
