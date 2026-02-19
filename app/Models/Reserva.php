<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'data_reserva',
        'numero_pessoas',
        'status',
        'cliente_id',
        'mesa_id',
        'restaurante_id',
    ];

    public const STATUS_RESERVA_CANCELADA = 'cancelado';
    public const STATUS_RESERVA_CONFIRMADA = 'confirmada';
    public const STATUS_RESERVA_FINALIZADA = 'finalizada';
    public const STATUS_RESERVA_PENDENTE = 'pendente';

    public const STATUS_RESERVA = [
        self::STATUS_RESERVA_CANCELADA,
        self::STATUS_RESERVA_CONFIRMADA,
        self::STATUS_RESERVA_FINALIZADA,
        self::STATUS_RESERVA_PENDENTE,
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
