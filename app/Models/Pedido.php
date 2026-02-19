<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'data_hora',
        'status',
        'cliente_id',
        'mesa_id',
        'restaurante_id',
        'atendente_id',
    ];

    public const STATUS_ABERTO = 'aberto';
    public const STATUS_PREPARANDO= 'preparando';
    public const STATUS_FINALIZADO = 'finalizado';
    public const STATUS_PAGO = 'pago';

    public const STATUS_PEDIDO = [
        self::STATUS_ABERTO,
        self::STATUS_PREPARANDO,
        self::STATUS_FINALIZADO,
        self::STATUS_PAGO,
    ];

    protected $casts = [
        'data_hora' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }

    public function itensPedido()
    {
        return $this->hasMany(ItemPedido::class);
    }

    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class);
    }

    public function atendente()
    {
        return $this->belongsTo(User::class, 'atendente_id');
    }

    public function pagamento()
    {
        return $this->hasOne(Pagamento::class);
    }
}
