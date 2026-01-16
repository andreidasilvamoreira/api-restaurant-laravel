<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_hora',
        'valor',
        'forma_pagamento',
        'status_pagamento',
        'pedido_id'
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
