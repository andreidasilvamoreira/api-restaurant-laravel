<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'data_hora',
        'status',
        'cliente_id',
        'mesa_id',
    ];

    protected $casts = [
        'data_hora' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function mesa()
    {
        return $this->belongsTo(Mesa::class, 'mesa_id');
    }

    public function itensPedido()
    {
        return $this->hasMany(ItemPedido::class);
    }
}
