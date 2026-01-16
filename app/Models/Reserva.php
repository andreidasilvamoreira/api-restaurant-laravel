<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_reserva',
        'numero_pessoas',
        'status',
        'cliente_id',
        'mesa_id',
        'restaurante_id',
    ];

    protected $casts = [
        'data_reserva' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }

    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class);
    }
}
