<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $table = 'pagamentos';

    protected $fillable = [
        'data_hora',
        'valor',
        'forma_pagamento',
        'status_pagamento',
        'pedido_id'
    ];

    public const PAGAMENTO_PIX = 'pix';
    public const PAGAMENTO_CARTAO_CREDITO = 'cartao_credito';
    public const PAGAMENTO_CARTAO_DEBITO = 'cartao_debito';
    public const PAGAMENTO_DINHEIRO = 'dinheiro';

    public const PAGAMENTO = [
        self::PAGAMENTO_PIX,
        self::PAGAMENTO_CARTAO_CREDITO,
        self::PAGAMENTO_CARTAO_DEBITO,
        self::PAGAMENTO_DINHEIRO,
    ];

    public const STATUS_PAGAMENTO_PENDENTE = 'pendente';
    public const STATUS_PAGAMENTO_CONFIRMADO = 'confirmado';
    public const STATUS_PAGAMENTO_CANCELADO = 'cancelado';
    public const STATUS_PAGAMENTO = [
        self::STATUS_PAGAMENTO_PENDENTE,
        self::STATUS_PAGAMENTO_CONFIRMADO,
        self::STATUS_PAGAMENTO_CANCELADO,
    ];

    protected $casts = [
        'data_hora' => 'datetime',
        'valor' => 'decimal:2'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }
}
