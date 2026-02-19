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

    public const STATUS_DISPONIVEL = 'disponivel';
    public const STATUS_OCUPADA = 'ocupada';
    public const STATUS_RESERVADA= 'reservada';

    public const STATUS = [
        self::STATUS_DISPONIVEL,
        self::STATUS_OCUPADA,
        self::STATUS_RESERVADA,
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
